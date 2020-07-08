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
@section('sidebar-menu')
    @include('pegawai/sidebar')
@endsection
@section('content')
    <section class="panel" style="margin-bottom:20px;">
        <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
            <i class="fa fa-home"></i>&nbsp;Remunerasi Tenaga Kependidikan Universitas Bengkulu
        </header>
        <div class="panel-body" style="border-top: 1px solid #eee; padding:15px; background:white;">
            <div class="row" style="margin-right:-15px; margin-left:-15px;">
                <div class="col-md-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>Berhasil :</strong>{{ $message }}
                        </div>
                        @elseif ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>Gagal :</strong>{{ $message }}
                            </div>
                            @else
                            <div class="alert alert-primary alert-block" id="keterangan">
                                <strong><i class="fa fa-info-circle"></i>&nbsp;Perhatian: </strong> Data yang ditampilkan dibawah ini adalah data permohonan pengajuan cuti ang ditolak operator fakultas dan tidak dilanjutkan ke admin universitas !!
                            </div>
                    @endif
                </div>

                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>Nip</th>
                                <th>Jenis Pengajuan Cuti</th>
                                <th>Tanggal Awal</th>
                                <th>Tanggal Akhir</th>
                                <th>Keterangan</th>
                                <th>Status Permohonan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($pengajuans as $pengajuan)
                                <tr>
                                    <td> {{ $no++ }} </td>
                                    <td> {{ $data_dosen['nm_dosen'] }} </td>
                                    <td> {{ $data_dosen['nip'] }} </td>
                                    <td> {{ $pengajuan->jenis_cuti }} </td>
                                    <td> {{ Carbon\Carbon::parse($pengajuan['pivot']->tanggal_awal)->format('d F, Y') }} </td>
                                    <td> {{ Carbon\Carbon::parse($pengajuan['pivot']->tanggal_akhir)->format('d F, Y') }} </td>
                                    <td> {{ $pengajuan['pivot']->keterangan }} </td>
                                    <td>
                                        @if ($pengajuan['pivot']->status == "4")
                                            <span class="badge badge-danger"><i class="fa fa-close"></i>&nbsp; Permohohan ditolak operator fakultas</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive : true,
            });
        } );
    </script>
@endpush
