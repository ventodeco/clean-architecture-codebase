<?php

namespace App\Domains\Shared\Dtos;

class SuccessResponse extends AppResponse
{
    public function __construct() {}
    
    /**
     * SuccessResponse
     *
     * @param  mixed $message
     * @return void
     */
    public function SuccessResponse(String $message) {
        $this->addFullMessage($message);
    }
    
    /**
     * build
     *
     * @return void
     */
    public static function build() {
        return [
            'success' => true
        ];
    }
}
