<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;

class OperatorPegawaiController extends Controller
{
    public function index(){
        $pegawais = Pegawai::get();
        return view('operator.pegawais.index',compact('pegawais'));
    }

    public function show(Pegawai $pegawai){
        $cutis = $pegawai->cutis()->get();
        return view('admin/pegawais.show',compact('cutis','pegawai'));
    }
}
