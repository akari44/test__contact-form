@extends('layouts.app')

@section('header_btn_route', '#')
@section('title_btn_text', 'Login')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection


@section('content')
<div class="title">
    <h2 class="title-text">Register</h2>
</div>
<div class="register-wrapper">
    <form class="register">
        <div class="register__form">
            <label for="name">お名前</label>
            <input type="text" id="name" placeholder="例: 山田 太郎">
        </div>
        <div class="register__form">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" placeholder="例: test@example.com">
        </div>
        <div class="register__form">
            <label for="password">パスワード</label>
            <input type="password" id="password" placeholder="例: coachtech1106">
        </div>
        <button type="submit" class="register__submit-btn">登録</button>
    </form>
</div>

@endsection

