<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Search\Queries\Search;
use App\Search\Params;
use App\Search\Meta;

class SearchCollection extends ResourceCollection
{
    /**
     * [private description]
     * @var \App\Search\Meta
     */
    private $meta;

    /**
     * [private description]
     * @var \App\Search\Params
     */
    private $params;

    public function __construct(Search $search, string $collects) {

        $this->collects = $collects;
        $this->meta = $search->meta();
        $this->params = $search->params();

        parent::__construct($search->records());
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'records' => $this->collection,
            'params' => $this->params->toArray(),
            'meta' => $this->meta->toArray(),
        ];
    }
}
