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
    public function addNewRoom(Request $request)
    {
        $user = Auth::user();
        $message = new Message();
        $message->body = $request->body;
        $message->user_id = $user->id;
        $message->room_id = $request->room_id;
        $save = $message->save();
        if ($save) {
            $lastMessage = Message::where('id', $message->id)->with('user')->first();
            return $lastMessage;
        } else {
            return 'error';
        }
    }

}
