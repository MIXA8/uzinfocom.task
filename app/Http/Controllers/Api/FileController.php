<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Service\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    // Загрузка файла
    public function upload(Request $request)
    {
        $request->validate(['file' => 'required|file']);

        $file = $this->fileService->uploadFile($request->file('file'));
        return response()->json(['file' => $file], 201);
    }

    // Получение списка файлов
    public function index()
    {
        $files = $this->fileService->getUserFiles();
        return response()->json(['files' => $files]);
    }

    // Удаление файла
    public function delete($id)
    {
        $file = File::findOrFail($id);

        if ($this->fileService->deleteFile($file)) {
            return response()->json(['message' => 'File deleted successfully']);
        }

        return response()->json(['error' => 'You do not have permission to delete this file'], 403);
    }
}
