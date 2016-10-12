<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to Cashlog tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Cashlog extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cashlogs';
    protected $fillable =
    [
        'user_id',
	'cash_in',
	'cash_out',
        'details',
        'date'
    ];
    
    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
     * many-to-many relationship method
     *
     * @return QueryBuilder
     */
    public function agent()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}