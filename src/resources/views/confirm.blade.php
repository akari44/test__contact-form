@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <div class="title">
        <h2 class="title__text">Confirm</h2>
    </div>

    <form class="form" action=" " method="post">
        @csrf
        <div class="confirm__table">
            <table class="confirm__table-inner">
                <tr>
                    <th>お名前</th>
                    <td class="confirm__name">
                        <p>山田</p>
                        <p>太郎</p>
                        <input type="hidden" name="last_name" value="sample">
                        <input type="hidden" name="first_name" value="sample">
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        <p>sample</p>
                        <input type="hidden" name="gender" value=" ">
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>
                        <p>sample</p>
                        <input type="hidden" name="email" value="">
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>
                        <p>sample</p>
                        <input type="hidden" name="tel" value=" "> 
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>
                        <p>sample</p>
                        <input type="hidden" name="address" value=" ">
                    </td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>
                        <p>sample</p>
                        <input type="hidden" name="building" value=" ">
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>
                        <p>sample</p>
                        <input type="hidden" name="content" value=" ">
                    </td>
                </tr>
            </table>
            <div class="form__buttons">
                <button type="submit" name="action" value="submit" class="form__button-submit">送信</button>
                <button type="submit" name="action" value="back" class="form__button-back">修正</button>
            </div>
        </form>
    </div>
</div>
@endsection
