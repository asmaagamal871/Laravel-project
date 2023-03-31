<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use App\Models\User;
class UserController extends Controller
{
    public function index(Request $request)
    {
        
       return view('user.index');
    }
}
