<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * This class is used to handle all the data related to orders tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'orders';
    protected $fillable = [
        'payment_id',
        'category',
        'package_type',
        'price',
        'discount_price',
        'status'
    ];
    
    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
    * This function create linking between order_details table and orders table.
    *
    * @parms void;
    *
    * @return null
    */
    public function orderDetail()
    {
        return $this->hasMany('App\OrderDetail', 'order_id');
    }
    
    /**
    * This function create linking between invoices table and orders table.
    *
    * @parms void;
    *
    * @return null
    */
    public function invoice()
    {
        return $this->hasOne('App\Invoice', 'order_id');
    }
    
    /**
    * This function create linking between payments table and orders table.
    *
    * @parms void;
    *
    * @return null
    */
    public function payment()
    {
        return $this->belongsTo('App\Payment', 'payment_id');
    }
    
    /**
    * This function is used to get all orders form orders tables using unique paymentId.
    *
    * @parms void;
    *
    * @return null
    */
    public static function getAllOrders($orderId)
    {
        $orders = [];
        $user = [];
        $agent = [];
        $total_price = '';
        $discount_price = '';
        $orderHistory = Order::with('payment','orderDetail', 'payment.user', 'payment.user.patientDetail', 'payment.user.patientDetail.patientStateName',  'payment.agent')->where('order_unique_id', $orderId)->get();
        
        $orders = $orderHistory->toArray();
        if(empty($orders)){
            return ['orderHistory' => $orders, 'user' => $user, 'agent' => $agent];
        }else{            
            $firstOrder  = $orderHistory->first()->toArray();
            foreach($orders as $main=>$order){
                foreach($order['order_detail'] as $key => $value){
                    $orders[$main]['order_detail'][$key]['total_price'] = $value['quantity'] * $value['unit_price'];
                }
                $total_price += $order['price'];  
                $discount_price += $order['discount_price'];  
            }            
            $user = $firstOrder['payment']['user'];
            $agent = $firstOrder['payment']['agent'];
           
            return ['orderHistory' => $orders, 'user' => $user, 'agent' => $agent, 'total_package_price' => $total_price, 'discount_price' => $discount_price];
        }
    }
}
