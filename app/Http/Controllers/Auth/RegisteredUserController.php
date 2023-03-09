<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Location;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $ip = 'https://www.tutsmake.com/';
        $data = Location::get($ip);
        $country = Country::where('iso', $data->countryCode)->first();

        $roles = Role::all();
        return view('auth.register', compact('country', 'roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required',
            'phone_number' => ['required'],
            'code' => ['required'],

        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->code . $request->phone_number,
        ]);
        $user->assignRole([$request->role]);
        event(new Registered($user));

        $messages['success'] = "User Addedd Successfully";
        return redirect()->route('dashboard')
            ->with('messages', $messages);
    }
}
