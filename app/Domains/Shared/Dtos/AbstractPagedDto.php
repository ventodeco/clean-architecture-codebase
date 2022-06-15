<?php

namespace App\Domains\Shared\Dtos;

abstract class AbstractPagedDto
{
    private $pageMeta;
    
    /**
     * __construct
     *
     * @param  mixed $pageMeta
     * @return void
     */
    public function __construct(PageMeta $pageMeta) {
        $this->pageMeta = $pageMeta;
    }
    
    /**
     * getPageMeta
     *
     * @return void
     */
    public function getPageMeta() {
        return $this->pageMeta;
    }
}
