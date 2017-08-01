<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Image;

use Auth;

use Response;

use File;

class UserController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'image|mimes:jpg,jpeg,png',
        ]);

        // check if undefined because it comes from vue js that make the empty values as unefined laravel cannot read undefined it read it like string

        if ($request->avatar === "undefined") {
            return Response::json(['avatar' => ['the avatar field is required']], 422);
        }

        $user = Auth::user();
        if ($user->avatar != '') {
            File::delete($user->avatar);
        }
        $avatar = $this->uploadImage($request->avatar);
        $user->avatar = $avatar;
        $user->save();

        $array = [
            'status' => 'done',
            'avatar' => $avatar
        ];

        return Response::json($array);
    }

    public function getAuthUserAvatar()
    {
        return getAvatar(Auth::user()->avatar);
    }

    // upload Avatar
    protected function uploadImage($file){

        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());

        $fileName = date("y-m-d-h-i-s") . "_" . $sha1 . "." . $extension;
        $path = public_path('images/avatars/');

        Image::make($file)->resize(200, 200)->save($path . $fileName, 60);
        return 'images/avatars/' . $fileName;
    }

}
