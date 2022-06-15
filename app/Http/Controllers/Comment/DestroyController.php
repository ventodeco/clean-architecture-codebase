<?php

declare(strict_types=1);

namespace App\Http\Controllers\Comment;

use App\Domains\Comment\Dtos\CommentListDto;
use App\Domains\Comment\Models\Comment;
use App\Domains\Comment\Repositories\CommentRepository;
use App\Domains\Product\Models\Product;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class DestroyController extends BaseController
{    
    /**
     * destroy comment
     *
     * @param  Product $product
     * @param  Comment $comment
     * @return void
     */
    public function __invoke(Product $productSlug, Comment $comment)
    {
        $this->middleware('jwt.verify');

        if (Auth::user()->cant('delete', $comment)) {
            return $this->sendError('Access denied');
        }

        $this->authorize('delete', $comment);

        app(CommentRepository::class)->destroy($comment);

        return $this->sendSuccessResponse(null, 'Comment deleted successfully');
    }
}