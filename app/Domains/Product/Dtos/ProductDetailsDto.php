<?php

namespace App\Domains\Product\Dtos;

use App\Domains\Category\Dtos\Partials\BasicCategoryDto;
use App\Domains\Comment\Dtos\CommentDetailsDto;
use App\Domains\Product\Models\Product;
use App\Domains\Tag\Dtos\Partials\BasicTagDto;

class ProductDetailsDto
{
    /**
     * @param Product $product
     * 
     * @return array
     */
    public static function build(Product $product): array
    {
        $commentDtos = [];
        foreach ($product->comments as $comment) {
            $commentDtos[] = CommentDetailsDto::build($comment);
        }

        $categoryDtos = [];
        foreach ($product->categories as $category) {
            $categoryDtos[] = BasicCategoryDto::build($category);
        }

        $tagDtos = [];
        foreach ($product->tags as $tag) {
            $tagDtos[] = BasicTagDto::build($tag);
        }

        return [
            'id'          => $product->id,
            'name'        => $product->name,
            'slug'        => $product->slug,
            'description' => $product->description,
            'comments'    => $commentDtos,
            'categories'  => $categoryDtos,
            'tags'        => $tagDtos,
            'views'       => (int)$product->views,
            'image_urls'  => $product->images->pluck('file_path')
        ];
    }
}
