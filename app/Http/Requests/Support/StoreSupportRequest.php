<?php

namespace App\Http\Requests\Support;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreSupportRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:10|max:1000',
            'category_id' => 'required|exists:categories,id',
            'CaptchaCode' => 'required|valid_captcha',
            'images' => 'nullable|array',
            //'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'CaptchaCode.valid_captcha' => 'Wrong code. Try again please.',
            'CaptchaCode.required' => 'Please ensure that you are a human!'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return response()->json(array(
            'success' => false,
            'errors' => $validator->getMessageBag()->toArray()
        ), 422); // 400 being the HTTP code for an invalid request.
    }
}
