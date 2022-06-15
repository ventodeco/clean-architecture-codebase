<?php

declare(strict_types=1);

namespace App\Http\Controllers\Order;

use App\Domains\Ordering\Dtos\OrderListDto;
use App\Domains\Ordering\Repositories\OrderRepository;
use App\Domains\Shared\Requests\PageRequest;
use App\Http\Controllers\BaseController;
use Tymon\JWTAuth\Facades\JWTAuth;

class IndexController extends BaseController
{    
    /**
     * show all order by user
     *
     * @param  PageRequest $request
     * @return void
     */
    public function __invoke(PageRequest $request)
    {
        $this->middleware('jwt.check');
        $user = JWTAuth::parseToken()->authenticate();

        $products = app(OrderRepository::class)
                    ->getByUserId($user->id)
                    ->latest()
                    ->paginate($request->getPageSize());

        return $this->sendSuccess(OrderListDto::build($products, $request->path()));
    }
}