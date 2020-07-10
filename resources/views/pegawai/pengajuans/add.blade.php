@extends('layouts.app')
@section('title', 'Manajemen Jabatan')
@section('login_as', 'Pegawai')
@section('user-login')
    {{ $data_dosen['gelar_depan'] .$data_dosen['nm_dosen'] .' '.$data_dosen['gelar_belakang'] }}
@endsection
@section('user-login2')
    {{ $data_dosen['gelar_depan'] .$data_dosen['nm_dosen'] .' '.$data_dosen['gelar_belakang'] }}
@endsection
@section('sidebar-menu')
    @include('pegawai/sidebar')
@endsection
@section('content')
    <section class="panel" style="margin-bottom:20px;">
        <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
            <i class="fa fa-home"></i>&nbsp;Aplikasi Permohonan Surat Cuti Pegawai Universitas Bengkulu
        </header>
        <div class="panel-body" style="border-top: 1px solid #eee; padding:15px; background:white;">
            <div class="row" style="margin-right:-15px; margin-left:-15px;">
                <div class="col-md-12">
                    <h5 class="text-center text-info"><i class="fa fa-tasks"></i>&nbsp; Form Pengajuan Cuti Pegawai Universitas Bengkulu</h5>
                    @csrf
                    <form action="{{ route('pegawai.pengajuans.new.post',[$data_dosen->slug]) }}" method="POST">
                        @csrf
                        @include('pegawai/pengajuans.form_tambah')
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered"></table>
                </div>
            </div>
        </div>
    </section>
@endsection