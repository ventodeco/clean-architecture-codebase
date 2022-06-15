<?php

declare(strict_types=1);

namespace App\Http\Controllers\Comment;

use App\Domains\Comment\Dtos\CommentDetailsDto;
use App\Domains\Comment\Models\Comment;
use App\Domains\Comment\Repositories\CommentRepository;
use App\Domains\Comment\Requests\StoreCommentRequest;
use App\Domains\Product\Models\Product;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class StoreController extends BaseController
{    
    /**
     * store comment
     *
     * @param  StoreCommentRequest $request
     * @param  Product $product
     * @return void
     */
    public function __invoke(
        StoreCommentRequest $request,
        Product $productSlug
    ) {
        $this->middleware('jwt.verify');
        $this->authorize('create', Comment::class);

        $comment = app(CommentRepository::class)->create([
            'product_id' => $productSlug->id,
            'content'    => $request->content,
            'user_id'    => Auth::user()->id,
        ]);

        return $this->sendSuccessResponse(CommentDetailsDto::build($comment), 'Comment created successfully');
    }
}