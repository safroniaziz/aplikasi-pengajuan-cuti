<?php

namespace App\Http\Controllers;

use App\Cuti;
use App\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        $pegawais = Pegawai::get();
        return view('admin.pegawais.index',compact('pegawais'));
    }

    public function show(Pegawai $pegawai){
        $cutis = $pegawai->cutis()->get();
        return view('admin/pegawais.show',compact('cutis','pegawai'));
    }
}
