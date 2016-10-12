<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class is used to handle all the data related to order_details tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class OrderDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'product_sku',
        'product',
        'quantity',
        'unit_price',
        'discount_price'
    ];
    
    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
    * This function create linking between orders table and order_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }
    
    /**
    * This function create linking between products table and order_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
