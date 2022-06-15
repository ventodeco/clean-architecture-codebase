<?php

declare(strict_types=1);

namespace App\Http\Controllers\Comment;

use App\Domains\Comment\Dtos\CommentListDto;
use App\Domains\Comment\Repositories\CommentRepository;
use App\Domains\Shared\Requests\PageRequest;
use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{    
    /**
     * show all comment
     *
     * @param  PageRequest $request
     * @param  string $productSlug
     * @return void
     */
    public function __invoke(PageRequest $request, string $productSlug)
    {
        $comments = app(CommentRepository::class)
                    ->getByProductSlug($productSlug)
                    ->paginate($request->getPageSize());

        return $this->sendSuccess(CommentListDto::build($comments, $request->path(), false, true));
    }
}