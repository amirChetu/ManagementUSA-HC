<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to surgery_lists tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class SurgeryList extends Model
{
    use SoftDeletes;
	
    protected $table = 'surgery_lists';
    protected $fillable = [
        'id',
        'patient_id',
        'type_of_surgery',
        'date',
        'reason',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    /**
    * This function create linking between users table and surgery_lists table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user() {
        return $this->belongsTo('App\User', 'patient_id');
    }	
}
