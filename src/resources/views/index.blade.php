@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection


@section('content')
<div class="title">
    <h2 class="title-text">Contact</h2>
</div>

<form class="form" action="/confirm" method="post">
    @csrf
    <div class="form__items">
        <label>お名前 <span>※</span></label>
        <div class="form__items-input">
            <div class="form__items-input--name">
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 山田">
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 太郎">
            </div>
        </div>
    </div>
    <div class="form-error__wrapper">
        <div class="form-error">
            @error('first_name')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-error">
                @error('last_name')
                    <p>{{ $message }}</p>
                    @enderror
        </div>  
    </div>
    
    <div class="form__items">
        <label>性別 <span>※</span></label>
        <div class="form__items-input">
            <label class="form__items-gender">
                <input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>男性
            </label>
            <label class="form__items-gender" >
                <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}">女性
            </label>
            <label class="form__items-gender">
                <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}">その他
            </label>
        </div>
    </div>
    <div class="form-error">
            @error('gender')
            <p>{{ $message }}</p>
            @enderror
    </div>

    <div class="form__items">
        <label>メールアドレス <span>※</span></label>
        <div class="form__items-input">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        </div>
    </div>

    <div class="form-error">
            @error('email')
            <p>{{ $message }}</p>
            @enderror
    </div>

    <div class="form__items">
        <label>電話番号</label>
        <div class="form__items-input">
            <input type="tel" name="tel-1" value="{{ old('tel-1') }}" placeholder="080"> -
            <input type="tel" name="tel-2" value="{{ old('tel-2') }}" placeholder="1234"> -
            <input type="tel" name="tel-3"  value="{{ old('tel-3') }}" placeholder="5678">
        </div>
    </div>

    <div class="form-error__wrapper">
        <div class="form-error">
                @error('tel-1') <p>{{ $message }}</p> @enderror
        </div>
        <div class="form-error">
                @error('tel-2') <p>{{ $message }}</p> @enderror
        </div>
        <div class="form-error">
                @error('tel-3') <p>{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="form__items">
        <label>住所 <span>※</span></label>
        <div class="form__items-input">
            <input type="text" name="address"  value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
        </div>
    </div>

     <div class="form-error">
            @error('address')
            <p>{{ $message }}</p>
            @enderror
    </div>

    <div class="form__items">
        <label>建物名</label>
        <div class="form__items-input">
            <input type="text" name="building" value="{{ old('address') }}" placeholder="例: 千駄ヶ谷マンション101">
        </div>
    </div>

    <div class="form__items">
        <label>お問い合わせの種類 <span>※</span></label>
        <div class="form__items-input">
            <select name="category_id">
                <option value="">選択してください</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category -> id ? 'selected' : '' }}>
                        {{ $category->content }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
     <div class="form-error">
            @error('category_id')
            <p>{{ $message }}</p>
            @enderror
    </div>
    <div class="form__items">
        <label>お問い合わせ内容 <span>※</span></label>
        <div class="form__items-input">
            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください" > {{ old('detail') }} </textarea>
        </div>
    </div>
     <div class="form-error">
            @error('detail')
            <p>{{ $message }}</p>
            @enderror
    </div>
    <div class="form__items--btn">
        <button class="form__items--btn-submit" type="submit">確認画面</button>
    </div>

</form>



@endsection