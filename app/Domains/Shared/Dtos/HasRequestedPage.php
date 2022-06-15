<?php

namespace App\Domains\Shared\Dtos;

trait HasRequestedPage
{
    private $requestedPageSize;

    /**
     * getRequestedPageSize
     *
     * @return void
     */
    public function getRequestedPageSize()
    {
        return $this->requestedPageSize;
    }
    
    /**
     * setRequestedPageSize
     *
     * @param  mixed $requestedPageSize
     * @return void
     */
    public function setRequestedPageSize(int $requestedPageSize)
    {
        $this->requestedPageSize = $requestedPageSize;
    }
}