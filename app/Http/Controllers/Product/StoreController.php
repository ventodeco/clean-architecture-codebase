<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Domains\Category\Services\CategoryService;
use App\Domains\Product\Dtos\ProductDetailsDto;
use App\Domains\Product\Repositories\ProductRepository;
use App\Domains\Product\Requests\StoreProductRequest;
use App\Domains\Product\Services\ProductImageService;
use App\Domains\Tag\Services\TagService;
use App\Http\Controllers\BaseController;

class StoreController extends BaseController
{    
    /**
     * Store the product
     *
     * @param StoreProductRequest $request
     * 
     * @return void
     */
    public function __invoke(StoreProductRequest $request)
    {
        $this->middleware('jwt.verify');

        $product = app(ProductRepository::class)->create($request->only('name', 'description', 'price', 'stock'));

        $tagsInput       = $request->tags;
        $tagNames        = array_keys($request->tags);
        $categoriesInput = $request->categories;
        $categoryNames   = array_keys($request->categories);

        app(TagService::class)->createTagAndSyncToProduct($tagsInput, $tagNames, $product);

        app(CategoryService::class)->createCategoryAndSyncToProduct($categoriesInput, $categoryNames, $product);

        app(ProductImageService::class)->insertBulkProductImages($request->images, $product->id);

        return $this->sendSuccessResponse(ProductDetailsDto::build($product), 'Created successfully');
    }
}