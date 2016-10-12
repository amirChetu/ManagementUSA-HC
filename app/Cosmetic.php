<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to cosmetics tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Cosmetic extends Model
{
    use SoftDeletes;
	
    protected $table = 'cosmetics';
    protected $fillable = [
        'id',
        'patient_id',
        'facial_surgeries',
        'facial_kind',
        'face_wash',
        'exposure',
        'skin_look',
        'look_score',
        'happy_score',
        'crowsfeet',
        'facial_expression',
        'sunken',
        'bullfrog_looking',
        'loose_skin',
        'thin_lip',
        'face_spot',
        'acne',
        'skin_tag',
        'created_at',
        'updated_at'
    ];
    
    /**
    * This function create linking between users table and cosmetics table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }	
}
