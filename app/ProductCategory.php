<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to product_categories tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class ProductCategory extends Model
{
    use SoftDeletes;
	
    protected $table = 'product_categories'; 
    
    /**
    * This function create linking between products table and product_categories table.
    *
    * @parms void;
    *
    * @return null
    */
    public function products() {
        return $this->belongsToMany('App\product', 'product_id');
    }
    
    /**
    * This function create linking between categories table and product_categories table.
    *
    * @parms void;
    *
    * @return null
    */
    public function categories() {
        return $this->belongsTo('App\category', 'category_id');
    }
    
    /**
    * This function create linking between category_types table and product_categories table.
    *
    * @parms void;
    *
    * @return null
    */
    public function categoryTypes() {
        return $this->belongsTo('App\category_type', 'id');
    }
}
