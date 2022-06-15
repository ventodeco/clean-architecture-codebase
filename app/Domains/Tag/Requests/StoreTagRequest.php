<?php

declare(strict_types=1);

namespace App\Domains\Tag\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{    
    /**
     * authorize
     *
     * @return void
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * rules
     *
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
     *
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