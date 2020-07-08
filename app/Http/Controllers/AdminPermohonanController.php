<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPermohonanController extends Controller
{
    public function verifikasiDosen(){
        $pengajuans = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','prodi_nama','fakultas_nama','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','dosen_id','dosens.slug as dosen_slug')
                    ->where('status','3')    
                    ->get();
        return view('admin.verifikasi.dosens.index',compact('pengajuans'));
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

    public function riwayatDosenDisetujui(){
        $riwayats = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','status')
                    ->where('status','5')
                    ->get();
        return view('admin/riwayats.dosen.index',compact('riwayats'));
    }

    public function riwayatDosenTidakDisetujui(){
        $riwayats = DB::table('cuti_dosen')
                    ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                    ->join('cutis','cutis.id','cuti_dosen.cuti_id')
                    ->select('cuti_dosen.id as cuti_dosen_id','nm_dosen','nip','gelar_depan','gelar_belakang','keterangan','prodi_nama','fakultas_nama',
                                'tanggal_awal','tanggal_akhir','jenis_cuti','file_ajuan','status')
                    ->where('status','6')
                    ->get();
        return view('admin/riwayats.dosen.ditolak',compact('riwayats'));
    }
}
