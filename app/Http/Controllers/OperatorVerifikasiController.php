<?php

namespace App\Http\Controllers;

use App\Cuti;
use App\CutiDosen;
use App\Dosen;
use App\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperatorVerifikasiController extends Controller
{
    public function verifikasiDosen(Operator $operator){
        $pengajuans = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','dosen_id','dosens.slug as dosen_slug')
                    ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                    ->where('status','2')    
                    ->get();
        return view('operator.verifikasi.dosens.index',compact('pengajuans','operator'));
    }

    public function verifikasiDosenDetail(Dosen $dosen, $cuti_dosen){
        return view('operator.verifikasi.dosens.detail',[
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
        return redirect()->route('operator.verifikasi.dosens',[Auth::guard('operator')->user()->slug])->with(['success' =>  'Permohonan cuti dosen berhasil di verifikasi']);
    }
}
