<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
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
    * [room Relation]
    * @return [Object] [object contains the relations data]
    */
    public function room()
    {
        return $this->belongsTo('App\Room', 'room_id');
    }
}
