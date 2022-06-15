<?php

namespace App\Domains\Category\Models;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * realtion to products
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * relation to categoryImages
     *
     * @return HasMany
     */
    public function categoryImages(): HasMany
    {
        return $this->hasMany(CategoryImage::class);
    }
    
    /**
     * get latest
     *
     * @param  mixed $query
     * @return Builder
     */
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