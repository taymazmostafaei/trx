<?php

namespace Modules\Ladmin\Http\Controllers\Auth;

use Hexters\Ladmin\Events\LadminLoginEvent;
use Hexters\Ladmin\Events\LadminLogoutEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Modules\Ladmin\Http\Controllers\Controller;

class LoginController extends Controller
{

    /**
     * Login form
     *
     * @return view
     */
    public function showLoginForm()
    {
        return ladmin()->view('auth.login');
    }

    /**
     * Login attempt
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function attempt(Request $request)
    {

        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard( config('ladmin.auth.guard') )->attempt($data, $request->remember)) {
            $request->session()->regenerate();

            event(new LadminLoginEvent(auth()->guard( config('ladmin.auth.guard') )->user()));

            //authenticate xui
            $response = Http::post('http://'. env('XUI_IP') .':43210/login', ['username' => 'admin', 'password' => 'admin']);
            $session = $response->cookies()->getCookieByName('session')->getValue();
            Cache::add('xuisession', $session);

            return redirect()->route('ladmin.index');
        }

        session()->flash('warning', [
            __('auth.failed')
        ]);

        return redirect()->back()->withInput();
    }

    /**
     * Admin Logout
     *
     * @return void
     */
    public function logout()
    {


        event(new LadminLogoutEvent(
            auth()->guard(config('ladmin.auth.guard'))->user()
        ));

        auth()->guard(config('ladmin.auth.guard'))->logout();
        return redirect()->route('ladmin.login');
    }
}
