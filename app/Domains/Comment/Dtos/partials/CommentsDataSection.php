<?php

namespace App\Domains\Comment\Dtos\Partials;

use App\Domains\Comment\Dtos\CommentDetailsDto;
use App\Domains\Shared\Dtos\AbstractPagedDto;

class CommentsDataSection extends AbstractPagedDto
{    
    /**
     * build
     *
     * @param  mixed $pageMeta
     * @param  mixed $comments
     * @param  mixed $includeProduct
     * @param  mixed $includeUser
     * @return void
     */
    public static function build(
        $pageMeta,
        $comments,
        $includeProduct = false,
        $includeUser = false
    ) {
        $commentArrayList = [];
        foreach ($comments as $key => $comment) {
            $commentArrayList[] = CommentDetailsDto::build($comment, $includeProduct, $includeUser);
        }

        return [
            'page_meta' => $pageMeta,
            'comments' => $commentArrayList
        ];
    }

}
