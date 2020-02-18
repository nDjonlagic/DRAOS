<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    protected $table = "order_items";

    protected $fillable = [
        'orders_id',
        'meals_id',
        'quantity'
    ];

    public function meal()
    {
        return $this->belongsTo('App\Meal', 'meals_id');
    }
}
