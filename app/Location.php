<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class is used to handle all the data related to locations tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Location extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';
    protected $fillable = [
        'name',
        'city',
        'state',
        'patient_id',
        'appt_request_id'
    ];
}
