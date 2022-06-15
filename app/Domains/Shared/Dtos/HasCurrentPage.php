<?php

namespace App\Domains\Shared\Dtos;

trait HasCurrentPage
{
    private $currentPageNumber;
    private $currentItemsCount;

    /**
     * getCurrentPageNumber
     *
     * @return void
     */
    public function getCurrentPageNumber()
    {
        return $this->currentPageNumber;
    }

    /**
     * setCurrentPageNumber
     *
     * @param  mixed $currentPageNumber
     * @return void
     */
    public function setCurrentPageNumber(int $currentPageNumber)
    {
        $this->currentPageNumber = $currentPageNumber;
    }

    /**
     * getCurrentItemsCount
     *
     * @return void
     */
    public function getCurrentItemsCount()
    {
        return $this->currentItemsCount;
    }
    
    /**
     * setCurrentItemsCount
     *
     * @param  mixed $currentItemsCount
     * @return void
     */
    public function setCurrentItemsCount(int $currentItemsCount)
    {
        $this->currentItemsCount = $currentItemsCount;
    }
}