<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:50',
            'maker' => 'required|max:50',
            'price' => 'required|integer|max:10000',
            'body'  => 'required|max:300',
            'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags'  => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'maker' => 'メーカー',
            'price' => '価格',
            'body'  => '本文',
            'image' => '商品画像',
            'tags'  => 'タグ',
        ];
    }

    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
                        ->slice(0, 10)
                        ->map(function ($requestTag) {
                            return $requestTag->text;
                        });
    }
}
