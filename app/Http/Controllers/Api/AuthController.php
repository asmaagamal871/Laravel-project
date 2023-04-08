<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTokenRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\EndUserResource;
use App\Http\Resources\UserResource;
use App\Models\EndUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function tokenCreator(CreateTokenRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        User::where('id', $user->id)->update([
            "last_login" =>  Carbon::now()
        ]);

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function register(Request $data)
    {
        $path = 'public/doctors/default.png';
        if ($data['avatar']) {
            $path = Storage::putFileAs(
                'public/endUsers',
                request()->file('avatar'),
                request()->file('avatar')->getClientOriginalName()
            );
        }

        $newUser = EndUser::factory()->create(
            [
                'gender' => $data['gender'],
                'image' => $path,
                'DOB'=>$data['dateOfBirth'],
                'national_id'=>$data['national_id'],
                'mob_num'=>$data['mob_num'],
            ]
        );

        $mainUser = User::factory()->create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'typeable_type' => 'end_user',
                'typeable_id' => $newUser->id
            ]
        );

        $mainUser->assignRole('end-user');

        $newUser->type()->save($mainUser);

        event(new Registered($mainUser));
        
        return new UserResource($mainUser);
    }
}
