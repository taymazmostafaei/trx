<?php

namespace Modules\Ladmin\Http\Controllers;

use Modules\Ladmin\Http\Controllers\Controller;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return ladmin()->view('clients.index');
    }
}
