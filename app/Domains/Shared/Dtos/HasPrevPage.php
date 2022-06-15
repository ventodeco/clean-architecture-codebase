<?php

namespace App\Domains\Shared\Dtos;

trait HasPrevPage 
{
    private $hasNextPage;
    private $hasPrevPage;

    /**
     * isHasPrevPage
     *
     * @return void
     */
    public function isHasPrevPage()
    {
        return $this->hasPrevPage;
    }

    /**
     * setHasPrevPage
     *
     * @param  mixed $hasPrevPage
     * @return void
     */
    public function setHasPrevPage($hasPrevPage)
    {
        $this->$hasPrevPage = $hasPrevPage;
    }

    /**
     * getPrevPageNumber
     *
     * @return void
     */
    public function getPrevPageNumber()
    {
        return $this->prevPageNumber;
    }

    /**
     * setNextPageUrl
     *
     * @param  mixed $nextPageUrl
     * @return void
     */
    public function setNextPageUrl(String $nextPageUrl)
    {
        $this->nextPageUrl = $nextPageUrl;
    }
    
    /**
     * getPrevPageUrl
     *
     * @return void
     */
    public function getPrevPageUrl()
    {
        return $this->prevPageUrl;
    }

    /**
     * setPrevPageNumber
     *
     * @param  mixed $prevPageNumber
     * @return void
     */
    public function setPrevPageNumber(int $prevPageNumber)
    {
        $this->prevPageNumber = $prevPageNumber;
    }
    
    /**
     * setPrevPageUrl
     *
     * @param  mixed $prevPageUrl
     * @return void
     */
    public function setPrevPageUrl(String $prevPageUrl)
    {
        $this->prevPageUrl = $prevPageUrl;
    }

    /**
     * @param bool $hasPrevPage
     * @param string $basePath
     * @param int $requestedPerPage
     * @param int $currentPageNumber
     * 
     * @return array
     */
    public static function build(
        bool $hasPrevPage,
        string $basePath,
        int $requestedPerPage,
        int $currentPageNumber
    ): array
    {
        if ($hasPrevPage) {
            return [
                $hasPrevPage,
                sprintf(__('pagination.url'), $basePath, $requestedPerPage, min(1, $currentPageNumber - 1)),
                $currentPageNumber - 1
            ];
        }

        return [
            $hasPrevPage,
            sprintf(__('pagination.url'), $basePath, $requestedPerPage, 1),
            1
        ];
    }
}