<?php

namespace Modules\Ladmin\Http\Controllers\Auth;

use Hexters\Ladmin\Events\LadminLoginEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Ladmin\Http\Controllers\Controller;
use Modules\Ladmin\Models\Admin;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    /**
     * Login form
     *
     * @return view
     */
    public function showRegisterForm()
    {
        return ladmin()->view('auth.register');
    }

    /**
     * Register attempt
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function attempt(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email', 'unique:ladmin_accounts'],
            'name' => ['string','required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make($request->password), // password
        ]);

        if (Auth::guard( config('ladmin.auth.guard') )->loginUsingId($user->id)) {
            $request->session()->regenerate();

            event(new LadminLoginEvent(auth()->guard( config('ladmin.auth.guard') )->user()));

            return redirect()->route('ladmin.index');
        }
        return redirect()->back();
    }
}
