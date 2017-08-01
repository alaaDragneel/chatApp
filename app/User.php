<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * [rooms Relation]
    * @return [Object] [object contains the relations data]
    */
    public function rooms()
    {
        return $this->hasMany('App\Room', 'user_id');
    }

    /**
    * [messages Relation]
    * @return [Object] [object contains the relations data]
    */
    public function messages()
    {
        return $this->hasMany('App\Message', 'user_id');
    }

    /**
    * [online Relation]
    * @return [Object] [object contains the relations data]
    */
    public function online()
    {
        return $this->hasOne('App\whoIsOnline', 'user_id');
    }
}
