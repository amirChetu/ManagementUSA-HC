<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to illness_lists tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class IllnessList extends Model
{
    use SoftDeletes;
	
    protected $table = 'illness_lists';
    protected $fillable = [
        'id',
        'patient_id',
        'illness',
        'created_at',
        'updated_at'	
    ];
    
    /**
    * This function create linking between users table and illness_lists table.
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
