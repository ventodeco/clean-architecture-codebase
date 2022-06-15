<?php

namespace App\Domains\Tag\Dtos;

use App\Domains\Shared\Dtos\PageMeta;
use App\Domains\Tag\Dtos\Partials\BasicTagDto;

class TagListDto
{
    /**
     * @param mixed $tags
     * @param string $base_path
     * @param bool $includeUrls
     * 
     * @return void
     */
    public static function build($tags, $base_path = '/tags', $includeUrls = false)
    {
        $tagDtos = [];
        foreach ($tags->items() as $tag) {
            $tagDtos[] = BasicTagDto::build($tag, $includeUrls);
        }

        return [
            'page_meta' => PageMeta::build($tags, $base_path),
            'tags'      => $tagDtos
        ];

    }
}