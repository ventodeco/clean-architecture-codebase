<?php

declare(strict_types=1);

namespace App\Domains\Comment\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|min:2|max:500'
        ];
    }
}