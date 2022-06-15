<?php

namespace App\Domains\Category\Models;

use App\Domains\Product\Models\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryImage extends FileUpload
{

    protected $table = 'file_uploads';
    protected $fillable = [
        'file_name',
        'file_path',
        'original_name',
        'category_id'
    ];
    
    /**
     * relation to category
     *
     * @return BelongsTo
     */
    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('category_image', function (Builder $builder) {
            $builder->where('type', 'category_image');
        });

        static::creating(function ($categoryImage) {
            $categoryImage->type = 'category_image';
        });
    }
}