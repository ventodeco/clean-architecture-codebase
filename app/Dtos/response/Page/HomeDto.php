<?php

namespace App\Dtos\response\Page;

use App\Domains\Category\Dtos\Partials\BasicCategoryDto;
use App\Domains\Tag\Dtos\Partials\BasicTagDto;

class HomeDto
{
    /**
     * @param mixed $tags
     * @param mixed $categories
     * @param bool $includeUrls
     * 
     * @return void
     */
    public static function build($tags, $categories, $includeUrls = true)
    {
        foreach ($tags as $key => $category) {
            $tagDtos[] = BasicTagDto::build($category, $includeUrls, $includeUrls);
        }

        foreach ($categories as $key => $category) {
            $categoryDtos[] = BasicCategoryDto::build($category, $includeUrls, $includeUrls);
        }
        return [
            'tags' => $tagDtos,
            'categories' => $categoryDtos,
        ];
    }
}