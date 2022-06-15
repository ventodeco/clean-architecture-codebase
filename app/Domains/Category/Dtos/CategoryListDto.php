<?php

namespace App\Domains\Category\Dtos;

use App\Domains\Category\Dtos\Partials\BasicCategoryDto;
use App\Domains\Shared\Dtos\PageMeta;

class CategoryListDto
{    
    /**
     * @param mixed $categories
     * @param string $base_path
     * @param bool $includeUrls
     * 
     * @return array
     */
    public static function build($categories, $base_path = '/categories', $includeUrls = false): array
    {
        $categoryDtos = array();

        foreach ($categories->items() as $key => $category) {
            $categoryDtos[] = BasicCategoryDto::build($category, $includeUrls);
        }

        return [
            'success'    => true,
            'page_meta'  => PageMeta::build($categories, $base_path),
            'categories' => $categoryDtos
        ];
    }
}