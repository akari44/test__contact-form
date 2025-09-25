@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection


@section('content')
<div class="title">
    <h2 class="title-text">Contact</h2>
</div>

<form class="form" action="/" method="post">

    <div class="form__items">
        <label>お名前 <span>※</span></label>
        <div class="form__items-input">
            <div class="form__items-input--name">
                <input type="text" name="first_name" placeholder="例: 山田">
                <input type="text" name="last_name" placeholder="例: 太郎">
            </div>
        </div>
    </div>
    <div class="form__items">
        <label>性別 <span>※</span></label>
        <div class="form__items-input">
            <label class="form__items-gender">
                <input type="radio" name="gender" value="male">男性
            </label>
            <label class="form__items-gender" >
                <input type="radio" name="gender" value="female">女性
            </label>
            <label class="form__items-gender">
                <input type="radio" name="gender" value="other">その他
            </label>
        </div>
    </div>
    <div class="form__items">
        <label>メールアドレス <span>※</span></label>
        <div class="form__items-input">
            <input type="email" name="email" placeholder="例: test@example.com">
        </div>
    </div>
    <div class="form__items">
        <label>電話番号</label>
        <div class="form__items-input">
            <input type="tel" name="tel" placeholder="080"> -
            <input type="tel" name="tel" placeholder="1234"> -
            <input type="tel" name="tel" placeholder="5678">
        </div>
    </div>
    <div class="form__items">
        <label>住所 <span>※</span></label>
        <div class="form__items-input">
            <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
        </div>
    </div>
    <div class="form__items">
        <label>建物名</label>
        <div class="form__items-input">
            <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101">
        </div>
    </div>
    <div class="form__items">
        <label>お問い合わせの種類 <span>※</span></label>
        <div class="form__items-input">
            <select name="category_id">
                <option value="">選択してください</option>
                <option value="">選択してください</option>
            </select>
        </div>
    </div>
    <div class="form__items">
        <label>お問い合わせ内容 <span>※</span></label>
        <div class="form__items-input">
            <textarea name="details" placeholder="お問い合わせ内容をご記載ください" required></textarea>
        </div>
    </div>
    <div class="form__items--btn">
        <button class="form__items--btn-submit" type="submit">確認画面</button>
    </div>

</form>
@endsection