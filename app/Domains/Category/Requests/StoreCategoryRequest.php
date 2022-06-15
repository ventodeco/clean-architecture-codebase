<?php

declare(strict_types=1);

namespace App\Domains\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    /**
     * rules
     * @return void
     */
    public function rules()
    {
        return [
            'name'        => 'required|min:2|max:500',
            'description' => 'required|min:2|max:500'
        ];
    }
    
    /**
     * messages
     * @return void
     */
    public function messages()
    {
        return [
            'name.required'        => 'You must provide a name for the product',
            'description.required' => 'You must provide a description for your product'
        ];
    }
}