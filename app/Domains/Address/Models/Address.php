<?php

declare(strict_types=1);

namespace App\Domains\Address\Models;

use App\Domains\Ordering\Models\Order;
use App\Domains\UserRole\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'city',
        'address',
        'country',
        'zip_code',
        'first_name',
        'last_name',
        'phone_number'
    ];
    
    /**
     * relation to user
     *
     * @return BelongsTo
     */
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * relation to orders
     *
     * @return HasMany
     */
    function orders(): HasMany
    {
        return $this->HasMany(Order::class);
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
}