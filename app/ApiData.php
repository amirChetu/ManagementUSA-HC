<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to API Data
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class ApiData extends Model
{
    use SoftDeletes;
    protected $table = 'api_datas';
    protected $connection = 'mysql2';
    protected $fillable = [
        'timestamp',
        'date_time',
        'call_duration',
        'phone_number',
        'phone_number_name',
        'call_resolution',
        'msg',
        'caller_id',
        'first_name',
        'last_name',
        'business',
        'address',
        'city',
        'state',
        'zipcode',
        'phone_number_formatted',
        'page_count',
        'group',
        'user',
        'call_direction',
        'access',
        'status',
        'npa',
        'nxxx',
        'call_type',
        'current_url',
        'widget_name',
        'source_type',
        'category',
        'appointment_status'
    ];
}
