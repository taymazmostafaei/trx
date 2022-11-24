<?php

namespace Modules\Ladmin\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Ladmin\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $ServiceCount = Service::orderByDesc('id')->where('admin_id', Auth::user()->id)->count();
        
        return ladmin()->view('dashboard.index', ['ServiceCount' => $ServiceCount]);
    }
}
