<?php

namespace App\Http\Requests;

use App\Category;
use App\Specific;
use App\Type;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'required', 'min:3', Rule::unique((new Category)->getTable())->ignore($this->route()->category->id ?? null)
            ],
            'equip_specifics' => [
                
            ],
            'equip_specifics.*' => [
                'exists:'.(new Specific)->getTable().',id'
            ],
            'truck_specifics' => [
                
            ],
            'truck_specifics.*' => [
                'exists:'.(new Specific)->getTable().',id'
            ],
            'equip_info' => [
                'nullable'
            ],
            'truck_mounted' => [
                'nullable'
            ],
            'type_id' => [
                'required', 'exists:'.(new Type)->getTable().',id'
            ],
            'title1' => [
                'required'
            ],
            'title2' => [
                'required'
            ],
            'title3' => [
                'nullable'
            ],
            'title4' => [
                'nullable'
            ]
        ];
    }
}
