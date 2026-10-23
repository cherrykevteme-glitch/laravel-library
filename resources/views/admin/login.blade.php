@extends('layouts.app')

@section('title', 'Вход в админ-панель')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow border-0">
            <div class="card-header bg-dark text-white text-center">
                <h5 class="mb-0">Вход в Админ-панель</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.login.check') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Введите пин-код</label>
                        <input type="password" name="pin" class="form-control text-center fs-4" maxlength="10" placeholder="****" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection