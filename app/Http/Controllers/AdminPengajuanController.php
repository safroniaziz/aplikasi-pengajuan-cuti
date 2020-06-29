<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;

class AdminPengajuanController extends Controller
{
    public function index(){
        $ajuans = Pegawai::get();
        return view('admin/pengajuans.index', compact('ajuans'));
    }

    public function verifikasi(Request $request, Pegawai $pegawai){
        $this->validate($request,[
            'status'    =>  'required',
        ]);
        $pegawai->cutis()->updateExistingPivot($request->id,[
            'status'    =>  $request->status
        ]);
        return redirect()->route('admin.pegawais.show',[$pegawai->slug])->with(['success'    =>  'Verifikasi pengajuan cuti pegawai berhasil !!']);
    }
}
