<?php

namespace App\Domains\Comment\Dtos\Partials;

class CommentsCountDto
{
    private $commentsCount;
    
    /**
     * build
     *
     * @param  mixed $comments
     * @return CommentsCountDto
     */
    public static function build($comments): CommentsCountDto
    {
        $commentCount = new CommentsCountDto();
        if ($comments == null) 
            $commentCount->setCommentsCount(0);
        else
            $commentCount->setCommentsCount($comments->size());

        return $commentCount;
    }
    
    /**
     * getCommentsCount
     * @return int
     */
    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }
    
    /**
     * setCommentsCount
     *
     * @param  int $commentsCount
     * @return void
     */
    public function setCommentsCount(int $commentsCount): void
    {
        $this->commentsCount = $commentsCount;
    }
}
