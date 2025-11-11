<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightUpdate1Request extends FormRequest
{
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
        
        return [
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'regex:/^\d{1,3}(\.\d)?$/'],
            'calorie' => ['required', 'numeric'], // ← 単数形に変更
            'time' => ['required',], // ← 短く変更
            'exercise' => ['nullable', 'max:120'], // ← フィールド名を統一
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'date.date' => '日付の形式が正しくありません',

            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.regex' => '4桁までの数字で、小数点は1桁で入力してください',

            'calorie.required' => '摂取カロリーを入力してください',
            'calorie.numeric' => '数字で入力してください',

            'time.required' => '運動時間を入力してください',

            'exercise.max' => '120文字以内で入力してください',
        ];
    }
}
