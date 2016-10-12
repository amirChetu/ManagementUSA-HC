<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to emis tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Emi extends Model
{
    use SoftDeletes;
	
    protected $table = 'emi';

    protected $fillable = [
        'id',
        'type',
        'emi_amount',
        'emi_paid',
        'patient_id',
        'agent_id',
        'package_id',
        'due_date',
        'payment_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
