<?php

declare(strict_types=1);

namespace App\Domains\Tag\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description'
    ];
    
    /**
     * products
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * tagImages
     *
     * @return HasMany
     */
    public function tagImages(): HasMany
    {
        return $this->hasMany(TagImage::class);
    }

    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }
    
    /**
     * boot
     *
     * @return void
     */
    static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->slug = str_slug($model->name);
        });

        self::updating(function ($model) {
            $model->slug = str_slug($model->name);
        });
    }

}