<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\addRoomsRequest;

use App\Room;

use Auth;

class RoomsController extends Controller
{
    public function addNewRoom(addRoomsRequest $request)
    {
        $user = Auth::user();
        $room = new Room();
        $room->name = $request->name;
        $room->user_id = $user->id;
        $save = $room->save();
        if ($save) {
            return 'done';
        } else {
            return 'error';
        }
    }

    public function getAllRooms()
    {
        $rooms = Room::with('user')->get();
        return $rooms;
    }

    public function myRooms()
    {
        $user = Auth::user();
        $rooms = Room::where('user_id', $user->id)->get();
        return $rooms;
    }

    public function deleteMyRoom($id)
    {
        $user = Auth::user();
        $rooms = Room::where('id', $id)->where('user_id', $user->id);
        if ($rooms->count() > 0) {
            $delete = $rooms->delete();
            if ($delete) {
                return 'done';
            } else {
                return 'error';
            }
        }
        return 'notExist';
    }
}
