<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminVerifikasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function verifikasiDosen(User $user){
        $pengajuans = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','dosen_id','dosens.slug as dosen_slug')
                    ->where('status','3')    
                    ->get();
        return view('admin.verifikasi.dosens.index',compact('pengajuans','user'));
    }

    public function verifikasiDosenDetail(Dosen $dosen, $cuti_dosen){
        return view('admin.verifikasi.dosens.detail',[
            'detail'        =>  $dosen->cutis()->where('cuti_dosen.id',$cuti_dosen)->first(),
            'data_dosen'    =>  $dosen,
        ]);        
    }

    public function verifikasiDosenUpdate(Request $request, Dosen $dosen, $cuti_dosen){
        $this->validate($request,[
            'status'    =>  'required'
        ]);

        DB::table('cuti_dosen')->where('id',$cuti_dosen)->update([
            'status'    =>  $request->status
        ]);
        return redirect()->route('admin.verifikasi.dosens')->with(['success' =>  'Permohonan cuti dosen berhasil di verifikasi']);
    }
}
