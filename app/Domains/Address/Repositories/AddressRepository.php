<?php

declare(strict_types=1);

namespace App\Domains\Address\Repositories;

use App\Domains\Address\Models\Address;
use Illuminate\Database\Eloquent\Builder;

class AddressRepository implements AddressRepositoryInterface
{    
    /**
     * find address by id
     *
     * @param  int $id
     * @return Address
     */
    public function findById(int $id): Address
    {
        return Address::find($id);
    }

    /**
     * create address
     *
     * @param  array $data
     * @return Address
     */
    public function create(array $data): Address
    {
        $address               = new Address;
        $address->address      = $data['address'];
        $address->first_name   = $data['first_name'];
        $address->last_name    = $data['last_name'];
        $address->zip_code     = $data['zip_code'];
        $address->city         = $data['city'];
        $address->country      = $data['country'];
        $address->phone_number = $data['phone_number'];

        $address->save();

        return $address;
    }
    
    /**
     * get By User Id
     *
     * @param  mixed $userId
     * @return Builder
     */
    public function getByUserId(int $userId): Builder
    {
        return Address::where('user_id', $userId);
    }
}