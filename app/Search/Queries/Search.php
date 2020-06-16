<?php

namespace App\Search\Queries;

use App\Search\Meta;
use App\Search\Params;
use App\Search\OrderBy;

use Illuminate\Support\Collection;

abstract class Search
{
    /**
     * [protected description]
     * @var \App\Search\OrderBy
     */
    protected $order;

    /**
     * [protected description]
     * @var \App\Search\Params
     */
    protected $params;

    /**
     * Search constructor
     * @param Params $params [description]
     * @param OrderBy     $order  [description]
     */
    public function __construct(Params $params, OrderBy $order) {
        $this->params = $params;
        $this->order = $order;
    }

    /**
     * Get request parameters.
     *
     * @return Params [description]
     */
    public function params(): Params {
        return $this->params;
    }

    /**
     * Get meta.
     *
     * @return Meta [description]
     */
    public function meta(): Meta {
        $total = $this->total();
        $lastPage = $this->lastPage($total);

        return new Meta(
            $total,
            $lastPage,
            $this->prevPage(),
            $this->nextPage($lastPage)
        );
    }

    /**
     * Get total number of records.
     *
     * @return int [description]
     */
    abstract public function total(): int;

    /**
     * Get records.
     *
     * @return \Illuminate\Support\Collection
     */
    abstract public function records(): Collection;

    /**
     * Get last page
     *
     * @param  int $total [description]
     * @return int        [description]
     */
    protected function lastPage(int $total): int {
        return ceil($total / $this->params->perPage) ?: 1;
    }

    /**
     * Get previous page
     *
     * @return int|null [description]
     */
    protected function prevPage(): ?int {
        return $this->params->page === 1 ? null : $this->params->page - 1;
    }

    /**
     * Get next page
     *
     * @param  int|null    $lastPage [description]
     * @return [type]           [description]
     */
    protected function nextPage(int $lastPage): ?int {
        return $this->params->page < $lastPage ? $this->params->page + 1 : null;
    }
}
