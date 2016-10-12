<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to category_types tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class CategoryType extends Model
{
    use SoftDeletes;
    
    /**
    * This function create linking between carts table and category_types table.
    *
    * @parms void;
    *
    * @return null
    */
    public function cart() {
        return $this->hasMany('App\Cart', 'category_type_id');
    }	
}
