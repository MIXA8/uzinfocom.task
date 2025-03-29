@extends('layouts.custom')

@section('content')
    <div class="container">
        <h1>{{ isset($user) ? 'Редактировать пользователя' : 'Создать пользователя' }}</h1>

        <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
            @csrf
            @isset($user)
                @method('PUT')
            @endisset

            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       id="name" value="{{ old('name', $user->name ?? '') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" value="{{ old('email', $user->email ?? '') }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if(!isset($user))
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="form-check mb-3">
                <input type="hidden" name="is_active" value="false">
                <input type="checkbox" name="is_active" value="true" class="form-check-input @error('is_active') is-invalid @enderror"
                       id="is_active" {{ old('is_active', $user->is_active ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Активен</label>
                @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Роль</label>
                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                    <option value="" disabled selected>Выберите роль</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($user) ? 'Обновить' : 'Создать' }}
            </button>
        </form>
    </div>
@endsection
