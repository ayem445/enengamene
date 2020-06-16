<?php

namespace App\Http\Requests\Product;

use App\Search\RequestData;
use Illuminate\Validation\Rule;
use App\Search\OrderBy;
use App\Search\Queries\ProductSearch;
use Illuminate\Foundation\Http\FormRequest;
use App\Search\Payloads\SearchOnlyPayload;

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
class FetchRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'search' => [
              'present'
            ],
            'per_page' => [
              'required',
              Rule::in(config('system.per_page')),
            ],
            'page' => [
              'required',
              'integer',
            ],
            'order_by' => [
              'required',
              'string',
            ],
            'order_field' => [
              Rule::in(['name','price']),
            ],
            'order_direction' => [
              Rule::in(['asc','desc']),
            ],
        ];
    }

    /**
     * Prepare the data for validation
     *
     * @return void
     */
    protected function prepareForValidation(): void {
        $this->order_by = $this->order_by ?? 'name:asc';
        [$order, $direction] = explode(':', $this->order_by);

        $this->offsetSet('order_field', $order);
        $this->offsetSet('order_direction', $direction);

        $this->per_page = (int)($this->per_page ?? config('system.default_per_page'));
        $this->page = (int)($this->page ?? 1);
    }

    /**
     * Get response.
     *
     * @return array [description]
     */
    public function response(): array {
        return (new ProductSearch(
          $this->RequestData(), $this->requestOrder()
        ))->response();
    }

    /**
     * Get request data.
     *
     * @return RequestData [description]
     */
    public function requestData(): RequestData {
        return new RequestData(
            new SearchOnlyPayload($this->search ?? null), $this->per_page, $this->page, $this->order_by
        );
    }

    /**
     * Get request ORDER BY
     *
     * @return OrderBy [description]
     */
    protected function requestOrder(): OrderBy {
        return new OrderBy($this->order_field, $this->order_direction);
    }
}
