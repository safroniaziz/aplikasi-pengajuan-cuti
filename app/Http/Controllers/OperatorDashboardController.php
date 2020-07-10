<?php

namespace App\Http\Controllers;

use App\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperatorDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function index(){
        $menunggu   =   count(DB::table('cuti_dosen')
                        ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                        ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                        ->where('status','2')
                        ->get());
        $today      =   count(DB::table('cuti_dosen')
                        ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                        ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                        ->whereDate('cuti_dosen.created_at',Carbon::today())
                        ->where('status','!=','1')
                        ->get());
        $total      =   count(DB::table('cuti_dosen')
                        ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                        ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                        ->where('status','!=','1')
                        ->get());

        $jumlah_dosen   =   count(DB::table('cuti_dosen')
                            ->join('dosens','dosens.id','cuti_dosen.dosen_id')
                            ->where('dosens.departemen_id',Auth::guard('operator')->user()->dept_id)
                            ->groupBy('dosen_id')
                            ->where('status','!=','1')
                            ->get());
        $operator = Operator::where('nip',Auth::guard('operator')->user()->nip)->first();
        return view('operator/dashboard',compact('menunggu','today','total','jumlah_dosen','operator'));
    }
}
