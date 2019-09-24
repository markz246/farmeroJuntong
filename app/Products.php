<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Products extends Model
{
    //
    protected $table='products';
    protected $primaryKey='id';
    protected $fillable=['category_id','prod_name','prod_code','description','price','image'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public static function cartCount()
    {
        $user_id = Auth::id();
        $cartCount = DB::table('cart')->where('user_id',$user_id)->sum('quantity');

        return $cartCount;
    }
}
