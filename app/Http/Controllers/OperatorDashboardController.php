<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function index(){
        return view('operator/dashboard');
    }
}
