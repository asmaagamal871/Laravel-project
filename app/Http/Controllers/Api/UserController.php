<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\EndUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users=User::with('end_users');
        return $users;
    }
    public function show($id)
    {
        $user=User::find($id);
        return $user;
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $path = 'public/doctors/default.png';


        if ($request->name&&($user->name != $request->name)) {
            $user->name =  $request->name;
        } else {
            $user->name =  $user->name;
        }
        if ($request->password&&($user->password != $request->password)) {
            $user->password =  $request->password;
        } else {
            $user->password =  $user->password;
        }
        $user->save();

        $endUser=EndUser::find($user->typeable_id);

        if ($request->avatar&&($endUser->image!=$request->avatar)) {
            if ($request['avatar']) {
                $path = Storage::putFileAs(
                    'public/endUsers',
                    request()->file('avatar'),
                    request()->file('avatar')->getClientOriginalName()
                );
                $endUser->image=$path;
            }
        }

        if ($request->gender&&($endUser->gender != $request->gender)) {
            $endUser->gender =  $request->gender;
        }
        if ($request->DOB&&($endUser->DOB != $request->DOB)) {
            $endUser->DOB =  $request->DOB;
        }
        if ($request->mob_num&&($endUser->mob_num != $request->mob_num)) {
            $endUser->mob_num =  $request->mob_num;
        }
        if ($request->national_id&&($endUser->national_id != $request->national_id)) {
            $endUser->national_id =  $request->national_id;
        }
        $endUser->save();

        return new UserResource($user);
    }

    

}
