<?php

namespace App\Library\Pagination;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Pagination
{

    private $currentPage;
    private $collection;
    private $perPage;
    private $currentPageSearchResults;
    private $paginatedSearchResults;

    /**
     * $data (array) - data from pagination;
     * $countPage (int) - number of files in page;
     * $path (string) - path current page;
     *
     * @return object
     */
    public function createPagination($data, $countPage, $path)
    {
            $this->currentPage = LengthAwarePaginator::resolveCurrentPage();
            $this->collection = new Collection($data);
            $this->perPage = $countPage;
            $this->currentPageSearchResults = $this->collection->slice(($this->currentPage - 1)  * $this->perPage, $this->perPage)->all();
            $this->paginatedSearchResults = new LengthAwarePaginator($this->currentPageSearchResults, count($this->collection), $this->perPage);
            $this->paginatedSearchResults->setPath($path);

            return $this->paginatedSearchResults;
    }
}