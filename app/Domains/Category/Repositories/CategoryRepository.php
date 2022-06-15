<?php

declare(strict_types=1);

namespace App\Domains\Category\Repositories;

use App\Domains\Category\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @param array $data
     * 
     * @return Category
     */
    public function findOrCreate(array $data): Category
    {
        return Category::firstOrCreate([
            'name'        => $data['name'],
            'description' => $data['description'],
        ]);
    }
}