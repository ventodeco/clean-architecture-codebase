<?php

namespace App\Domains\Category\Services;

use App\Domains\Category\Models\Category;
use App\Domains\Category\Repositories\CategoryRepository;
use App\Domains\Product\Models\Product;

class CategoryService
{
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * createCategoryAndSyncToProduct
     *
     * @param array|null $categoriesInput
     * @param array|null $categoryNames
     * @param Product $product
     * 
     * @return void
     */
    public function createCategoryAndSyncToProduct(
        ?array $categoriesInput,
        ?array $categoryNames,
        Product $product
    ) {
        if (is_null($categoryNames)) {
            return;
        }

        $categories = array_map(function ($name) use ($categoriesInput) {
            $description = $categoriesInput[$name];
            return $this->repository->findOrCreate([
                'name'        => $name,
                'description' => $description
            ]);
        }, $categoryNames);

        $product->categories()->saveMany($categories);
    }
}