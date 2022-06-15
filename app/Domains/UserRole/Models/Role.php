<?php

declare(strict_types=1);

namespace App\Domains\UserRole\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';

    public $timestamps = true;

    protected $fillable = [
        'name'
    ];
    
    /**
     * relation to users
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_roles', 'role_id', 'user_id')->withTimestamps();
    }
}