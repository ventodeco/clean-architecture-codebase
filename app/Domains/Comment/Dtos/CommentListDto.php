<?php

namespace App\Domains\Comment\Dtos;

use App\Domains\Comment\Dtos\Partials\CommentsDataSection;
use App\Domains\Shared\Dtos\PageMeta;
use App\Domains\Shared\Dtos\SuccessResponse;

class CommentListDto
{    
    /**
     * build
     *
     * @param  mixed $comments
     * @param  string $base_path
     * @param  bool $includeProduct
     * @param  bool $includeUser
     * @return void
     */
    public static function build(
        $comments, 
        string $base_path = '/products',
        bool $includeProduct = false,
        bool $includeUser = false
    ) {
        $commentsDataSection = CommentsDataSection::build(
                                    PageMeta::build($comments, $base_path),
                                    $comments->items(),
                                    $includeProduct,
                                    $includeUser
                                );

        return array_merge(SuccessResponse::build(), [
            'data' => $commentsDataSection
        ]);
    }
}
