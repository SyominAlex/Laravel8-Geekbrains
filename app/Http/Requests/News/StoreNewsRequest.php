<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNewsRequest extends FormRequest
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
        \DB::table('users')->where('id', 1)->first(); // подключение через фасад \DB - использовать только когда Eloquent не подходит, для сложных запросов
        return [
            'title' => ['required', 'string', 'max:100'], // кастомизация через массив гораздо лучше, можно добавить Rule::unique('news')->ignore(1, 2)
            'description' => ['required', 'string', 'max:300'],
            'category_id' => ['required', 'integer', 'exists:categories,id'] // 'nullable' - необязательное поле, может быть 'unique:news' и т.д.
        ];
    }
}
