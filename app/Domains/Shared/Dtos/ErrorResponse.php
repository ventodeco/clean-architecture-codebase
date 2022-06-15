<?php

namespace App\Domains\Shared\Dtos;

class ErrorResponse extends AppResponse
{
    protected $errors;
    
    /**
     * __construct
     *
     * @param  mixed $errors
     * @return void
     */
    public function __construct($errors)
    {
        $this->errors = $errors;
        if ($this->getFullMessages() == null)
            $this->setFullMessages(array() <> (null));
    }
    
    /**
     * getErrors
     * @return void
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * setErrors
     *
     * @param  mixed $errors
     * @return void
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }


}
