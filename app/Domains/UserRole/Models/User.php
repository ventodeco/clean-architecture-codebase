<?php

namespace App\Domains\UserRole\Models;

use App\Domains\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasApiTokens;

    public $timestamps = true;

    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * check role is it admin?
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(Role::ROLE_ADMIN);
    }

    /**
     * hasRole
     *
     * @param  mixed $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->roles->where('name', $role)->isNotEmpty();
    }

    /**
     * relation to comments
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * relation to roles
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles')->withTimestamps();
    }

    /**
     * relation to orders
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::updating(function ($model) {
            if ($model->roles()->count() == 0)
                $model->roles()->sync(Role::where('name', Role::ROLE_USER)->first());
        });
    }

    /**
     * getJWTIdentifier
     *
     * @return void
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * getJWTCustomClaims
     *
     * @return void
     */
    public function getJWTCustomClaims()
    {
        $roles = [];
        for ($i = 0; $i < $this->roles->count(); $i++) {
            $roles[] = $this->roles()->get()[0]->name;
        }

        return [
            'user_id'  => $this->id,
            'username' => $this->username,
            'roles'    => $roles,
        ];
    }
}