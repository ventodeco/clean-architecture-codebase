<?php

declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Domains\Category\Dtos\CategoryListDto;
use App\Domains\Category\Models\Category;
use App\Domains\Shared\Requests\PageRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{    
    /**
     * show all category
     *
     * @param  Request $request
     * @return void
     */
    public function __invoke(PageRequest $request)
    {
        $this->middleware('jwt.check');

        $tags = Category::latest()->paginate($request->getPageSize());

        return $this->sendSuccess(CategoryListDto::build($tags, $request->path(), true));
    }
}