@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Список файлов</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a href="{{ route('files.create') }}" class="btn btn-primary mb-3">Загрузить файл</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Имя файла</th>
                <th>Ссылка</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{ $file->name }}</td>
                    <td><a href="{{ Storage::url($file->path) }}" target="_blank">Просмотреть</a></td>
                    <td>
                        <form action="{{ route('files.destroy', $file) }}" method="POST" onsubmit="return confirm('Удалить этот файл?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
