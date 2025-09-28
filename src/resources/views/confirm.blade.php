@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <div class="title">
        <h2 class="title__text">Confirm</h2>
    </div>

    <form class="form" action="{{ route('contacts.store') }}" method="post">
        @csrf
        <div class="confirm__table">
            <table class="confirm__table-inner">
                <tr>
                    <th>お名前</th>
                    <td class="confirm__name">
                        <p>{{ $contact['first_name'] }}</p>
                        <p>{{ $contact['last_name'] }}</p>
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        <p>
                            @if($contact['gender'] == 1) 男性
                            @elseif($contact['gender'] == 2) 女性
                            @else その他
                            @endif
                        </p>
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>
                        <p>{{ $contact['email'] }}</p>
                        <input type="hidden" name="email" value="{{ $contact['email'] }}">
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>
                        <p>{{ $contact['tel'] }}</p>
                        <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>
                        <p>{{ $contact['address'] }}</p>
                        <input type="hidden" name="address" value="{{ $contact['address'] }}">
                    </td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>
                        <p>{{ $contact['building'] }}</p>
                        <input type="hidden" name="building" value="{{ $contact['building'] }}">
                    </td>
                </tr>
                 <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                        <p>{{ $contact['category_name'] ?? '' }}</p>
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>
                        <p>{{ $contact['detail'] }}</p>
                        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
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
