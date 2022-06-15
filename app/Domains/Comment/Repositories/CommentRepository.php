<?php

declare(strict_types=1);

namespace App\Domains\Comment\Repositories;

use App\Domains\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

class CommentRepository implements CommentRepositoryInterface
{    
    /**
     * getByProductSlug
     *
     * @param  string $productSlug
     * @return Builder
     */
    public function getByProductSlug(string $productSlug): Builder
    {
        return Comment::join('products', 'products.id', '=', 'comments.product_id')
        ->where('products.slug', '=', $productSlug);
    }
    
    /**
     * putContent
     *
     * @param  string $content
     * @param  Comment $comment
     * @return Comment
     */
    public function putContent(string $content, Comment $comment): Comment
    {
        $comment->content = $content;
        $comment->save();

        return $comment;
    }
    
    /**
     * create
     *
     * @param  array $data
     * @return Comment
     */
    public function create(array $data): Comment
    {
        $comment             = new Comment;
        $comment->product_id = $data['product_id'];
        $comment->content    = $data['content'];
        $comment->user_id    = $data['user_id'];

        $comment->save();

        return $comment;
    }
    
    /**
     * destroy
     *
     * @param  Comment $comment
     * @return bool
     */
    public function destroy(Comment $comment): bool
    {
        return $comment->delete();
    }
}