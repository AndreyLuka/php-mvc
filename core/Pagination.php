<?php

namespace Core;

/**
 * Class Pagination.
 */
class Pagination
{
    /**
     * @var int
     */
    private $totalItems;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * @var int
     */
    private $itemsPerPage;

    /**
     * Pagination constructor.
     * @param int $totalItems
     * @param int $currentPage
     * @param int $itemsPerPage
     */
    public function __construct($totalItems, $currentPage, $itemsPerPage = 3)
    {
        $this->totalItems = $totalItems;
        $this->currentPage = isset($currentPage) ? $currentPage : 1;
        $this->itemsPerPage = $itemsPerPage;
    }

    /**
     * @return int
     */
    public function getOffset() {
        $offset = 0;

        if($this->currentPage > 0)
        {
            $offset = ($this->currentPage - 1) * $this->itemsPerPage;
        }

        return $offset;
    }

    /**
     * @return bool
     */
    public function hasPrev()
    {
        if ($this->currentPage > 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasNext()
    {
        if ($this->currentPage < $this->getNumOfPages()) {
            return true;
        }

        return false;
    }

    /**
     * @return float
     */
    public function getNumOfPages()
    {
        return ceil($this->totalItems / $this->itemsPerPage);
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * Check if pagination exists.
     * @return bool
     */
    public function exists()
    {
        return $this->totalItems > $this->itemsPerPage;
    }
}
