<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PegawaiDashboardController extends Controller
{
    public function index(Request $request, Dosen $dosen){
        $data_pegawai = $dosen->where('nip',Session::get('nip'))->first();
        if (empty($data_pegawai)) {
            return redirect()->route('pegawai.login.form')->with(['error'   =>  'Sesi login anda tidak ada/sudah habis !!']);
        }
        $jumlah     = count($dosen->cutis()->where('status','!=','1')->get());
        $menunggu   = count($dosen->cutis()->where('status','2')->get());
        $diteruskan   = count($dosen->cutis()->where('status','3')->get());
        $tidak_diteruskan   = count($dosen->cutis()->where('status','4')->get());
        $diterima   = count($dosen->cutis()->where('status','5')->get());
        $ditolak   = count($dosen->cutis()->where('status','6')->get());
        return view('pegawai/dashboard',compact('data_pegawai','jumlah','menunggu','diteruskan','tidak_diteruskan','diterima','ditolak'));
    }
}
