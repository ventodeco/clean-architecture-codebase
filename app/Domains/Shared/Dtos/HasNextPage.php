<?php

namespace App\Domains\Shared\Dtos;

trait HasNextPage
{
    private $nextPageNumber;
    private $nextPageUrl;
    
    /**
     * isHasNextPage
     *
     * @return void
     */
    public function isHasNextPage()
    {
        return $this->hasNextPage;
    }

    /**
     * setHasNextPage
     *
     * @param  mixed $hasNext
     * @return void
     */
    public function setHasNextPage($hasNext)
    {
        $this->hasNextPage = $hasNext;
    }

    /**
     * getNextPageNumber
     *
     * @return void
     */
    public function getNextPageNumber()
    {
        return $this->nextPageNumber;
    }

    /**
     * setNextPageNumber
     *
     * @param  int $nextPageNumber
     * @return void
     */
    public function setNextPageNumber(int $nextPageNumber)
    {
        $this->nextPageNumber = $nextPageNumber;
    }

    /**
     * getNextPageUrl
     *
     * @return void
     */
    public function getNextPageUrl()
    {
        return $this->nextPageUrl;
    }

    /**
     * @param int $lastPage
     * @param string $basePath
     * @param int $requestedPerPage
     * @param int $currentPageNumber
     * 
     * @return array
     */
    public static function build(
        int $lastPage,
        string $basePath,
        int $requestedPerPage,
        int $currentPageNumber
    ): array
    {
        if ($currentPageNumber < $lastPage) {
            return [
                true,
                sprintf(
                    __('pagination.url'),
                    $basePath,
                    $requestedPerPage,
                    $currentPageNumber + 1
                ),
                $currentPageNumber + 1,
            ];
        }

        return [
            false,
            sprintf(
                __('pagination.url'),
                $basePath, $requestedPerPage,
                $lastPage
            ),
            $lastPage,
        ];
    }
}