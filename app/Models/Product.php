<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    /**
    * Belongs To Relation
    **/
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
