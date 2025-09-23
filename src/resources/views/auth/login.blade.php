@extends('layouts.app')

@section('header_btn_route', '#')
@section('title_btn_text', 'Register')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="log-wrapper">
    <h2 class="log-title">Login</h2>
</div>
<div class="login-wrapper">
    <form class="login">
        <div class="login__form">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" placeholder="例: test@example.com">
        </div>
        <div class="login__form">
            <label for="password">パスワード</label>
            <input type="password" id="password" placeholder="例: coachtech1106">
        </div>
        <button type="submit" class="login__submit-btn">ログイン</button>
    </form>
</div>

@endsection

