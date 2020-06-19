<?php

namespace App\Repositories\Contracts;

use App\Search\Queries\Search;
use App\Http\Requests\ISearchFormRequest;

interface ICourRepositoryContract
{
    /**
     * Get instance of Search.
     *
     * @param  \App\Http\Requests\ISearchFormRequest $request
     * @return \App\Search\Queries\Search
     */
    public function search(ISearchFormRequest $request): Search;
}
