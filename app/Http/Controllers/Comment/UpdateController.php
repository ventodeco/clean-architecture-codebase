<?php

declare(strict_types=1);

namespace App\Http\Controllers\Comment;

use App\Domains\Comment\Dtos\CommentDetailsDto;
use App\Domains\Comment\Models\Comment;
use App\Domains\Comment\Repositories\CommentRepository;
use App\Domains\Comment\Requests\StoreCommentRequest;
use App\Domains\Product\Models\Product;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{    
    /**
     * update comment
     *
     * @param  Product $productSlug
     * @param  StoreCommentRequest $request
     * @param  Comment $comment
     * @return void
     */
    public function __invoke(
        Product $productSlug,
        StoreCommentRequest $request,
        Comment $comment
    ) {
        $this->middleware('jwt.verify');

        app(CommentRepository::class)->putContent($request->content, $comment);

        return $this->sendSuccessResponse(CommentDetailsDto::build($comment), 'Comment created successfully');
    }
}