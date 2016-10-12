<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to lab_reports tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class LabReport extends Model
{
    use SoftDeletes;
    protected $table = 'lab_reports';
    protected $fillable = [
        'id',
        'patient_id',
        'appointments_id',
        'file',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    /**
    * This function create linking between appointments table and lab_reports table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appointment() {
        return $this->belongsTo('App\Appointment', 'appointments_id');
    }
}
