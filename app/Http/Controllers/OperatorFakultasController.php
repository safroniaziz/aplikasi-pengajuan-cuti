<?php

namespace App\Http\Controllers;

use App\Operator;
use Illuminate\Http\Request;

class OperatorFakultasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function index(){
        $operators = Operator::get();
        return view('admin/operators.index',compact('operators'));
    }
}
