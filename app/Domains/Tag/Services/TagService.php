<?php

declare(strict_types=1);

namespace App\Domains\Tag\Services;

use App\Domains\Product\Models\Product;
use App\Domains\Tag\Repositories\TagRepository;

class TagService
{    
    /**
     * __construct
     *
     * @param  mixed $repository
     * @return void
     */
    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * createTagAndSyncToProduct
     *
     * @param array|null $tagsInput
     * @param array|null $tagNames
     * @param Product $product
     * 
     * @return void
     */
    public function createTagAndSyncToProduct(
        ?array $tagsInput,
        ?array $tagNames,
        Product $product
    ): void
    {
        if (is_null($tagNames)) {
            return;
        }

        $tags = array_map(function ($name) use ($tagsInput) {
            $description = $tagsInput[$name];
            return $this->repository
                    ->findOrCreate([
                        'name' => $name,
                        'description' => $description
                    ])->id;
        }, $tagNames);

        $product->tags()->sync($tags);

        return;
    }
}