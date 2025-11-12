<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest
{
    // ここで validate() などをカスタマイズ可能

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
   public function rules()
{
    $rules = [
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ];

    // "name" がリクエストに含まれていればバリデーション
    if ($this->has('name')) {
        $rules['name'] = ['required', 'string', 'max:255'];
    }

    return $rules;
}
    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
