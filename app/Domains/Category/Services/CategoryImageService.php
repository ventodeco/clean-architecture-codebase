<?php

namespace App\Domains\Category\Services;

use App\Domains\Category\Repositories\CategoryImageRepository;
use App\Domains\Product\Models\Product;

class CategoryImageService
{
    public function __construct(CategoryImageRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * insertBulkImage
     *
     * @param  mixed $images
     * @param  mixed $categoryId
     * 
     * @return void
     */
    public function insertBulkImage(
        $images,
        int $categoryId
    ): void
    {
        if (is_null($images)) {
            return;
        }

        foreach ($images as $image) {
            $filepath = $image->store('/categories');
            $datum = [
                'category_id' => $categoryId,
                'file_name' => explode('/', $filepath)[1],
                'file_path' => '/storage/' . $filepath,
                'original_name' => $image->getClientOriginalName()
            ];

            $data[] = $datum;
        }

        app(CategoryImageRepository::class)->insertBulk($data);

        return;
    }
}