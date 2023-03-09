<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function impersonate(User $user)
    {
        if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin')) {
            if (Auth::user()->hasRole('Admin') && $user->hasRole('Admin')) {
                $messages['danger'] = "You Can not Impersonate Admin";
                return redirect()->back()
                    ->with('messages', $messages);
            }
            auth()->user()->impersonate($user);
            return redirect()->route('dashboard');
        }
        $messages['danger'] = "Not Authorized!";
        return redirect()->back()
            ->with('messages', $messages);
    }

    public function leaveImpersonate()
    {
        auth()->user()->leaveImpersonation();

        return redirect()->route('dashboard');
    }
}
