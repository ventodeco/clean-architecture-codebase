<?php

declare(strict_types=1);

namespace App\Domains\Tag\Models;

use App\Domains\Product\Models\FileUpload;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TagImage extends FileUpload
{
    protected $table = 'file_uploads';
    protected $fillable = [
        'file_name',
        'file_path',
        'original_name',
        'tag_id'
    ];

    /**
     * realtion to tag
     *
     * @return BelongsTo
     */
    protected function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('tag_image', function (\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->where('type', 'tag_image');
        });

        static::creating(function ($tagImage) {
            $tagImage->type = 'tag_image';
        });
    }

}