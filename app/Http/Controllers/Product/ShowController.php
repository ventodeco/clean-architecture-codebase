<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Domains\Product\Dtos\ProductDetailsDto;
use App\Domains\Product\Repositories\ProductRepository;
use App\Http\Controllers\BaseController;

class ShowController extends BaseController
{    
    /**
     * show the product by slug
     *
     * @param  string $slug
     * @return void
     */
    public function __invoke(string $slug)
    {
        $product = app(ProductRepository::class)->getBySlug($slug);

        if (is_null($product)) {
            return $this->sendError('Product was not found');
        }

        $product->comments_count = $product->comments()->count();

        return $this->sendSuccessResponse(ProductDetailsDto::build($product));
    }
}