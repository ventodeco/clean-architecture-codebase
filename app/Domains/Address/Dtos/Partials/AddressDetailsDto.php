<?php

namespace App\Domains\Address\Dtos\Partials;

use App\Domains\Address\Models\Address;

class AddressDetailsDto
{    
    /**
     * build
     *
     * @param Address $address
     * @param bool $includeUser
     * @return void
     */
    public static function build(Address $address, $includeUser = false)
    {
        $data = [
            'id'       => $address->id,
            'city'     => $address->city,
            'address'  => $address->address,
            'country'  => $address->country,
            'zip_code' => $address->zip_code,
        ];

        if ($includeUser) {
            $data['user'] = $address->user;
        }

        return $data;
    }
}