<?php

namespace App\Search;

class OrderBy
{
    /**
     * [public description]
     * @var string
     */
    public $field;

    /**
     * [public description]
     * @var string
     */
    public $direction;

    public function __construct(string $field, string $direction) {
        $this->field = $field;
        $this->direction = $direction;
    }
}
