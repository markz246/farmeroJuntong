<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id','prod_name','prod_code','price','quantity','user_id','user_email','session_id'];

    public function user_id(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
