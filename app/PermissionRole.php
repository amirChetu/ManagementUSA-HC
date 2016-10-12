<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to permission_role tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class PermissionRole extends Model
{
	use SoftDeletes;

    protected $table = 'permission_role';

    protected $fillable =
    [
        'permission_id',
        'role_id',
    ];
    
    /**
    * This function create linking between roles table and permission_role table.
    *
    * @parms void;
    *
    * @return null
    */
    public function rolesId()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }
    
    /**
    * This function create linking between permissions table and permission_role table.
    *
    * @parms void;
    *
    * @return null
    */
    public function permissionId()
    {
        return $this->belongsTo('App\Permission', 'permission_id');
    }
}
