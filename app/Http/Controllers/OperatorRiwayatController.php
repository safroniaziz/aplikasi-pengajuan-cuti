<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperatorRiwayatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function riwayatDosenDisetujui(){
        $riwayats = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','status')
                    ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                    ->where('status','3')
                    ->get();
        return view('operator/riwayats.dosen.index',compact('riwayats'));
    }
}
