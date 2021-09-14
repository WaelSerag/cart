<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Web\CartRequest;
use App\Http\Resources\Cart as CartResource;

use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{


    /**
    * [List Cart For This Guest]
    * api_url: api/web/cart/{mobile_identifier}  [method:get]
    * route  : carts.index
    * @return [json]           [cart data]
    */
    public function index($mobile_identifier)
    {
        $cart = Cart::where('mobile_identifier',$mobile_identifier)->with('product')->get();
        $data = $cart->map(function($item){
            return [
                'id'                => $item->id,
                'mobile_identifier' => $item->mobile_identifier,
                'product_id'        => $item->product_id,
                'name'              => $item->product->name ?? "",
                'quantity'          => intval($item->quantity),
                'price'             => $item->product->price ?? 0,
                'total'             => intval($item->quantity)*$item->product->price,
            ];
        });
        return sendResponse(trans('message.list_data'),$data);
    }

    /**
    * [Create Cart]
    * @param  Request $request [product_id,quantity]
    * api_url: api/web/carts/store  [method:post]
    * route  : carts.store
    * @return [json]          [cart data]
    */
    public function store(CartRequest $request)
    {
        $data = $request->validated();
        try {
            //Create New Product
            $cart = Cart::updateOrCreate(
                [
                    'mobile_identifier' => $data['mobile_identifier'], // If use same mobile and product id (Update)
                    'product_id'        => $data['product_id'],        // else Create
                ],
                [
                    'quantity' => $data['quantity']
                ]
            );
            return sendResponse(trans('message.add_success'),new CartResource($cart));
        } catch (\Exception $e) {
            throw new \Exception("Not Expected Error");
        }

    }

}
