<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class whoIsOnline extends Model
{
    /**
    * You don't have to worry about overriding created_at and updated_at.
    * They will be merged with the $dates array.
    * NOTE {REFERENCES}
    * NOTE https://stackoverflow.com/questions/28551538/how-to-implement-laravel-custom-carbon-timestamp
    */
    protected $dates = ['login_at, logout_at'];

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
