<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tag;

use App\Domains\Shared\Requests\PageRequest;
use App\Domains\Tag\Dtos\TagListDto;
use App\Domains\Tag\Models\Tag;
use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{    
    /**
     * show all tag list
     *
     * @param PageRequest $request
     * 
     * @return void
     */
    public function __invoke(PageRequest $request)
    {
        $tags = Tag::latest()->paginate($request->getPageSize());

        return $this->sendSuccess(TagListDto::build($tags, $request->path(), true));
    }
}