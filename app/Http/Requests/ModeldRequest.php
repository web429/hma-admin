<?php

namespace App\Http\Requests;

use App\Modeld;
use App\Category;
use App\Make;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ModeldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
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
                'required', 'min:3', Rule::unique((new Modeld)->getTable())->ignore($this->route()->modeld->id ?? null)
            ],
            'make_id' => [
                'required', 'exists:'.(new Make)->getTable().',id'
            ],
            'category_id' => [
                'required', 'exists:'.(new Category)->getTable().',id'
            ]
        ];
    }
}
