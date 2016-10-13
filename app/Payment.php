<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * This class is used to handle all the data related to payments tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Payment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';
    protected $dates = ['deleted_at'];

    /**
    * This function is used to get payment history from payment table by patient_id.
    *
    * @parms $patientId;
    *
    * @return $payments, $orders, $order_details
    */
    public static function getPaymentHistory($patientId){
        $payment = [];
        $orders = [];
        $order_detail = [];
        $paymentHistory = Payment::with('user', 'order', 'order.orderDetail')->where('patient_id', $patientId)->get();

        foreach($paymentHistory as $i => $row){
            $payment[$row->id] = [];
            $payment[$row->id]['agent'] = (isset($row->user) && !empty($row->user))? $row->user->first_name.' '.$row->user->last_name: '';
            if($row->payment_type == 0){
                $payment[$row->id]['payment_type'] = 'Cash on delivery';
            } elseif($row->payment_type == 1) {
                $payment[$row->id]['payment_type'] = 'Credit Card';
            }
            $payment[$row->id]['total_amount'] = $row->total_amount;
            $payment[$row->id]['paid_amount'] = $row->paid_amount;
            $payment[$row->id]['package_count'] = sizeof($row->order);

            foreach($row->order as $ind => $order){
                if(!isset($orders[$row->id])){
                    $orders[$row->id] = [];
                }
                $orders[$row->id][$order->id] = [];
                $orders[$row->id][$order->id]['payment_id'] = $order->payment_id;
                $orders[$row->id][$order->id]['category'] = $order->category;
                $orders[$row->id][$order->id]['package_type'] = $order->package_type;
                $orders[$row->id][$order->id]['price'] = $order->price;
                $orders[$row->id][$order->id]['discount_price'] = $order->discount_price;
                $orders[$row->id][$order->id]['details'] = $order->orderDetail;

                foreach($order->orderDetail as $in => $detail){
                    if(!isset($order_detail[$order->id])){
                        $order_detail[$order->id] = [];
                    }
                    $order_detail[$order->id][$detail->id] = [];
                    $order_detail[$order->id][$detail->id]['order_id'] = $detail->order_id;
                    $order_detail[$order->id][$detail->id]['sku'] = $detail->product_sku;
                    $order_detail[$order->id][$detail->id]['product'] = $detail->product;
                    $order_detail[$order->id][$detail->id]['quantity'] = $detail->quantity;
                    $order_detail[$order->id][$detail->id]['unit_price'] = $detail->unit_price;
                    $order_detail[$order->id][$detail->id]['discount_price'] = $detail->discount_price;
                }
            }
        }

        return ['payment' => $payment, 'orders' => $orders, 'order_detail' => $order_detail];
    }

    /**
    * This function is used to ftch the uncomplete payment details.
    *
    * @parms $patientId;
    *
    * @return $paymentuncompleted
    */
    public static function getUncompletedPayment($patientId){
        $paymentHistory = Payment::where(['patient_id' => $patientId, 'emi_status' => 0, 'status' =>0])->get();
        $paymentUncompleted = array();
        $paymentUncompleted['total'] = 0;
        $paymentUncompleted['data'] = [];
        foreach($paymentHistory as $i => $pay){
            $paymentUncompleted['data'][$i] = $pay->toArray();
            $paymentUncompleted['total'] += $pay->paid_amount;
        }
        return  $paymentUncompleted;
    }

    /**
    * This function is used to change the status og payment.
    *
    * @parms $patientId, $uniqueId;
    *
    * @return status
    */
    public static function changePaymentStatus($patientId, $uniqueId){
        Payment::where([['patient_id', '=',  $patientId], ['status', '=', 0], ['order_unique_id', '=', '']])
            ->update(['status' => 1, 'order_unique_id' => $uniqueId]);
        return true;
    }

     /**
    * This function is used to get amount of uncompleted payments.
    *
    * @parms $patientId;
    *
    * @return $totalUncompleted
    */
    public static function totalUncompletedAmount($patientId){
        $totalUncompleted = Payment::where(['patient_id' => $patientId, 'emi_status' => 0, 'status' => 0])->sum('paid_amount');
        if($totalUncompleted == NULL){
            $totalUncompleted = 0;
        }
        return $totalUncompleted;
    }


    /**
    * This function create linking between orders table and payments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function order()
    {
        return $this->hasMany('App\Order', 'payment_id');
    }

    /**
    * This function create linking between users table and payments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }

    /**
    * This function create linking between users table and payments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id');
    }

    /**
    * This function create linking between users table and payments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function patientDetails()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }
}
