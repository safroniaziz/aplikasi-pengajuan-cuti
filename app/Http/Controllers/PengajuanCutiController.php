<?php

namespace App\Http\Controllers;

use App\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Dosen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

;

class PengajuanCutiController extends Controller
{
    public function index(Request $request, Dosen $dosen){
        $data_dosen =  Dosen::where('nip',Session::get('nip'))->first();
        if (empty($data_dosen)) {
            return redirect()->route('pegawai.login.form')->with(['error'   =>  'Sesi login anda tidak ada/sudah habis !!']);
        }
        $pengajuans = $data_dosen->cutis()->where('status','1')->get();
        return view('pegawai/pengajuans.index',compact('data_dosen','pengajuans'));
    }

    public function add(){
        $data_dosen =  Dosen::where('nip',Session::get('nip'))->first();
        $cutis = Cuti::get();
        return view('pegawai/pengajuans.add',[
            'data_dosen'    =>  $data_dosen,
            'cutis'    =>  $cutis,
            'data_cuti' =>  new Cuti() 
        ]);
    }

    public function post(Request $request, Dosen $dosen){
        $this->validate($request,[
            'cuti_id'           =>  'required',
            'keterangan'        =>  'required',
            'tanggal_awal'      =>  'required',
            'tanggal_akhir'     =>  'required',
        ]);

        $dosen->cutis()->attach($request->cuti_id,[
            'keterangan'        =>  $request->keterangan,
            'tanggal_awal'      =>  $request->tanggal_awal,
            'tanggal_akhir'     =>  $request->tanggal_akhir,
        ]);
        return redirect()->route('pegawai.pengajuans.new',[$dosen->slug])->with(['success' =>  'Pengajuan cuti berhasil ditambahkan !!']);
    }

    public function edit(Dosen $dosen, $pivot_id){
        return view('pegawai/pengajuans.edit',[
            'data_dosen'    =>  $dosen,
            'cutis'         =>  Cuti::get(),
            'data_cuti'     =>  $dosen->cutis()->where('cuti_dosen.id',$pivot_id)->first(),
        ]);
    }

    public function update(Request $request, Dosen $dosen, $pivot_id){
        $this->validate($request,[
            'cuti_id'           =>  'required',
            'keterangan'        =>  'required',
            'tanggal_awal'      =>  'required',
            'tanggal_akhir'     =>  'required',
        ]);

        DB::table('cuti_dosen')->where('id',$pivot_id)->update([
            'cuti_id'       =>  $request->cuti_id,
            'keterangan'    =>  $request->keterangan,
            'tanggal_awal'  =>  $request->tanggal_awal,
            'tanggal_akhir' =>  $request->tanggal_akhir,
        ]);
        return redirect()->route('pegawai.pengajuans.new',[$dosen->slug])->with(['success' =>  'Pengajuan cuti berhasil diubah !!']);
    }

    public function send(Dosen $dosen, $pivot_id){
        return view('pegawai/pengajuans.send',[
            'data_dosen'   =>  $dosen,
            'data_cuti'    =>  $dosen->cutis()->where('cuti_dosen.id',$pivot_id)->first(),
        ]);
    }

    public function sendSubmit(Request $request,Dosen $dosen, $pivot_id){
        $this->validate($request,[
            'file_permohonan'   =>  'required|mimes:jpeg,png,pdf|max:1024',
        ]);
        // DB::beginTransaction();
        $data = DB::table('cuti_dosen')->where('id',$pivot_id)->get();
        // return request()->file('file_permohonan');
        try {
            if (!empty(request()->file('file_permohonan'))) {
                Storage::delete($data[0]->file_ajuan);
                $fileUrl = $request->file_permohonan->store('files/permohonans/'.$dosen->slug.'-'.$dosen->nip);
            }
            DB::table('cuti_dosen')->where('id',$pivot_id)->update([
                'file_ajuan'    =>  $fileUrl,
                'status'        =>  '2',
            ]);
            return redirect()->route('pegawai.pengajuans.new',[$dosen->slug])->with(['success' =>  'File pengajuan cuti berhasil dikirimkan, silahkan cek status permohonan anda pada menu verifikasi fakultas !!']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pegawai.pengajuans.new',[$dosen->slug])->with(['error' =>  'File pengajuan cuti gagal dikirimkan, silahkan cek koneksi internet anda atau coba lagi nanti !!']);
        }
    }

    public function menunggu(Request $request, Dosen $dosen){
        $data_dosen =  Dosen::where('nip',Session::get('nip'))->first();
        if (empty($data_dosen)) {
            return redirect()->route('pegawai.login.form')->with(['error'   =>  'Sesi login anda tidak ada/sudah habis !!']);
        }
        $pengajuans = $data_dosen->cutis()->where('status','2')->get();
        return view('pegawai/pengajuans.menunggu',compact('data_dosen','pengajuans'));
    }

    public function semuaPermohonan(Request $request, Dosen $dosen){
        $data_dosen =  Dosen::where('nip',Session::get('nip'))->first();
        if (empty($data_dosen)) {
            return redirect()->route('pegawai.login.form')->with(['error'   =>  'Sesi login anda tidak ada/sudah habis !!']);
        }
        $pengajuans = $data_dosen->cutis()->get();
        return view('pegawai/pengajuans.semua_pengajuan',compact('data_dosen','pengajuans'));
    }
}