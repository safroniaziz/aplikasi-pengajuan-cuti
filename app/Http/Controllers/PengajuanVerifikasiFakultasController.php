<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengajuanVerifikasiFakultasController extends Controller
{
    public function disetujuiFakultas(Request $request, Dosen $dosen){
        $data_dosen =  Dosen::where('nip',Session::get('nip'))->first();
        if (empty($data_dosen)) {
            return redirect()->route('pegawai.login.form')->with(['error'   =>  'Sesi login anda tidak ada/sudah habis !!']);
        }
        $pengajuans = $data_dosen->cutis()->where('status','3')->whereNotNull('file_ajuan')->get();
        return view('pegawai/verifikasi_fakultas.index',compact('data_dosen','pengajuans'));
    }

    public function ditolakFakultas(Request $request, Dosen $dosen){
        $data_dosen =  Dosen::where('nip',Session::get('nip'))->first();
        if (empty($data_dosen)) {
            return redirect()->route('pegawai.login.form')->with(['error'   =>  'Sesi login anda tidak ada/sudah habis !!']);
        }
        $pengajuans = $data_dosen->cutis()->where('status','4')->whereNotNull('file_ajuan')->get();
        return view('pegawai/verifikasi_fakultas.ditolak',compact('data_dosen','pengajuans'));
    }
}
