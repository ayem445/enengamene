<?php

namespace App\Search;

use Illuminate\Contracts\Support\Arrayable;
use App\Search\Payloads\Payload;


class RequestData implements Arrayable
{
    public $search;

    /**
     * [private description]
     * @var int
     */
    public $perPage;

    /**
     * [private description]
     * @var int
     */
    public $page;

    /**
     * [private description]
     * @var string
     */
    public $orderBy;


    public function __construct(Payload $search, int $perPage, int $page, string $orderBy) {
        $this->search = $search;
        $this->perPage = $perPage;
        $this->page = $page;
        $this->orderBy = $orderBy;
    }

    public function toArray(): array {
        return array_merge([
            'per_page' => $this->perPage,
            'page' => $this->page,
            'order_by' => $this->orderBy,
        ], $this->search->toArray());
    }
}
