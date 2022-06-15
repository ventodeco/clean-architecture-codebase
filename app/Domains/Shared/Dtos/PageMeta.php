<?php

namespace App\Domains\Shared\Dtos;

class PageMeta
{
    use HasPrevPage;
    use HasNextPage;
    use HasCurrentPage;
    use HasRequestedPage;

    private $prevPageNumber;
    private $totalItemsCount;
    private $pageCount;
    private $offset;
    private $prevPageUrl;
    
    /**
     * build
     *
     * @param  mixed $paginator
     * @param  string $basePath
     * @return void
     */
    public static function build($paginator, String $basePath)
    {
        $requestedPerPage    = $paginator->perPage();
        $currentPageNumber   = $paginator->currentPage();
        list($hasNextPage, $nextPageUrl, $nextPageNumber) = HasNextPage::build($paginator->lastPage(), $basePath, $requestedPerPage, $currentPageNumber);
        list($hasPrevPage, $prevPageUrl, $prevPageNumber) = HasPrevPage::build($paginator->previousPageUrl() != null, $basePath, $requestedPerPage, $currentPageNumber);

        return [
            'has_next_page'       => $hasNextPage,
            'has_prev_page'       => $hasPrevPage,
            'next_page_number'    => $nextPageNumber,
            'prev_page_number'    => $prevPageNumber,
            'next_page_url'       => $nextPageUrl,
            'prev_page_url'       => $prevPageUrl,
            'offset'              => ($paginator->perPage() * ($paginator->currentPage() - 1)),
            'requested_page_size' => $paginator->perPage(),
            'total_items_count'   => $paginator->total(),
            'current_items_count' => $paginator->perPage(),
            'page_count'          => $paginator->lastPage(),
            'current_page_number' => $paginator->currentPage(),
        ];
    }
    
    /**
     * getTotalItemsCount
     *
     * @return void
     */
    public function getTotalItemsCount()
    {
        return $this->totalItemsCount;
    }
    
    /**
     * setTotalItemsCount
     *
     * @param  int $totalItemsCount
     * @return void
     */
    public function setTotalItemsCount(int $totalItemsCount)
    {
        $this->totalItemsCount = $totalItemsCount;
    }
    
    /**
     * getPageCount
     *
     * @return void
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }
    
    /**
     * setPageCount
     *
     * @param  mixed $pageCount
     * @return void
     */
    public function setPageCount(int $pageCount)
    {
        $this->pageCount = $pageCount;
    }
    
    /**
     * getOffset
     *
     * @return void
     */
    public function getOffset()
    {
        return $this->offset;
    }
    
    /**
     * setOffset
     *
     * @param  mixed $offset
     * @return void
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }
}