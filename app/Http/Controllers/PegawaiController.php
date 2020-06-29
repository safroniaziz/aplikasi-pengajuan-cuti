<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        $pegawais = Pegawai::get();
        return view('admin.pegawais.index',compact('pegawais'));
    }

    public function show(Pegawai $pegawai){
        $cutis = $pegawai->cutis()->get();
        return view('admin/pegawais.show',compact('cutis','pegawai'));
    }

    public function post(Request $request){
        $this->validate($request,[
            'nm_pegawai'    =>  'required',
            'nip'    =>  'required',
            'jenis_kelamin'    =>  'required',
            'jabatan'    =>  'required',
            'level_departemen'    =>  'required',
            'cabang'    =>  'required',
            'jenis_kepegawaian'    =>  'required',
        ]);

        Pegawai::create([
            'nm_pegawai'    =>  $request->nm_pegawai,
            'nip'    =>  $request->nip,
            'slug'    =>  Str::slug($request->nm_pegawai),
            'jenis_kelamin'    =>  $request->jenis_kelamin,
            'jabatan'    =>  $request->jabatan,
            'level_departemen'    =>  $request->level_departemen,
            'departemen'    =>  'Universitas Bengkulu/'.$request->level_departemen,
            'cabang'    =>  $request->cabang,
            'jenis_kepegawaian'    =>  $request->jenis_kepegawaian,
        ]);

        return redirect()->route('admin.pegawais')->with(['success' =>  'Data pegawai baru sudah ditambahkan !!']);
    }

    public function edit($id){
        $pegawai = Pegawai::find($id);
        return $pegawai;
    }

}
