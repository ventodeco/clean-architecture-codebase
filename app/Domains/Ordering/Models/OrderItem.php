<?php

declare(strict_types=1);

namespace App\Domains\Ordering\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'slug',
        'price',
        'quantity'
    ];
    
    /**
     * relation to order
     *
     * @return BelongsTo
     */
    function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    
    /**
     * relation to product
     *
     * @return BelongsTo
     */
    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}