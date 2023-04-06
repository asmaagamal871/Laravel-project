<?php

namespace App\Http\Controllers\Auth;
use App\Jobs\SendMailJob;
use App\Http\Controllers\Controller;
use App\Models\EndUser;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'mobile_no' => ['required', 'string', 'min:11', 'unique:end_users,mob_num'],
            'dateOfBirth' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $path = 'public/doctors/default.png';
        
        if (request()->file('avatar')) {
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
                'DOB' => $data['dateOfBirth'],
                'mob_num' => $data['mobile_no']
            ]
        );

        $newUser->assignRole('end-user');
        $newUser->givePermissionTo(['manage-own-addresses', 'manage-own-orders', 'update-own-user-info']);

        $mainUser = User::factory()->create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'typeable_type' => 'end_user',
                'typeable_id' => $newUser->id
            ]
        );
      
        $newUser->type()->save($mainUser);
        return $mainUser;
    }
}
