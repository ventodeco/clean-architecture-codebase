<?php

declare(strict_types=1);

namespace App\Domains\Product\Models;

use App\Domains\Comment\Models\Comment;
use App\Domains\Category\Models\Category;
use App\Domains\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'price',
        'slug',
        'publish_on',
        'stock',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'published_at'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @param Builder $query
     * @param string|null $search
     * 
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        }
    }

    /**
     * @param Builder $query
     * 
     * @return Builder
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }
    
    /**
     * relation to images
     *
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
    
    /**
     * relation to comments
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * relation to categories
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'products_categories');
    }
    
    /**
     * relation to tags
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'products_tags');
    }

   /**
    * @return void
    */
    static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->slug = str_slug($model->name);
            if($model->publish_on == null)
                $model->publish_on =  now();
        });

        self::updating(function ($model) {
            $model->slug = str_slug($model->name);
        });
    }
}