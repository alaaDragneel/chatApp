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
            * [triggerPusher => Trigger The Pusher Realtime]
            * [NOTE Function Can be foud In App/Helper/Notification.php]
            */
            triggerPusher($lastMessage->room->id . 'room', 'add_new_message', $lastMessage);
        } else {
            return 'error';
        }
    }

}
