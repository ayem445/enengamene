<?php

namespace App\Search;

use Illuminate\Contracts\Support\Arrayable;

class Meta implements Arrayable
{
    /**
     * [int description]
     * @var int
     */
    public $total;

    /**
     * [int description]
     * @var int
     */
    public $lastPage;

    /**
     * [private description]
     * @var int|null
     */
    public $prevPage = null;

    /**
     * [private description]
     * @var int|null
     */
    public $nextPage = null;

    /**
     * Meta constructor
     *
     * @param int        $total    [description]
     * @param int        $lastPage [description]
     * @param [type]     $prevPage [description]
     * @param [type]     $nextPage [description]
     */
    public function __construct(
        int $total,
        int $lastPage,
        int $prevPage = null,
        int $nextPage = null
    ) {
        $this->total = $total;
        $this->lastPage = $lastPage;
        $this->prevPage = $prevPage;
        $this->nextPage = $nextPage;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array {
        return [
            'total' => $this->total,
            'prev_page' => $this->prevPage,
            'next_page' => $this->nextPage,
            'last_page' => $this->lastPage,
        ];
    }
}
