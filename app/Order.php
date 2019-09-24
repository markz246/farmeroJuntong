<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\OrderDetails;
use App\Products;
use Auth;
use DB;

class Order extends Model
{ 
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','user_email','name','street','barangay','city','province','contact','order_notes',
                            'shipping_charges','coupon_code','coupon_amount','payment_method','total','status'];
    
    public function orders() {
        return $this->hasMany('App\OrderDetails','order_id');
    }
    
    public static function orderCount()
    {
        $orderCount = DB::table('orders')->where('user_id',auth()->id())->count();

        return $orderCount;
    }

    public function canBeCancelled()
    {
        return $this->created_at->diffInHours(now()) < 3 and $this->status!='Cancelled';
    }

    public function timeDifference()
    {
        return $this->created_at->diffForHumans(['parts'=>2, 'join'=>true]);
    }

    public function timeDelivery(){

        echo $this->created_at->timezone('Asia/Manila')->addWeek()->format('M\\. d \\-');
        echo $this->created_at->timezone('Asia/Manila')->addWeek()->addDays(3)->format(' M\\. d\\, Y');
    }

}
