<?php

namespace App\Search\Payloads;

class SearchOnlyPayload extends Payload
{
    /**
     * [private description]
     * @var string|null
     */
    public $search;

    public function __construct(string $search = null) {
        $this->search = $search;
    }

    public function hasFilter(): bool {
        return (bool)$this->search;
    }

    public function toArray() {
        return [
            'search' => $this->search,
        ];
    }
}
