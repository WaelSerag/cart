<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Merchant\ProductRequest;
use App\Http\Resources\Product as ProductResource;

use App\Models\Product;

class ProductController extends Controller
{

    /**
    * [List Product For This Store]
    * api_url: api/merchant/products  [method:get]
    * route  : products.index
    * @return [json]           [product data]
    */
    public function index()
    {
        $product = Product::where('store_id',auth()->user()->store_id)->get();
        return sendResponse(trans('message.list_data'),$product);
    }
    
    /**
    * [Create Product]
    * @param  Request $request [name,description,price]
    * api_url: api/merchant/products/store  [method:post]
    * route  : products.store
    * @return [json]           [product data]
    */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        try {
            //Create New Product
            $data['store_id'] = auth()->user()->store_id;
            $product = Product::create($data);
            return sendResponse(trans('message.add_success'),new ProductResource($product));
        } catch (\Exception $e) {
            throw new \Exception("Not Expected Error");
        }

    }

}
