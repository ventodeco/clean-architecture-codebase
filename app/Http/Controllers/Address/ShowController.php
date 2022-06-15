<?php

namespace App\Http\Controllers\Address;

use App\Domains\Address\Dtos\AddressListDto;
use App\Domains\Address\Repositories\AddressRepository;
use App\Domains\Shared\Requests\PageRequest;
use App\Http\Controllers\BaseController;
use Tymon\JWTAuth\Facades\JWTAuth;

class ShowController extends BaseController
{        
    /**
     * __invoke
     *
     * @param  PageRequest $request
     * @return void
     */
    public function __invoke(PageRequest $request)
    {
        $this->middleware('jwt.verify');
        $user = JWTAuth::parseToken()->authenticate();

        $products = app(AddressRepository::class)->getByUserId($user->id)
                    ->latest()
                    ->paginate($request->getPageSize());

        return $this->sendSuccess(AddressListDto::build($products, $request->path(), false));
    }
}