<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to diseases tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Disease extends Model
{
    use SoftDeletes;
    protected $table = 'diseases';
}
