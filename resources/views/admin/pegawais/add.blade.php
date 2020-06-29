@extends('layouts.app')
@section('title', 'Manajemen Jabatan')
@section('login_as', 'Admin Universitas')
@section('user-login')
    @if (Auth::check())
    {{ Auth::user()->nm_user }}
    @endif
@endsection
@section('user-login2')
    @if (Auth::check())
    {{ Auth::user()->nm_user }}
    @endif
@endsection
@section('sidebar-menu')
    @include('admin/sidebar')
@endsection
@section('content')
@section('content')
    <section class="panel" style="margin-bottom:20px;">
        <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
            <i class="fa fa-home"></i>&nbsp;Remunerasi Tenaga Kependidikan Universitas Bengkulu
        </header>
        <div class="panel-body" style="border-top: 1px solid #eee; padding:15px; background:white;">
            <div class="row" style="margin-right:-15px; margin-left:-15px;">
                <div class="col-md-12">
                    <h5 class="text-center text-info"><i class="fa fa-user-plus"></i>&nbsp; Penambahan Data Pegawai Baru</h5>
                    @csrf
                    <form action="{{ route('admin.pegawais.post') }}" method="POST">
                        @csrf
                        @include('admin/pegawais.form')
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection