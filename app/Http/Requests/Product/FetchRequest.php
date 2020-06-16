<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\ISearchFormRequest;

use Illuminate\Foundation\Http\FormRequest;

class FetchRequest extends FormRequest implements ISearchFormRequest
{
    use SearchRequest;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function orderByFields(): array {
        return ['name','price'];
    }

    /**
     * @inheritDoc
     */
    protected function defaultOrderByField(): string {
        return 'name';
    }
}
