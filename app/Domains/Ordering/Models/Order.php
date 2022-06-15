<?php

declare(strict_types=1);

namespace App\Domains\Ordering\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public const ORDERED = 0;
    public const IN_TRANSIT = 1;
    public const DELIVERED = 2;

    const status_choices = [
        0 => 'ordered',
        1 => 'in_transit',
        2 => 'delivered'
    ];

    protected $fillable = [
        'address_id'
    ];

    /**
     * relation to orderItems
     *
     * @return HasMany
     */
    function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    
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
     * relation to address
     *
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
    
    /**
     * get totalPrice
     *
     * @return void
     */
    public function totalPrice()
    {
        $price = 0.0;
        foreach ($this->orderItems as $orderItem) {
            $price += (int)$orderItem->price;
        }

        return $price;
    }
    
    /**
     * get latest
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}