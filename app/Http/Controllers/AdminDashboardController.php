<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $menunggu   =   count(DB::table('cuti_dosen')
                        ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                        ->where('status','3')
                        ->get());
        $today      =   count(DB::table('cuti_dosen')
                        ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                        ->whereDate('cuti_dosen.created_at',Carbon::today())
                        ->where('status','!=','1')
                        ->get());
        $total      =   count(DB::table('cuti_dosen')
                        ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                        ->where('status','!=','1')
                        ->get());

        $jumlah_dosen   =   count(DB::table('cuti_dosen')
                            ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                            ->groupBy('dosen_id')
                            ->where('status','!=','1')
                            ->get());
        $user = User::where('id',Auth::user()->id)->first();
        return view('admin/dashboard',compact('menunggu','today','total','jumlah_dosen','user'));
    }
}
