<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to AllergiesList
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class AllergiesList extends Model
{
    use SoftDeletes;
	
    protected $table = 'allergies_lists';
    protected $fillable = [
        'id',
        'patient_id',
        'allergic_medicine',
        'created_at',
        'updated_at'	
    ];
    
   /**
    * This function create linking between user table and allergies_list table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }		
}
