<?php

declare(strict_types=1);

namespace App\Domains\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => 'required|max:255',
            'description' => 'required',
            'price'       => 'required',
            'stock'       => 'required',
            'tags'        => 'nullable',
            'categories'  => 'nullable',
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