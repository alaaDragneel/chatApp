<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\addMessagesRequest;

use App\Message;

use Auth;

use Response;

class MessagesController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function addNewMessage(Request $request)
    {
        $user = Auth::user();
        $message = new Message();
        $message->body = $request->body;
        $message->user_id = $user->id;
        $message->room_id = $request->room_id;
        $save = $message->save();
        if ($save) {
            $lastMessage = Message::where('id', $message->id)->with('user')->first();
            /**
             * [$this->triggerPusher Trigger The Pusher Realtime]
             */
            $this->triggerPusher($lastMessage->room->id . 'room', 'add_new_message', $lastMessage);
        } else {
            return 'error';
        }
    }
    /**
     * [triggerPusher description]
     * @param  [string] $room_channel [The Channel That The Data Will Send In]
     * @param  [string] $event        [The Event Name That WIll Happend]
     * @param  [Object] $data         [The Data Object NOTE => [The Message]]
     */
    public function triggerPusher($room_channel, $event, $data)
    {
        $pusher = new \Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), ['cluster' => env('PUSHER_APP_CLUSTER')]);
        $pusher->trigger( $room_channel, $event, [$data] );
    }

}
