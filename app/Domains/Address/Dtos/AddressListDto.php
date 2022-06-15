<?php

namespace App\Domains\Address\Dtos;

use App\Domains\Address\Dtos\Partials\AddressDetailsDto;
use App\Domains\Shared\Dtos\PageMeta;

class AddressListDto
{    
    /**
     * build
     *
     * @param mixed $addresses
     * @param string $basePath
     * @param bool $includeUser
     * @return void
     */
    public static function build(
        $addresses,
        string $basePath,
        $includeUser = false
    ) {
        $addresseDtos = array();

        foreach ($addresses as $address) {
            $addresseDtos[] = AddressDetailsDto::build($address, $includeUser);
        }

        return ['success' => true, 'page_meta' => PageMeta::build($addresses, $basePath), 'addresses' => $addresseDtos];
    }
}