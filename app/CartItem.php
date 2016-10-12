<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to Cart tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class CartItem extends Model
{
    use SoftDeletes;
    
    /**
    * This function create linking between carts table and cart_items table.
    *
    * @parms void;
    *
    * @return null
    */
    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }
    
    /**
    * This function create linking between products table and cart_items table.
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
 