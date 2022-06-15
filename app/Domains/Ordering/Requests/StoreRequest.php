<?php

declare(strict_types=1);

namespace App\Domains\Ordering\Requests;

use App\Domains\Address\Models\Address;
use App\Domains\Address\Repositories\AddressRepository;
use App\Domains\Shared\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'address_id'   => 'nullable',
            'address'      => 'nullable',
            'first_name'   => 'nullable',
            'last_name'    => 'nullable',
            'zip_code'     => 'nullable',
            'city'         => 'nullable',
            'country'      => 'nullable',
            'phone_number' => 'nullable',
            'cart_items'   => 'nullable',
        ];
    }

    /**
     * @param mixed $validator
     * 
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (request()->has('address_id')) {
                $address = app(AddressRepository::class)->findById(request()->has('address_id'));
                $this->addressModel = $address;

                $user = auth()->user();

                if (optional(optional($address)->user)->id != optional($user)->id) {
                    return $validator->errors()->add('doesnt_has_address', 'You can not use this address');
                }
            }
        });
    }

    /**
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->addressModel;
    }
}