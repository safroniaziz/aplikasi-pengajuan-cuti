@extends('layouts.app')
@section('title', 'Manajemen Jabatan')
@section('login_as', 'Operator Fakultas')
@section('user-login')
    @if (Auth::check())
    {{ Auth::guard('operator')->user()->nm_user }}
    @endif
@endsection
@section('user-login2')
    @if (Auth::check())
    {{ Auth::guard('operator')->user()->nm_user }}
    @endif
@endsection
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-3 col-sm-12 ">
            <section class="panel" style="margin-bottom:20px;">
                <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
                    <i class="fa fa-user"></i>&nbsp;Profil {{ $dosen->nm_dosen }}
                </header>
                <div class="panel-body" style="border-top: 1px solid #eee; padding:15px; background:white;">
                    <div class="row" style="margin-right:-15px; margin-left:-15px;">
                        <div class="col-md-12 pl-2 justify-content-center text-center">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive img-thumbnail avatar-view img-fluid " style="height: 150px" src="{{ asset('assets/images/logo.png') }}" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h5 class="mt-3 text-uppercase">
                                {{ $dosen->nm_dosen }}
                            </h5>
                            <ul class="list-unstyled user_data">
                                <table class="table table-hover">
                                    <tr>
                                        <td class="text-uppercase">
                                            <i class="fa fa-user user-profile-icon"></i>&nbsp;Nip : {{ $dosen->nip }}
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="text-uppercase">
                                            <i class="fa {{ $dosen->jenis_kelamin == '1' ? 'fa-male' : 'fa-female' }} user-profile-icon"></i>&nbsp;Jenis Kelamin {{ $dosen->jenis_kelamin == '1' ? 'Laki-Laki' : 'Perempuan' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">
                                            <i class="fa fa-briefcase user-profile-icon"></i>&nbsp;Program Studi : {{ $dosen->prodi_nama }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">
                                            <i class="fa fa-briefcase user-profile-icon"></i>&nbsp;Fakultas : {{ $dosen->fakultas_nama }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-uppercase">
                                            <i class="fa fa-university user-profile-icon"></i>&nbsp;Departemen : {{ $dosen->departemen_nama }}
                                        </td>
                                    </tr>
                                </table>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-9 col-sm-12 ">
            <section class="panel" style="margin-bottom:20px;">
                <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
                    <i class="fa fa-user"></i>&nbsp;Riwayat Pengajuan Cuti {{ $dosen->nm_dosen }}
                </header>
                <div class="panel-body" style="border-top: 1px solid #eee; padding:15px; background:white;">
                    <div class="row" style="margin-right:-15px; margin-left:-15px;">
                        <div class="col-md-12 pr-4 pl-4">
                            <ul class="messages">
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        <strong>Berhasil : </strong>{{ session()->get('success') }}
                                    </div>
                                @endif
                                @if (count($cutis)>0)
                                    <div class="alert alert-success">
                                        <strong>Pethatian : </strong>Berikut semua pengajuan surat cuti yang diajukan oleh <b class="text-uppercase">{{ $dosen->nm_dosen }}</b> dari <b class="text-uppercase">{{ $dosen->departemen_nama }}</b>
                                    </div>
                                    @else
                                    <div class="alert alert-danger">
                                        <strong>Pethatian : </strong><b class="text-uppercase">{{ $dosen->nm_dosen }}</b> dari <b class="text-uppercase">{{ $dosen->departemen_nama }}</b> belum pernah mengajukan surat permohona cuti
                                    </div>
                                @endif
                                @if (count($cutis) > 0)
                                    @foreach ($cutis as $cuti)
                                        <li class="mt-3">
                                            <img src="{{ asset('assets/images/logo.png') }}" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-info">{{ $cuti->created_at->format('d') }}</h3>
                                                <p class="month">{{ $cuti->created_at->format('M') }}</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">{{ $cuti->jenis_cuti }}</h4>
                                                <blockquote class="message">{{ $cuti['pivot']->keterangan }}</blockquote>
                                                <hr>
                                                <div>
                                                    <p>Waktu Pengajuan Cuti : {{ $cuti['pivot']->created_at->format('d F, Y') }} sampai {{ Carbon\Carbon::parse($cuti['pivot']->tanggal_akhir)->format('d F, Y') }}</p>
                                                </div>
                                                <div>
                                                    <p>Waktu Pengajuan Cuti : {{ $cuti['pivot']->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div>
                                                    <p>File Pengajuan Cuti : <a href="">Download Disini</a></p>
                                                </div>
                                                <div>
                                                    <p>Status Pengajuan Cuti : 
                                                        @if ($cuti['pivot']->status == "3")
                                                            <a class="text-info">Ajuan Dilanjutkan</a>
                                                            @elseif($cuti['pivot']->status == "2")
                                                            <a class="text-warning">Ajuan Belum Diverifikasi</a>
                                                            @elseif($cuti['pivot']->status == "4")
                                                            <a class="text-danger">Ajuan Tidak Dilanjutkan</a>
                                                            @elseif($cuti['pivot']->status == "5")
                                                            <a class="text-success">Ajuan Diterima</a>
                                                            @elseif($cuti['pivot']->status == "6")
                                                            <a class="text-danger">Ajuan Tidak Diterima</a>
                                                        @endif
                                                    </p>
                                                </div>
                                                @if ($cuti['pivot']->status == "2")
                                                    <a onclick="verifikasi({{ $cuti['pivot']->id }})" class="btn btn-primary btn-sm text-white" style="cursor: pointer;"><i class="fa fa-check-circle"></i>&nbsp; Verifikasi</a>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                    @else
                                    <div class="alert alert-danger">
                                        <strong>Perhatian : </strong> {{ $dosen->nm_dosen }} belum pernah melakukan pengajuan cuti !!
                                    </div> 
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            @include('operator/pemohons.dosen.verifikasi')
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        function verifikasi(id){
            $('#modalverifikasi').modal('show');
            $('#status').find('option[selected="selected"]').each(function(){
                $(this).prop('selected', true);
            });
        }

        @error('status')
            $('#modalverifikasi').modal('show')
        @enderror
    </script>
@endpush