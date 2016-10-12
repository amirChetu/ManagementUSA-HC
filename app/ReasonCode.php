<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to reason_codes tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class ReasonCode extends Model
{
    use SoftDeletes;
	
    protected $table = 'reason_codes';
}
