<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;
    
    protected $table = 'categories'; 
    /**
     * Get all categories for listing.
     * 
     * @return array
   */
     public function category() {
          return $this->hasMany('App\CategoryAddOn', 'category_id'); 
    }
	
    public function productCategories() {
        return $this->hasMany('App\productCategory', 'category_id');
    }
	
	public function cart() {
        return $this->hasMany('App\Cart', 'category_id');
    }
	
	public function packages() {
        return $this->hasMany('App\Package', 'category_id');
    }
	
    public function CategoryAddOns() {  
        return $this->belongsTo('App\CategoryAddOn', 'category_id');
    }
    
   
    
}
