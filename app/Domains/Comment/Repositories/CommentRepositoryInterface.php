<?php

declare(strict_types=1);

namespace App\Domains\Comment\Repositories;

use App\Domains\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

interface CommentRepositoryInterface
{
    public function getByProductSlug(string $productSlug): Builder;
    public function putContent(string $content, Comment $comment): Comment;
    public function create(array $data): Comment;
}