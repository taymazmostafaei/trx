<?php

namespace Modules\Ladmin\Http\Controllers;

use Modules\Ladmin\Http\Controllers\Controller;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        return ladmin()->view('debts.index', ["debts" => auth()->user()->debts ?? []]);
    }
}
