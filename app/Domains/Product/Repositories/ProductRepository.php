<?php

declare(strict_types=1);

namespace App\Domains\Product\Repositories;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{    
    /**
     * findByIds
     *
     * @param  array $ids
     * @return Collection
     */
    public function findByIds(array $ids): Collection
    {
        return Product::whereIn('id', $ids)->get();
    }
    
    /**
     * findBySlug
     *
     * @param  string $slug
     * @return Product
     */
    public function getBySlug(string $slug): Product
    {
        return Product::where('slug', $slug)->first();
    }
    
    /**
     * findById
     *
     * @param  int $id
     * @return Product
     */
    public function findById(int $id): Product
    {
        return Product::find($id);
    }

    /**
     * getProductWithCategoryName
     *
     * @param  string $categoryName
     * @return Builder
     */
    public function getProductWithCategoryName(string $categoryName): Builder
    {
        return Product::whereHas('categories', function ($query) use ($categoryName) {
            $query->where('slug', $categoryName);
        });
    }

    /**
     * create
     *
     * @param  array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        $product              = new Product;
        $product->name        = $data['name'];
        $product->description = $data['description'];
        $product->price       = $data['price'];
        $product->stock       = $data['stock'];

        $product->save();

        return $product;
    }
}