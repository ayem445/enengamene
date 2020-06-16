<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use \Illuminate\View\View;
use App\Http\Requests\Product\FetchRequest;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display products page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('product.index');
    }

    public function fetch(FetchRequest $request): JsonResponse
    {
        return new JsonResponse($request->response());
    }

    /**
     * [edit description]
     * @param  Product $product [description]
     * @return \Illuminate\View\View           [description]
     */
    public function edit(Product $product): View {
        return view('product.edit')->with('product', $product);
    }

    /**
     * [destroy description]
     * @param  Product          $product [description]
     * @return RedirectResponse          [description]
     * @throws \Exception
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return new RedirectResponse(route('product'));
    }
}
