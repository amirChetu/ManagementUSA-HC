<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to category_add_ons tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class CategoryAddOn extends Model
{
    use SoftDeletes;
	
    protected $table = 'category_add_ons'; 
    
}
