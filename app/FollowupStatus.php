<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to followup_status tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class FollowupStatus extends Model
{
    use SoftDeletes;
	
    protected $table = 'followup_status';
    protected $fillable = [
        'title',
        'status',
    ];
   
   /**
    * This function create linking between follow_ups table and followup_status table.
    *
    * @parms void;
    *
    * @return null
    */
    public function followup() {
        return $this->hasMany('App\Followup');
    }
}
