<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Domains\Product\Dtos\ProductListDto;
use App\Domains\Product\Models\Product;
use App\Domains\Shared\Requests\PageRequest;
use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{    
    /**
     * show all product list
     *
     * @param PageRequest $request
     * 
     * @return void
     */
    public function __invoke(PageRequest $request)
    {
        $products = Product::latest()
            ->withCount('comments')
            ->paginate($request->getPageSize());

        return $this->sendSuccess(ProductListDto::build($products, $request->path()));
    }
}