<?php

namespace App\Http\Controllers;

use App\Dtos\response\Page\HomeDto;
use App\Domains\Category\Models\Category;
use App\Domains\Tag\Models\Tag;
use Illuminate\Pagination\Paginator;

class PageController extends BaseController
{    
    /**
     * home
     *
     * @return void
     */
    public function home()
    {
        $page = 1;
        $page_size = 5;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $tags = Tag::orderBy('created_at', 'desc')
            ->paginate($page_size);

        $categories = Category::orderBy('created_at', 'desc')
            ->paginate($page_size);

        return $this->sendSuccess(HomeDto::build($tags->items(), $categories->items()));

    }
}