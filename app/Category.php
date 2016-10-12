<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to Category tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Category extends Model
{
    use SoftDeletes;
    
    protected $table = 'categories'; 
    
    /**
    * This function create linking between category_add_ons table and categories table.
    *
    * @parms void;
    *
    * @return null
    */
    public function category() {
        return $this->hasMany('App\CategoryAddOn', 'category_id'); 
    }
    
    /**
    * This function create linking between product_categories table and categories table.
    *
    * @parms void;
    *
    * @return null
    */
    public function productCategories() {
        return $this->hasMany('App\productCategory', 'category_id');
    }
    
    /**
    * This function create linking between carts table and categories table.
    *
    * @parms void;
    *
    * @return null
    */
    public function cart() {
        return $this->hasMany('App\Cart', 'category_id');
    }
    
    /**
    * This function create linking between packages table and categories table.
    *
    * @parms void;
    *
    * @return null
    */
    public function packages() {
        return $this->hasMany('App\Package', 'category_id');
    }
    
    /**
    * This function create linking between category_add_ons table and categories table.
    *
    * @parms void;
    *
    * @return null
    */
    public function CategoryAddOns() {  
        return $this->belongsTo('App\CategoryAddOn', 'category_id');
    }
}
