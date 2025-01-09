<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // check if new coming user is first or single
        $cnt = User::count();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($cnt === 0)
        {
            $perms_cnt = Permission::count();

            if ($perms_cnt === 0)
            {
                Permission::insert([
                    ["name" => 'permission.show', "title" => 'Ruxsatlarni ko\'rish', "guard_name" => 'web'],
                    ["name" => 'permission.edit', "title" => 'Ruxsatlarni o\'zgartirish', "guard_name" => 'web'],
                    ["name" => 'permission.add', "title" => 'Yangi ruxsat qo\'shish', "guard_name" => 'web'],
                    ["name" => 'permission.delete', "title" => 'Ruxsatlarni o\'chirish', "guard_name" => 'web'],

                    ["name" => 'roles.show', "title" => 'Rollarni ko\'rish', "guard_name" => 'web'],
                    ["name" => 'roles.edit', "title" => 'Rollarni o\'zgartirish', "guard_name" => 'web'],
                    ["name" => 'roles.add', "title" => 'Rollar qo\'shish', "guard_name" => 'web'],
                    ["name" => 'roles.delete', "title" => 'Rollarni o\'chirish', "guard_name" => 'web'],

                    ["name" => 'user.show', "title" => 'Userlarni ko\'rish', "guard_name" => 'web'],
                    ["name" => 'user.edit', "title" => 'Userlarni o\'zgartirish', "guard_name" => 'web'],
                    ["name" => 'user.add', "title" => 'Yangi Userlarni qo\'shish', "guard_name" => 'web'],
                    ["name" => 'user.delete', "title" => 'Userlarni o\'chirish', "guard_name" => 'web'],
                    ["name" => 'api-user.add', "title" => 'ApiUser Add', "guard_name" => 'web'],
                    ["name" => 'api-user.view', "title" => 'ApiUser View', "guard_name" => 'web'],
                    ["name" => 'api-user.edit', "title" => 'ApiUser Edit', "guard_name" => 'web'],
                    ["name" => 'api-user-passport.view', "title" => 'ApiUser Password view', "guard_name" => 'web'],

                    ["name" => 'remenders.show', "title" => 'Eslatmalarni ko\'rish', "guard_name" => 'web'],
                    ["name" => 'remenders.edit', "title" => 'Eslatmalarni o\'zgartirish', "guard_name" => 'web'],
                    ["name" => 'remenders.create', "title" => 'Eslatmalarniqo\'shish', "guard_name" => 'web'],
                    ["name" => 'remenders.destroy', "title" => 'Eslatmalarni o\'chirish', "guard_name" => 'web'],
                    ["name" => 'remenders.index', "title" => 'Eslatmalarni o\'chirish', "guard_name" => 'web'],

                    ["name" => 'states.show', "title" => 'Davlatlar ko\'rish', "guard_name" => 'web'],
                    ["name" => 'states.edit', "title" => 'Davlatlar o\'zgartirish', "guard_name" => 'web'],
                    ["name" => 'states.create', "title" => 'Davlatlar q\'shish', "guard_name" => 'web'],
                    ["name" => 'states.destroy', "title" => 'Davlatlar o\'chirish', "guard_name" => 'web'],
                    ["name" => 'states.index', "title" => 'Davlatlar o\'chirish', "guard_name" => 'web'],

                    ["name" => 'guests.show', "title" => 'Delegatsiyalar ko\'rish', "guard_name" => 'web'],
                    ["name" => 'guests.edit', "title" => 'Delegatsiyalar o\'zgartirish', "guard_name" => 'web'],
                    ["name" => 'guests.create', "title" => 'Delegatsiyalar q\'shish', "guard_name" => 'web'],
                    ["name" => 'guests.destroy', "title" => 'Delegatsiyalar qo\'chirish', "guard_name" => 'web'],
                    ["name" => 'guests.index', "title" => 'Delegatsiyalar o\'chirish', "guard_name" => 'web']
                ]);
            }

            $role_cnt = Role::count();

            if ($role_cnt === 0)
            {
                Role::create([
                    'name' => 'Super Admin',
                    'title' => 'Super Admin',
                    'guard_name' => 'web'
                ]);
            }
            $user->assignRole('Super admin');
        }

        return $user;
    }
}
