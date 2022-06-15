<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Domains\Product\Dtos\ProductDetailsDto;
use App\Domains\Product\Dtos\ProductListDto;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Repositories\ProductRepository;
use App\Domains\Shared\Requests\PageRequest;
use App\Http\Controllers\BaseController;

class GetController extends BaseController
{    
    /**
     * get product by id
     *
     * @param  int $id
     * @return void
     */
    public function byId(int $id)
    {
        $product = app(ProductRepository::class)->findById($id);

        if ($product instanceof Product) {
            return $this->sendSuccessResponse(ProductDetailsDto::build($product));
        }

        return $this->sendError('Product not found');
    }

    /**
     * get product by tag name
     *
     * @param  PageRequest $request
     * @param  string $tagName
     * @return void
     */
    public function byTag(PageRequest $request, string $tagName)
    {
        $products = Product::whereHas('tags', function ($query) use ($tagName) {
                $query->where('slug', '=', $tagName);
            })
            ->orderBy('created_at', 'desc')
            ->withCount('comments')
            ->paginate($request->getPageSize());

        return $this->sendSuccess(ProductListDto::build($products, $request->getRequestUri()));
    }
    
    /**
     * get product by category name
     *
     * @param  PageRequest $request
     * @param  string $category_name
     * @return void
     */
    public function byCategory(PageRequest $request, string $category_name)
    {
        $products = app(ProductRepository::class)->getProductWithCategoryName($category_name)
            ->latest()
            ->withCount('comments')
            ->paginate($request->getPageSize());

        return $this->sendSuccess(ProductListDto::build($products, $request->getRequestUri()));
    }
}