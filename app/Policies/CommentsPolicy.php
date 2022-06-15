<?php

namespace App\Policies;

use App\Domains\UserRole\Models\User;
use App\Domains\Comment\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentsPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Comment $comment
     * 
     * @return void
     */
    public function view(User $user, Comment $comment) {}

    /**
     * @param User $user
     * 
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /**
     * @param User $user
     * @param Comment $comment
     * 
     * @return bool
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user !== null && $user->id === $comment->user->id;
    }

    /**
     * @param User $user
     * @param Comment $comment
     * 
     * @return bool
     */
    public function delete(User $user, Comment $comment): bool
    {
        foreach ($user->roles as $role) {
            if ($role->name === 'ROLE_ADMIN')
                return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Comment $comment
     * 
     * @return void
     */
    public function restore(User $user, Comment $comment) {}

    /**
     * @param User $user
     * @param Comment $comment
     * 
     * @return void
     */
    public function forceDelete(User $user, Comment $comment) {}
}
