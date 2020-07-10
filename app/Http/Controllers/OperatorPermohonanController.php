<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OperatorPermohonanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function belumDiajukan(){
        $permohonans = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','status')
                    ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                    ->where('status','1')
                    ->get();
        return view('operator/permohonans.dosen.index',compact('permohonans'));
    }

    public function menungguVerifikasi(){
        $permohonans = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','status')
                    ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                    ->where('status','2')
                    ->get();
        return view('operator/permohonans.dosen.menunggu_verifikasi',compact('permohonans'));
    }

    public function dilanjutkan(){
        $permohonans = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','status')
                    ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                    ->where('status','3')
                    ->get();
        return view('operator/permohonans.dosen.dilanjutkan',compact('permohonans'));
    }

    public function tidakDilanjutkan(){
        $permohonans = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','status')
                    ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                    ->where('status','4')
                    ->get();
        return view('operator/permohonans.dosen.tidak_dilanjutkan',compact('permohonans'));
    }

    public function disetujui(){
        $permohonans = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','status')
                    ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                    ->where('status','5')
                    ->get();
        return view('operator/permohonans.dosen.disetujui',compact('permohonans'));
    }

    public function tidakDisetujui(){
        $permohonans = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','status')
                    ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                    ->where('status','6')
                    ->get();
        return view('operator/permohonans.dosen.tidak_disetujui',compact('permohonans'));
    }
}
