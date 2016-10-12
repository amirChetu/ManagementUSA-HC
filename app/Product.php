<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to products tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Product extends Model
{
    use SoftDeletes;
	
    protected $fillable = [
        'name',
        'price',
        'sku',
        'count',
        'unit_of_measurement'
    ];
    
    /**
    * This function create linking between packages table and products table.
    *
    * @parms void;
    *
    * @return null
    */
    public function packages() {  
        return $this->hasMany('App\Package', 'product_id');
    }	
}
