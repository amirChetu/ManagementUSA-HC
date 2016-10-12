<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to classifications tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Classification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'status'
    ];
}
