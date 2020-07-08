<?php

namespace App\Http\Controllers;

use App\Operator;
use Illuminate\Http\Request;

class OperatorFakultasController extends Controller
{
    public function index(){
        $operators = Operator::get();
        return view('admin/operators.index',compact('operators'));
    }
}
