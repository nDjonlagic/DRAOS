<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";

    protected $fillable = [
        'users_id',
        'status_id',
        'archived'
    ];

    public function items()
    {
        return $this->hasMany('App\OrderItem', 'orders_id');
    }

    public function status()
    {
        return $this->belongsTo('App\OrderStatus', 'status_id');
    }
}
