<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        //return !$this->user()->is_admin; // это проверяется на уровне middleware или gate
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
            'id' => ['required', 'integer', 'max:10']
        ];
    }
}
