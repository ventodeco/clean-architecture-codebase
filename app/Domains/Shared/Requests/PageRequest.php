<?php

declare(strict_types=1);

namespace App\Domains\Shared\Requests;

use App\Domains\Shared\Requests\BaseRequest;
use Illuminate\Pagination\Paginator;

class PageRequest extends BaseRequest
{    
    /**
     * authorize
     * @return void
     */
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
            'page'      => 'nullable',
            'page_size' => 'nullable'
        ];
    }

    /**
     * @return void
     */
    public function getPageSize()
    {
        $page = $this->page ?? 1;
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        return $this->page_size ?? 10;
    }
}