<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PermissionRole;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to permissions tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Permission extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    protected $fillable =
    [
        'title',
        'slug',
        'description',
        'parent_id',
        'status',
    ];
    
    /**
    * This function is used to fetch permission for logged user.
    *
    * @parms $role;
    *
    * @return $permissionslugarr
    */
    public static function getPermissionForLoggedUser($role = null)
    {
        $permissions = PermissionRole::with('permissionId')->where('role_id', $role)->get();
        $permissions = $permissions->toArray();

        $permissionsArr = array();
        foreach($permissions as $permission)
        {
            $permissionsArr[] = $permission['permission_id'];
        }

        $permissionSlugArr = array();

       foreach($permissionsArr as $permission)
       {
           $permissionSlugArr[] = $permission['slug'];
       }

       return $permissionSlugArr;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
    * This function create linking between roles table and permissions table.
    *
    * @parms void;
    *
    * @return null
    */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    
    /**
    * This function create linking between self table.
    *
    * @parms void;
    *
    * @return null
    */
    public function parent()
    {
        return $this->belongsTo('App\Permission', 0);
    }
    
    /**
    * This function create linking between self table.
    *
    * @parms void;
    *
    * @return null
    */
    public function children()
    {
        return $this->hasMany('App\Permission', 'parent_id');
    }
    
    /**
    * This function create linking between permission_role table and permissions table.
    *
    * @parms void;
    *
    * @return null
    */
    public function permission_role()
    {
        return $this->hasMany('App\PermissionRole', 'permission_id');
    }
    
    /**
    * This function create linking between permission_role table and permissions table.
    *
    * @parms void;
    *
    * @return null
    */
    public function permission_roleId()
    {
        return $this->hasOne('App\PermissionRole', 'role_id');
    }
}