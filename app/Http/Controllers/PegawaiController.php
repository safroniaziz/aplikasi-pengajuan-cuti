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

    public function add(){
        return view('admin/pegawais.add',['title'   =>  'Simpan Data','pegawai' =>  new Pegawai()]);
    }

    public function edit(Pegawai $pegawai){
        // $pegawai = Pegawai::find($slug);
        return view('admin/pegawais.edit',compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai){
        $this->validate($request,[
            'nm_pegawai'    =>  'required',
            'nip'    =>  'required',
            'jenis_kelamin'    =>  'required',
            'jabatan'    =>  'required',
            'level_departemen'    =>  'required',
            'cabang'    =>  'required',
            'jenis_kepegawaian'    =>  'required',
        ]);

        $pegawai->update([
            'nm_pegawai'    =>  $request->nm_pegawai,
            'nip'    =>  $request->nip,
            'jenis_kelamin'    =>  $request->jenis_kelamin,
            'jabatan'    =>  $request->jabatan,
            'level_departemen'    =>  $request->level_departemen,
            'cabang'    =>  $request->cabang,
            'jenis_kepegawaian'    =>  $request->jenis_kepegawaian,
        ]);
        $pegawai->cutis()->sync(request('cutis'));

        return redirect()->route('admin.pegawais')->with(['success' =>  'Data pegawai baru sudah diubah !!']);
    }

    public function delete(Pegawai $pegawai){
        $pegawai->cutis()->detach();
        $pegawai->delete();
        return redirect()->route('admin.pegawais')->with(['success' =>  'Data pegawai berhasil dihapus !!']);
    }
}
