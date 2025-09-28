@extends('layouts.app')

@section('header_btn_route', route('login.form'))
@section('title_btn_text', 'Login')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection


@section('content')
<div class="title">
    <h2 class="title-text">Register</h2>
</div>
<div class="register-wrapper">
    <form class="register" action="/register" method="post">
        @csrf
        <div class="register__form">
            <label for="name">お名前</label>
            <input type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}" />
        </div>
        @error('name')
        <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="register__form">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
        </div>
        @error('email')
        <div class="form__error">{{ $message }}</div>
        @enderror
        
        <div class="register__form">
            <label for="password">パスワード</label>
            <input type="password" name="password" placeholder="例: coachtech1106" value="{{ old('password') }}" />
        </div>
        @error('password')
        <div class="form__error">{{ $message }}</div>
        @enderror


        <button type="submit" class="register__submit-btn">登録</button>
    </form>
</div>

@endsection

