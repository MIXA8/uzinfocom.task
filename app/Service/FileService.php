<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use Illuminate\Http\UploadedFile;

class FileService
{
    public function uploadFile(UploadedFile $file): File
    {
        $hash = hash_file('sha256', $file->getPathname());
        $existingFile = File::where('hash', $hash)->first();

        if ($existingFile) {
            $existingFile->users()->syncWithoutDetaching(Auth::id());
            return $existingFile;
        }

        $uniqueFileName = uniqid() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $uniqueFileName, 'public');

        $newFile = File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'hash' => $hash,
            'user_id' => Auth::id(),
        ]);

        Auth::user()->files()->syncWithoutDetaching($newFile->id);

        return $newFile;
    }

    public function deleteFile(File $file): bool
    {
        $user = Auth::user();

        if (!$this->canDeleteFile($file, $user)) {
            return false;
        }

        if ($file->users()->count() <= 1) {
            Storage::disk('public')->delete($file->path);
        }

        $user->files()->detach($file);

        if ($file->users()->count() === 0) {
            $file->delete();
        }

        return true;
    }

    public function getUserFiles()
    {
        $user = Auth::user();

        if ($user->role_id === Role::ADMIN->value) {
            return File::all();
        }

        if ($user->role_id === Role::MODERATOR->value) {
            return File::whereHas('users', function ($q) {
                $q->where('role_id', Role::MODERATOR->value);
            })->orWhereHas('users', function ($q) {
                $q->where('id', Auth::id());
            })->get();
        }

        return $user->files;
    }

    public function getFileUrl(File $file): string
    {
        return Storage::disk('public')->url($file->path);
    }

    private function canDeleteFile(File $file, $user): bool
    {
        if ($user->role_id === Role::ADMIN->value) {
            return true;
        }

        if ($user->role_id === Role::MODERATOR->value && $file->users->contains('role_id', Role::ADMIN->value)) {
            return false;
        }

        return $file->users->contains($user);
    }
}
