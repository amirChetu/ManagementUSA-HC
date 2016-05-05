<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    
    protected $fillable =
    [
        'permission_id',
        'role_id',
    ];
    
    public function rolesId()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }
    
    public function permissionId()
    {
        return $this->belongsTo('App\Permission', 'permission_id');
    }
}
