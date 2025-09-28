@extends('layouts.app')

@section('header_btn_route', route('login.form'))
@section('title_btn_text', 'logout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin">
    <div class="title">
        <h2 class="title__text">Admin</h2>
    </div>

    <!-- 検索フォーム -->
    <form class="search-form">
        <div class="search-form__inner">
            <input class="form__name" name="name" type="text" placeholder="名前やメールアドレスを入力してください">
            <div class="select-wrapper">
                <select class="form__gender" name="gender">
                    <option selected>性別</option>
                    <option value="">全て</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
            </div>
            <div class="select-wrapper">
                <select class="form__categories" name="">
                    <option selected>お問い合わせの種類</option>
                    <option value="1">商品について</option>
                    <option value="2">返品について</option>
                </select>
            </div>
            <div class="select-wrapper">
                <input type="date" class="form__date" placeholder="年/月/日">
            </div>

            <button class="form__btn--search" type="submit" class="btn btn-search">
                検索
            </button>
            <button class="form__btn--reset" type="reset" class="btn btn-reset">
                リセット
            </button>
        </div>
    </form>

    <div class="action-bar">
        <div class="btn-export"><button class="btn-export__submit">エクスポート</button></div>
        <div class="pagination"><!-- pagination -->
            {{ $contacts->links() }}
        </div>
    </div>

    <!-- 一覧テーブル -->
    <div class="admin-table">
        <table class="admin-table__inner">
                <tr class="admin-table__header">
                    <th class="admin-table__header--name">お名前</th>
                    <th class="admin-table__header--gender">性別</th>
                    <th class="admin-table__header--email">メールアドレス</th>
                    <th class="admin-table__header--categories">お問い合わせの種類</th>
                    <th></th>
                </tr>
                <tr class="admin-table__row">
                    <td class="admin-table__name">山田 太郎</td>
                    <td class="admin-table__gender">男性</td>
                    <td class="admin-table__email">test@example.com</td>
                    <td class="admin-table__categories">商品の交換について</td>
                    <td class="admin-table__detail"><button class="admin-table__detail-btn">詳細</button></td>
                </tr>
                <!-- 以降データ繰り返し -->
        </table>
    </div>

</div>
@endsection
