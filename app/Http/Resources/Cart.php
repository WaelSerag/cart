<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     public function toArray($request)
     {
         return [
             'id'                => $this->id,
             'mobile_identifier' => $this->mobile_identifier,
             'product_id'        => $this->product_id,
             'name'              => $this->product->name ?? "",
             'quantity'          => intval($this->quantity),
             'price'             => $this->product->price ?? 0,
             'total'             => intval($this->quantity)*$this->product->price,
         ];
     }
}
