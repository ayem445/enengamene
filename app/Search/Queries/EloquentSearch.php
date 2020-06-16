<?php

namespace App\Search\Queries;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

trait EloquentSearch
{
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
      * @return \Illuminate\Support\Collection
      */
      public function records(): Collection {
          return $this->limit($this->queryWithoutLimit())->get();
      }

      /**
       * Add limit query.
       *
       * @param Builder $query [description]
       * @return Builder [description]
       */
      protected function limit(Builder $query): Builder {
         return $query->take($this->params->perPage)
               ->skip( ($this->params->page -1) * $this->params->perPage );
      }
}
