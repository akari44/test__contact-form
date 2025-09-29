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
    <form class="search-form" method="GET" action="{{ url('/admin') }}">
        <div class="search-form__inner">
            <!-- キーワード検索（名前・メール対応） -->
            <input class="form__keyword" name="keyword" type="text" placeholder="名前またはメールアドレスを入力してください" value="{{ request('keyword') }}">
            <div class="select-wrapper">
                <select class="form__gender" name="gender">
                <option value="all" {{ request('gender')=='all' ? 'selected' : '' }}>性別</option>
                <option value="1" {{ request('gender')==1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender')==2 ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender')==3 ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div class="select-wrapper">
                <select class="form__categories" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            </div>
            <div class="select-wrapper">
                <input type="date" class="form__date" name="date" placeholder="年/月/日" value="{{ request('date') }}"> 
            </div>

            <button class="form__btn--search" type="submit" class="btn btn-search">
                検索
            </button>
            <a href="{{ url('/admin') }}" class="form__btn--reset">リセット</a>
        </div>
    </form>

    <div class="action-bar">
        <div class="btn-export"> 
            <form action="{{ route('admin.export') }}" method="get">
                <input type="hidden" name="keyword" value="{{ $request->keyword }}">
                <input type="hidden" name="gender" value="{{ $request->gender }}">
                <input type="hidden" name="category_id" value="{{ $request->category_id }}">
                <input type="hidden" name="date" value="{{ $request->date }}">
                <button type="submit" class="btn-export__submit">エクスポート</button>
            </form>
        </div>
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
                @foreach($contacts as $contact)
                <tr class="admin-table__row">
                    <td class="admin-table__name">
                        {{ $contact->last_name }} {{ $contact->first_name }}
                    </td>
                    <td class="admin-table__gender">
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @elseif($contact->gender == 3) その他
                        @else 不明
                        @endif
                    </td>
                    <td class="admin-table__email">
                        {{ $contact->email }}
                    </td>
                    <td class="admin-table__categories">
                        {{ $contact->category->name ?? '未分類' }}
                    </td>

                    
                    <td class="admin-table__detail">
                        <button type="button" class="admin-table__detail-btn" data-id="{{ $contact->id }}">
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>

</div>
{{-- モーダル --}}
<div id="detail-modal" class="modal" aria-hidden="true">
  <div class="modal__panel" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <button type="button" class="modal__close" aria-label="閉じる">×</button>

    <h3 id="modal-title" class="modal__title">お問い合わせ詳細</h3>

    <dl class="modal__list">
      <div><dt>受付ID</dt><dd id="m-id"></dd></div>
      <div><dt>お名前</dt><dd id="m-name"></dd></div>
      <div><dt>性別</dt><dd id="m-gender"></dd></div>
      <div><dt>メール</dt><dd id="m-email"></dd></div>
      <div><dt>電話</dt><dd id="m-tel"></dd></div>
      <div><dt>住所</dt><dd id="m-address"></dd></div>
      <div><dt>建物名</dt><dd id="m-building"></dd></div>
      <div><dt>種類</dt><dd id="m-category"></dd></div>
      <div><dt>内容</dt><dd id="m-detail" class="prewrap"></dd></div>
      <div><dt>受付日時</dt><dd id="m-created"></dd></div>
    </dl>

    <form id="modal-delete-form" method="POST" class="modal__delete">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('削除してよろしいですか？')">削除</button>
    </form>
  </div>
</div>

{{-- ルートURLテンプレ（JSで使う） --}}
<meta id="route-admin-show" data-template="/admin/:id">
<meta id="route-admin-destroy" data-template="/admin/:id">

<script>
(function(){
  const modal     = document.getElementById('detail-modal');
  const panel     = modal.querySelector('.modal__panel');
  const btnClose  = modal.querySelector('.modal__close');
  const showTpl   = document.getElementById('route-admin-show').dataset.template;     // "/admin/:id"
  const delTpl    = document.getElementById('route-admin-destroy').dataset.template;  // "/admin/:id"
  const delForm   = document.getElementById('modal-delete-form');

  // 行の「詳細」ボタンにイベント付与
  document.querySelectorAll('.admin-table__detail-btn').forEach(btn => {
    btn.addEventListener('click', async (e) => {
      const id = btn.dataset.id;
      const url = showTpl.replace(':id', id);
      try {
        const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
        if(!res.ok) throw new Error('詳細の取得に失敗しました');
        const d = await res.json();

        // XSS対策: textContentで挿入
        setTxt('m-id',      d.id);
        setTxt('m-name',    d.full_name || '');
        setTxt('m-gender',  d.gender || '');
        setTxt('m-email',   d.email || '');
        setTxt('m-tel',     d.tel || '');
        setTxt('m-address', d.address || '');
        setTxt('m-building',d.building || '');
        setTxt('m-category',d.category || '');
        setTxt('m-detail',  d.detail || '');
        setTxt('m-created', d.created_at || '');

        // 削除フォームのactionを対象IDに
        delForm.action = delTpl.replace(':id', d.id);

        openModal();
      } catch(err){
        alert(err.message || '通信エラーが発生しました');
      }
    });
  });

  function setTxt(id, value){ const el = document.getElementById(id); if(el) el.textContent = value; }
  function openModal(){ modal.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; }
  function closeModal(){ modal.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; }

  // 閉じる操作
  btnClose.addEventListener('click', closeModal);
  modal.addEventListener('click', (e) => { if(e.target === modal) closeModal(); });
  window.addEventListener('keydown', (e) => { if(e.key === 'Escape') closeModal(); });
})();
</script>



@endsection
