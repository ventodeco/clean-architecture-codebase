<?php

declare(strict_types=1);

namespace App\Domains\Tag\Services;

use App\Domains\Product\Models\Product;
use App\Domains\Tag\Repositories\TagImageRepository;

class TagImageService
{    
    /**
     * __construct
     *
     * @param  TagImageRepository $repository
     * @return void
     */
    public function __construct(TagImageRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * insertBulkImage
     *
     * @param  mixed $images
     * @param  mixed $tagId
     * @return void
     */
    public function insertBulkImage(
        $images,
        int $tagId
    ): void
    {
        if (is_null($images)) {
            return;
        }

        $data = [];
        foreach ($images as $image) {
            $filepath = $image->store('/tags');
            $datum = [
                'tag_id' => $tagId,
                'file_name' => explode('/', $filepath)[1],
                'file_path' => '/storage/' . $filepath,
                'original_name' => $image->getClientOriginalName()
            ];
            $data[] = $datum;
        }

        $this->repository->insertBulk($data);
    }
}