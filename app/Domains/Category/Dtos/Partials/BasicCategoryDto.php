<?php

namespace App\Domains\Category\Dtos\Partials;

use App\Domains\Category\Models\Category;

class BasicCategoryDto
{    
    /**
     * @param Category $category
     * @param bool $includeUrls
     * 
     * @return array
     */
    public static function build(Category $category, $includeUrls = false): array
    {
        $dto = [
            'id'          => $category->id,
            'name'        => $category->name,
            'slug'        => $category->slug,
            'description' => $category->description,
        ];

        if ($includeUrls)
            $dto['image_urls'] = $category->categoryImages->pluck('file_path');

        return $dto;
    }

}