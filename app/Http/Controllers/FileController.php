<?php

namespace App\Http\Controllers;

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


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = $this->fileService->getUserFiles();
        return view('admin.files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.files.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:5120',  // Ограничение размера файла 5 MB
        ]);

        $this->fileService->uploadFile($request->file('file'));
        return redirect()->route('files.index')->with('success', 'Файл успешно загружен.');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        if ($this->fileService->deleteFile($file)) {
            return redirect()->route('files.index')->with('success', 'Файл успешно удален.');
        }

        return redirect()->route('files.index')->with('error', 'Удаление файла невозможно.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
