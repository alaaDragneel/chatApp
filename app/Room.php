<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
    * [user Relations]
    * @return [Object] [object contains the relations data]
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
    * [messages Relation]
    * @return [Object] [object contains the relations data]
    */
    public function messages()
    {
        return $this->hasMany('App\Message', 'room_id');
    }
    
    /**
    * [online Relation]
    * @return [Object] [object contains the relations data]
    */
    public function online()
    {
        return $this->hasMany('App\whoIsOnline', 'room_id');
    }
}
