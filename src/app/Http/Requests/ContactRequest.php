<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return 
        [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'gender'      => 'required',
            'email'       => 'required|email',
            'tel-1'       => 'required|digits_between:2,4',
            'tel-2'       => 'required|digits_between:3,4',
            'tel-3'       => 'required|digits_between:3,4',
            'address'     => 'required',
            'building'    => 'nullable',
            'category_id' => 'required',
            'detail'      => 'required|max:120',
        ];
    }

    public function messages()
    {
        return 
        [
            'first_name.required' => '姓を入力してください',
            'last_name.required'  => '名を入力してください',
            'gender.required'     => '性別を選択してください',
            'email.required'      => 'メールアドレスを入力してください',
            'email.email'         => 'メールアドレスはメール形式で入力してください',
            'tel-1.required' => '電話番号1を入力してください',
            'tel-2.required' => '電話番号2を入力してください',
            'tel-3.required' => '電話番号3を入力してください',
            'tel-1.digits_between' => '電話番号1は2〜4桁で入力してください',
            'tel-2.digits_between' => '電話番号2は3〜4桁で入力してください',
            'tel-3.digits_between' => '電話番号3は3〜4桁で入力してください',
            'address.required'    => '住所を入力してください',
            'category_id.required'=> 'お問い合わせの種類を選択してください',
            'detail.required'     => 'お問い合わせ内容を入力してください',
            'detail.max'          => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
