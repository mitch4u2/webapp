<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birthday', 'address','team_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany('App\Post');
    }
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function likeposts(){
        return $this->hasMany('App\LikePost');
    }

    public function favorites(){
        return $this->hasMany('App\Favorite');
    }

    public function team(){
        return $this->belongsTo('App\Team');
    }
    
    public function roles(){
        return $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

}
