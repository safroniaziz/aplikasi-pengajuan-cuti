<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengajuanVerifikasiUniversitasController extends Controller
{
    public function disetujuiUniversitas(Request $request, Dosen $dosen){
        $data_dosen =  Dosen::where('nip',Session::get('nip'))->first();
        if (empty($data_dosen)) {
            return redirect()->route('pegawai.login.form')->with(['error'   =>  'Sesi login anda tidak ada/sudah habis !!']);
        }
        $pengajuans = $data_dosen->cutis()->where('status','5')->whereNotNull('file_ajuan')->get();
        return view('pegawai/verifikasi_universitas.index',compact('data_dosen','pengajuans'));
    }

    public function ditolakUniversitas(Request $request, Dosen $dosen){
        $data_dosen =  Dosen::where('nip',Session::get('nip'))->first();
        if (empty($data_dosen)) {
            return redirect()->route('pegawai.login.form')->with(['error'   =>  'Sesi login anda tidak ada/sudah habis !!']);
        }
        $pengajuans = $data_dosen->cutis()->where('status','6')->whereNotNull('file_ajuan')->get();
        return view('pegawai/verifikasi_universitas.ditolak',compact('data_dosen','pengajuans'));
    }
}
