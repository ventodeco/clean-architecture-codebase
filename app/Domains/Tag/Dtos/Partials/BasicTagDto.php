<?php

declare(strict_types=1);

namespace App\Domains\Tag\Dtos\Partials;

class BasicTagDto
{
    
    /**
     * build
     *
     * @param  mixed $tag
     * @param  bool $includeUrls
     * @return void
     */
    public static function build($tag, bool $includeUrls = false)
    {
        $dto = [
            'id'          => $tag->id,
            'name'        => $tag->name,
            'slug'        => $tag->slug,
            'description' => $tag->description,
        ];

        if ($includeUrls) {
            $dto['image_urls'] = $tag->tagImages->pluck('file_path');
        }

        return $dto;
    }
}