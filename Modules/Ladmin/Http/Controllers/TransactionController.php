<?php

namespace Modules\Ladmin\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Modules\Ladmin\Datatables\AdminDatatables;
use Modules\Ladmin\Http\Controllers\Controller;
use Modules\Ladmin\Http\Requests\AdminRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return ladmin()->view('transaction.index');
    }
}
