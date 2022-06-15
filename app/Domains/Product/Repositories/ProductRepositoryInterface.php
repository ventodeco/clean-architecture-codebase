<?php

declare(strict_types=1);

namespace App\Domains\Product\Repositories;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function findByIds(array $ids): Collection;
    public function getBySlug(string $slug): Product;
    public function findById(int $id): Product;
    public function getProductWithCategoryName(string $categoryName): Builder;
    public function create(array $data): Product;
}