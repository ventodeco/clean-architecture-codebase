<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tag;

use App\Domains\Tag\Dtos\Partials\BasicTagDto;
use App\Domains\Tag\Repositories\TagRepository;
use App\Domains\Tag\Requests\StoreTagRequest;
use App\Domains\Tag\Services\TagImageService;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class StoreController extends BaseController
{    
    /**
     * store tag 
     *
     * @param Request $request
     * 
     * @return void
     */
    public function __invoke(StoreTagRequest $request)
    {
        $tag = app(TagRepository::class)->findOrCreate(
                    $request->only('name', 'description')
                );

        app(TagImageService::class)->insertBulkImage($request->images, $tag->id);

        return $this->sendSuccess(BasicTagDto::build($tag, true));
    }
}