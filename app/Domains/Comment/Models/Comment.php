<?php

declare(strict_types=1);

namespace App\Domains\Comment\Models;

use App\Domains\Product\Models\Product;
use App\Domains\UserRole\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'product_id',
        'content',
    ];
    
    /**
     * relation to user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * relation to product
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}