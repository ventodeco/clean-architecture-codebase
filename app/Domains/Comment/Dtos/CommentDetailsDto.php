<?php

namespace App\Domains\Comment\Dtos;

use App\Domains\Comment\Models\Comment;
use App\Domains\Product\Dtos\Partials\ProductElementalDto;
use App\Domains\UserRole\Dtos\Partials\UserOnlyUsernameDto;

class CommentDetailsDto
{
    
    /**
     * build
     *
     * @param Comment $comment
     * @param bool $includeProduct
     * @param bool $includeUser
     * @return void
     */
    public static function build(
        Comment $comment,
        bool $includeProduct = false,
        bool $includeUser = false
    ) {
        $data = [
            'id'         => $comment->id,
            'content'    => $comment->content,
            'created_at' => $comment->created_at->toDateTimeString(),
            'updated_at' => $comment->updated_at->toDateTimeString(),
        ];

        if ($includeUser) {
            $data['user'] = UserOnlyUsernameDto::build($comment->user);
        }

        if ($includeProduct) {
            $data['product'] = ProductElementalDto::build($comment->product);
        }

        return $data;
    }

}

