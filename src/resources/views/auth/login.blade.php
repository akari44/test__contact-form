@extends('layouts.app')

@section('header_btn_route','register')
@section('title_btn_text', 'Register')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="title">
    <h2 class="title-text">Login</h2>
</div>
<div class="login-wrapper">
    <form class="login" action="{{ route('login.store') }}"  method="post">
        @csrf
        <div class="login__form">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" placeholder="例: test@example.com">
        </div>
        @error('email')
        <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="login__form">
            <label for="password">パスワード</label>
            <input type="password" name="password" placeholder="例: coachtech1106">
        </div>
        @error('password')
        <div class="form__error">{{ $message }}</div>
        @enderror

        <button type="submit" class="login__submit-btn">ログイン</button>

    </form>
</div>

@endsection

