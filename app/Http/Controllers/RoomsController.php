<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\addRoomsRequest;

use App\Room;

use App\whoIsOnline as Online;

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

    public function getMeOnline($room_id)
    {
        $user = Auth::user();
        $ifUserOnline = Online::where('user_id', $user->id)->count();
        if ($ifUserOnline == 0) {
            // New User

            $this->create_online($user->id, $room_id);

        } else {
            // Leave Chat Room And Go To Another Room
            // delete User from The first room
            $leaveRoom = Online::where('user_id', $user->id)->first();
            $leaveRoom->delete();

            // Update When User Leave
            $room = Room::where('id', $leaveRoom->room_id)->withCount('online')->first()->online_count;
            triggerPusher($leaveRoom->room_id . 'offline', 'leave_user', $room);

            // add It to The Other room
            $this->create_online($user->id, $room_id);
        }
        $room = Room::where('id', $room_id)->withCount('online')->first()->online_count;
        triggerPusher($room_id . 'online', 'online_user', $room);
        return 'done';
    }

    public function create_online($user_id, $room_id)
    {
        $online = new Online();
        $online->user_id = $user_id;
        $online->room_id = $room_id;
        $online->save();
    }
}
