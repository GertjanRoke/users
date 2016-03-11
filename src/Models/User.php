<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\User as MeSelf;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get all the roles that belong to this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * Check if a logged in user has a specific rol or one of the given roles
     * 
     * @param  array $roles
     * @return boolean
     */
    public static function hasRoles(array $roles)
    {
        $user = \Auth::user();
        foreach($roles as $role) {
            if(in_array($role, $user->roles->lists('name')->toArray())) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the id of the first role
     * 
     * @return int
     */
    public function getRoleId()
    {
        return $this->roles()->first()->id;
    }

    /**
     * Get the name of the first role
     * 
     * @return string
     */
    public function getRoleName()
    {
        return $this->roles()->first()->name;
    }
}
