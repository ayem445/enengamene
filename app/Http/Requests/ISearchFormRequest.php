<?php

namespace App\Http\Requests;

use App\Search\Params;
use App\Search\OrderBy;

interface ISearchFormRequest
{
    /**
     * Get request parameters.
     *
     * @return Params [description]
     */
     public function requestParams(): Params;

    /**
     * Get request ORDER BY
     *
     * @return OrderBy [description]
     */
     public function requestOrder(): OrderBy;
}
