<?php

namespace App\Search\Queries;

use App\Search\OrderBy;
use App\Search\RequestData;
use App\Search\Meta;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

abstract class Search
{

    /**
     * [protected description]
     * @var \App\Search\RequestData
     */
    protected $params;

    /**
     * [protected description]
     * @var \App\Search\OrderBy
     */
    protected $order;

    /**
     * Search constructor
     * @param RequestData $params [description]
     * @param OrderBy     $order  [description]
     */
    public function __construct(RequestData $params, OrderBy $order) {
        $this->params = $params;
        $this->order = $order;
    }

    /**
     * Get response.
     *
     * @return array [description]
     */
    public function response(): array {

        return [
            'params' => $this->params->toArray(),
            'meta' => $this->meta()->toArray(),
            'records' => $this->records($this->queryWithoutLimit()),
        ];
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
    public function total(): int {
        return $this->queryWithoutLimit()->count('id');
    }

    /**
     * Get query without limit.
     *
     * @return Builder [description]
     */
    protected function queryWithoutLimit(): Builder {
        return $this->query()->orderBy($this->order->field, $this->order->direction);
    }

    /**
     * Get sql query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
     abstract protected function query(): Builder;

     /**
      * Get records.
      *
      * @param \Illuminate\Database\Eloquent\Builder $query
      * @return \Illuminate\Support\Collection
      */
     abstract protected function records(Builder $query): Collection;

     /**
      * Add limit query.
      *
      * @param Builder $query [description]
      */
     protected function limit(Builder $query): void {
        $query->take($this->params->perPage)
              ->skip( ($this->params->page -1) * $this->params->perPage );
     }

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
