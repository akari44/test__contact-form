<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ContactController extends Controller
{
    //お問い合わせフォーム//
   public function index()
{
    $categories = Category::all();
    return view('index', compact('categories'));
}
//確認ページ//
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(
            'user_id',
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'detail',);

        $contact['tel'] = $request->input('tel-1') . '-' . $request->input('tel-2') . '-' . $request->input('tel-3');

        $category = Category::find($contact['category_id']);
        $contact['category_content'] = $category ? $category->content : '';
        
        return view('confirm', compact('contact'));
    }

    //確認ページの内容を送信・保存//
    public function store(Request $request)
    {
        if ($request->input('action') === 'back') 
            {
                return redirect('/')->withInput();
            }

        $contact = $request->only(
            'user_id',
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',);

            Contact::create($contact);

            return redirect('thanks');
    
    }

    public function login()
    {
        return view('auth.login');
    }

    //検索//
    public function admin(Request $request)
{
    $contacts = Contact::with('category')
        ->KeywordSearch($request->keyword)     // 名前 or メール
        ->GenderSearch($request->gender)       // 性別
        ->CategorySearch($request->category_id)// カテゴリ
        ->DateSearch($request->date)           // 日付
        ->paginate(7);

    $categories = Category::all();

    return view('admin', compact('contacts', 'categories', 'request'));
}


    public function thanks()
    {
        return view('thanks');
    }
    


    public function show($id)
    {
        $c = \App\Models\Contact::with('category')->findOrFail($id);

        $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];
        return response()->json([
            'id'         => $c->id,
            'full_name'  => trim(($c->last_name ?? '').' '.($c->first_name ?? '')),
            'gender'     => $genderMap[$c->gender] ?? '不明',
            'email'      => $c->email,
            'tel'        => $c->tel,
            'address'    => $c->address,
            'building'   => $c->building,
            'category'   => optional($c->category)->name ?? '未分類',
            'detail'     => $c->detail,
            'created_at' => optional($c->created_at)->format('Y-m-d H:i'),
        ]);
    }
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', '削除しました');
    }
    //エクスポート//
    public function export(Request $request): StreamedResponse
    {
        $contacts = Contact::with('category')
            ->KeywordSearch($request->keyword)
            ->GenderSearch($request->gender)
            ->CategorySearch($request->category_id)
            ->DateSearch($request->date)
            ->get(); // paginateじゃなくget()

        $response = new StreamedResponse(function() use ($contacts) {
            $handle = fopen('php://output', 'w');
            // ヘッダー行
            fputcsv($handle, ['ID', '姓', '名', '性別', 'メール', '電話', '住所', '建物名', 'カテゴリ', '内容', '登録日時']);

            foreach ($contacts as $c) {
                $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];
                fputcsv($handle, [
                    $c->id,
                    $c->last_name,
                    $c->first_name,
                    $genderMap[$c->gender] ?? '不明',
                    $c->email,
                    $c->tel,
                    $c->address,
                    $c->building,
                    optional($c->category)->content ?? '未分類',
                    $c->detail,
                    $c->created_at->format('Y-m-d H:i'),
                ]);
            }

            fclose($handle);
        });

        $filename = 'contacts_' . date('Ymd_His') . '.csv';
        $response->headers->set('Content-Type', 'text/csv; charset=Shift-JIS');
        $response->headers->set('Content-Disposition', "attachment; filename={$filename}");

        return $response;
    }
}
