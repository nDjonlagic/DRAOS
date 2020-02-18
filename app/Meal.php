<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    //
    protected $table = "meals";

    protected $fillable = [
        'name',
        'price',
        'type_id',
        'image'
    ];
}

