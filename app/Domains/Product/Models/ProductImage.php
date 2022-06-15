<?php

declare(strict_types=1);

namespace App\Domains\Product\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends FileUpload
{
    protected $table = 'file_uploads';
    protected $fillable = ['file_name', 'file_path', 'original_name', 'product_id'];

    /**
     * relation to product
     *
     * @return BelongsTo
     */
    protected function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('product_image', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('type', 'product_image');
        });

        static::creating(function ($productImage) {
            $productImage->type = 'product_image';
        });
    }

}