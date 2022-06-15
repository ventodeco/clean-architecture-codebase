<?php 

namespace App\Domains\UserRole\Services;

use App\Domains\UserRole\Repositories\UserRepository;

class UserService
{    
    /**
     * __construct
     *
     * @param  mixed $repository
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * checkLoginValidation
     *
     * @param  string $username
     * @param  string $password
     * @return array
     */
    public function checkLoginValidation(string $username, string $password): array
    {
        $user = app(UserRepository::class)->findByUsername($username);
        if (is_null($user)) {
            return [null, 'invalid username'];
        }

        $valid = app('hash')->check($password, $user->getAuthPassword());

        if (! $valid) {
            return [null, 'invalid username and password'];
        }

        return [$user, null];
    }
}