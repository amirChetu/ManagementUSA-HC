<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to web_leads tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class WebLead extends Model
{
    use SoftDeletes;
    protected $table = 'web_leads';
    public $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'location',
        'requested_time'
    ];
        
}
