<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
            'name' => [
                'required',
                'string', 
                'max:255',
                Rule::unique('projects')->where(fn ($query) => $query->where('team_id', session('team')->id))
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.nazwa' => 'Podaj nazwe',
            'name.unique' => 'Projekt o takiej nazwie juz istnieje'
        ];
    }
}
