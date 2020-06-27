<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;

class AdminPengajuanController extends Controller
{
    public function index(){
        $ajuans = Pegawai::get();
        return view('admin/pengajuans.index', compact('ajuans'));
    }
}
