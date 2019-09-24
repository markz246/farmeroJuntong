<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public function orderDetails(){
        return $this->belongsTo('App\Order','id');
    }
}
