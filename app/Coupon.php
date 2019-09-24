<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $primaryKey = 'id';
    protected $fillable = ['coupon_code','amount','expiry_date','status'];

}
