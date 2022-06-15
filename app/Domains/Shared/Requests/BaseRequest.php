<?php

namespace App\Domains\Shared\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /** @var Validator */
    public $failedValidator;

    /**
     *  Override of failedValidation
     *  This method is overriden to prevent FormRequest from throwing error.
     *  @param Validator $validator
     *  @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $this->failedValidator = $validator;
    }

    /**
     *  Check whether the form request validation fails
     *
     *  @return bool
     */
    public function isValidationFailed(): bool
    {
        return !is_null($this->failedValidator) && ($this->failedValidator->fails());
    }
}
