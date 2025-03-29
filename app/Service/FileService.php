<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use Illuminate\Http\UploadedFile;

class FileService
{
    /**
     * Загрузка файла с проверкой дубликатов по хэшу.
     */
    public function uploadFile(UploadedFile $file): File
    {
        // Вычисление хэша для проверки дубликатов (более надежный алгоритм)
        $hash = hash_file('sha256', $file->getPathname());
        $existingFile = File::where('hash', $hash)->first();

        if ($existingFile) {
            // Если файл уже существует, привязываем его к текущему пользователю
            $existingFile->users()->syncWithoutDetaching(Auth::id());
            return $existingFile;
        }

        // Сохранение нового файла с уникальным именем, чтобы избежать конфликта имен
        $uniqueFileName = uniqid() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $uniqueFileName, 'public');

        // Создание записи о файле в базе данных
        $newFile = File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'hash' => $hash,
            'user_id' => Auth::id(),
        ]);

        // Привязка нового файла к текущему пользователю через таблицу file_user
        Auth::user()->files()->syncWithoutDetaching($newFile->id);

        return $newFile;
    }

    /**
     * Удаление файла с учетом прав пользователя.
     */
    public function deleteFile(File $file): bool
    {
        $user = Auth::user();

        if (!$this->canDeleteFile($file, $user)) {
            return false;  // Если у пользователя нет прав на удаление файла
        }

        // Если файл связан только с текущим пользователем — удаляем его с диска
        if ($file->users()->count() <= 1) {
            Storage::disk('public')->delete($file->path);
        }

        // Удаление связи между пользователем и файлом
        $user->files()->detach($file);

        // Если связей с другими пользователями больше нет — удаляем файл из базы данных
        if ($file->users()->count() === 0) {
            $file->delete();
        }

        return true;
    }

    /**
     * Получение списка файлов текущего пользователя в зависимости от его роли.
     */
    public function getUserFiles()
    {
        $user = Auth::user();
        if ($user->role_id === 1) {  // Админ видит все файлы
            return File::all();
        }

        if ($user->role_id === 3) {  // Модератор
            return File::whereHas('users', function ($q) {
                $q->where('role_id', 3);  // Модератор видит свои файлы и файлы других модераторов
            })->orWhereHas('users', function ($q) {
                $q->where('id', Auth::id());
            })->get();
        }

        // Обычный пользователь видит только свои файлы
        return $user->files;
    }

    /**
     * Получение URL файла.
     */
    public function getFileUrl(File $file): string
    {
        return Storage::disk('public')->url($file->path);
    }

    /**
     * Проверка прав на удаление файла.
     */
    private function canDeleteFile(File $file, $user): bool
    {
        if ($user->role_id === 1) {
            return true;  // Админ может удалить любой файл
        }

        if ($user->role_id === 2 && $file->users->contains('role_id', 1)) {
            return false;  // Модератор не может удалять файлы админа
        }

        return $file->users->contains($user);  // Пользователь может удалять только свои файлы
    }
}
