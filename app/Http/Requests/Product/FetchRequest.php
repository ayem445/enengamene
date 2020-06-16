<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

use App\Search\Queries\ProductSearch;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\ISearchFormRequest;

/**
 * Class FetchRequest
 *
 * @package \Requests\Product
 *
 * @property string|null $search
 * @property int $per_page
 * @property int $page
 * @property string $order_by
 * @property string $order_field
 * @property string $order_direction
 */
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

    /**
     * Get response.
     *
     * @return array [description]
     */
    public function response(): array {
        
        return (new ProductSearch(
          $this->requestParams(), $this->requestOrder()
        ))->response();
    }
}
