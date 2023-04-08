<?php

namespace App\Http\Controllers;

use App\DataTables\EndUsersDataTable;
use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
// use Yajra\DataTables\Facades\Datatables;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Models\EndUser;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(EndUsersDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $path = 'public/doctors/default.png';
        if ($request['image']) {
            $path = Storage::putFileAs(
                'public/endUsers',
                request()->file('image'),
                request()->file('image')->getClientOriginalName()
            );
        }

        $newUser = EndUser::factory()->create(
            [
                'gender' => $request['gender'],
                'image' => $path,
                'DOB'=>$request['DOB'],
                'national_id'=>$request['national_id'],
                'mob_num'=>$request['mob_num'],
            ]
        );

        $mainUser = User::factory()->create(
            [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'typeable_type' => 'end_user',
                'typeable_id' => $newUser->id
            ]
        );
        
        $newUser->assignRole('end-user');
        $newUser->givePermissionTo(['manage-own-addresses', 'manage-own-orders', 'update-own-user-info','delete-orders']);

        $newUser->type()->save($mainUser);
        return redirect()->route("users.index");
    }
    public function show($id)
    {
        // $user=User::where('id', $id)->first();
        $user = EndUser::find($id);
        // dd($user);
        return view("user.show", ['user'=>$user]);
    }


    public function edit($id)
    {
        $user = EndUser::find($id);
        // dd($user->type->name);
        // $endUser=EndUser::find($user->typeable_id);

        return view("user.edit", [ 'user'=>$user]);
    }



    public function update(Request $request, $id)
    {
    
        $endUser = EndUser::find($id);
        $user=User::find($endUser->type->id);

        $path = 'public/doctors/default.png';

        if ($request->name&&($user->name != $request->name)) {
            $user->name =  $request->name;
        }
        if ($request->password&&($endUser->type->password != $request->password)) {
            $endUser->type->password =  $request->password;
        }
        $user->save();


        if ($request->image&&($endUser->image!=$request->image)) {
            if ($request['image']) {
                $path = Storage::putFileAs(
                    'public/endUsers',
                    request()->file('image'),
                    request()->file('image')->getClientOriginalName()
                );
                $endUser->image=$path;
            }
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

        return redirect()->route("users.index");
    }


    public function destroy($id)
    {
        $user = User::find($id);

        $endUser=EndUser::find($user->typeable_id);

        if ($endUser->image && Storage::exists($endUser->image)) {
            Storage::delete($endUser->image);
        }



        $endUser->delete();
        $user->delete();
        return redirect()->route('users.index');
    }
}
