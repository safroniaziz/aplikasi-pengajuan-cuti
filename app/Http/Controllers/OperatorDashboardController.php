<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorDashboardController extends Controller
{
    public function index(){
        return view('operator/dashboard');
    }
}
