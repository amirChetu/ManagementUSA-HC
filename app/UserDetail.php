<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to user_details tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class UserDetail extends Model
{
    use SoftDeletes;
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_details';
    
    protected $fillable =
    [
        'user_id',
        'permission_slug',
        'dob',
        'gender',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'zipCode',
        'image',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
    * This function create linking between users table and user_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    /**
    * This function create linking between states table and user_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function userStateName()
    {
        return $this->belongsTo('App\State', 'state');
    }
}
