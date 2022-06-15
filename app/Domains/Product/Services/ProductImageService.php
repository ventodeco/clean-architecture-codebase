<?php

declare(strict_types=1);

namespace App\Domains\Product\Services;

use App\Domains\Ordering\Repositories\OrderItemRepository;
use App\Domains\Product\Repositories\ProductRepository;
use Exception;

class ProductImageService
{
    /**
     * @param ProductRepository $repository
     * @param OrderItemRepository $orderItermRepository
     */
    public function __construct(
        ProductRepository $repository,
        OrderItemRepository $orderItermRepository
    ) {
        $this->repository           = $repository;
        $this->orderItermRepository = $orderItermRepository;
    }

    /**
     * @param mixed $images
     * @param int $productId
     * 
     * @return void
     */
    public function insertBulkProductImages($images, int $productId)
    {
        if (is_null($images)) {
            return;
        }

        $data = [];
        foreach ($images as $image) {
            $filepath = $image->store('/products');
            $datum = [
                'product_id'    => $productId,
                'file_name'     => explode('/', $filepath)[1],
                'file_path'     => '/storage/' . $filepath,
                'original_name' => $image->getClientOriginalName()
            ];

            $data[] = $datum;
        }

        app(ProductImageRepository::class)->bulkInsert($data);

        return;
    }
}