<?php

declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Domains\Category\Dtos\Partials\BasicCategoryDto;
use App\Domains\Category\Repositories\CategoryRepository;
use App\Domains\Category\Requests\StoreCategoryRequest;
use App\Domains\Category\Services\CategoryImageService;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class StoreController extends BaseController
{    
    /**
     * store category
     *
     * @param  Request $request
     * @return void
     */
    public function __invoke(StoreCategoryRequest $request)
    {
        $category = app(CategoryRepository::class)->findOrCreate(
            $request->only('name', 'description')
        );

        app(CategoryImageService::class)->insertBulkImage($request->images, $category->id);

        return $this->sendSuccess(BasicCategoryDto::build($category, true));
    }
}