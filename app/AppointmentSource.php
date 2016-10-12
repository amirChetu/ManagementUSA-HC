<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to Appointment Source
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class AppointmentSource extends Model
{
    use SoftDeletes;
    protected $table = 'appointment_sources';
    protected $fillable = [
        'id',
        'name',
        'discription',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
