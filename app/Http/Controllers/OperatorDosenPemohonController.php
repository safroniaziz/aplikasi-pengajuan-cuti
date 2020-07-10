<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dosen;

class OperatorDosenPemohonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function index(){
        $pemohons = Dosen::get();
        return view('operator.pemohons.dosen.index',compact('pemohons'));
    }

    public function show(Dosen $dosen){
        $cutis = $dosen->cutis()->get();
        return view('operator/pemohons.dosen.show',compact('cutis','dosen'));
    }

    public function verifikasi(Request $request, Dosen $dosen){
        $this->validate($request,[
            'status'    =>  'required',
        ]);
        $dosen->cutis()->updateExistingPivot($request->id,[
            'status'    =>  $request->status
        ]);
        return redirect()->route('operator.pemohons.dosen.show',[$dosen->slug])->with(['success'    =>  'Verifikasi pengajuan cuti dosen berhasil !!']);
    }
}
