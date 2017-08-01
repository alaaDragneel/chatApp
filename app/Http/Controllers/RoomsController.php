<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\addRoomsRequest;

use App\Room;

use App\whoIsOnline as Online;

use Auth;

use Response;

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
            triggerPusher('room', 'room_status', $this->getAllRooms());
            return 'done';
        } else {
            return 'error';
        }
    }

    public function getAllRooms()
    {
        $rooms = Room::with('user')->withCount('online')->get();
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
        $room = Room::where('id', $id)->where('user_id', $user->id);
        if ($room->count() > 0) {
            $roomOnlineUsersCount = $room->withCount('online')->first()->online_count;
            if ($roomOnlineUsersCount > 0) {
                return Response::json(['Your Room Not Empty ' . $roomOnlineUsersCount . ' User/s Found'], 422);
            }
            $delete = $room->delete();
            if ($delete) {
                triggerPusher('room', 'room_status', $this->getAllRooms());
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
            Online::where('user_id', $user->id)->delete();


            // update the online users count in the all rooms page
            $this->update_online_rooms_users_counter();

            // Update When User Leave
            // Get Online User Count
            $this->getUserStatus($leaveRoom->room_id, $user->name . ' Leave The Room', 'offline');

            // add It to The Other room
            $this->create_online($user->id, $room_id);
        }

        // update the online users count in the all rooms page
        $this->update_online_rooms_users_counter();
        $this->getUserStatus($room_id, $user->name . ' Enter The Room');
        return 'done';
    }

    public function getMeLeaving($room_id)
    {
        $user = Auth::user();
        // delete User from The first room
        Online::where('user_id', $user->id)->delete();
        // update the online users count in the all rooms page
        $this->update_online_rooms_users_counter();
        $this->getUserStatus($room_id, $user->name . ' Leave The Browser', 'offline');
    }

    protected function getUserStatus($room_id, $username, $type = 'online' )
    {
        // Get Online User Count
        $room = Room::where('id', $room_id)->withCount('online')->first()->online_count;
        // Get Online Users Who WIll Leave => all data Go To chatBox.vue to put it in the component
        $onlineUsers = Online::where('room_id', $room_id)->with('user')->get();
        $array = [
            'count' => $room,
            'users' => $onlineUsers,
            'action' => $username
        ];

        if ($type == 'online') {
            triggerPusher($room_id . 'online', 'online_user', $array);
        } else {

            triggerPusher($room_id . 'offline', 'leave_user', $array);
        }

    }

    protected function update_online_rooms_users_counter()
    {
        return triggerPusher('room', 'room_status', $this->getAllRooms());
    }

    protected function create_online($user_id, $room_id)
    {
        $online = new Online();
        $online->user_id = $user_id;
        $online->room_id = $room_id;
        $online->save();
    }


}
