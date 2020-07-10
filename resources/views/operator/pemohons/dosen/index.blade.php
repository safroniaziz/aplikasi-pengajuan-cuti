@extends('layouts.app')
@section('title', 'Manajemen Jabatan')
@section('login_as', 'Operator Fakultas')
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
    @include('operator/sidebar')
@endsection
@section('content')
    <section class="panel" style="margin-bottom:20px;">
        <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
            <i class="fa fa-home"></i>&nbsp;Aplikasi Permohonan Surat Cuti Pegawai Universitas Bengkulu
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
                            <div class="alert alert-danger alert-block" id="keterangan">
                                <strong><i class="fa fa-info-circle"></i>&nbsp;Perhatian: </strong> Berikut semua pegawai universitas bengkulu yang didapatkan dari Sistem Informasi Absensi Universitas Bengkulu, maupun yang ditambahkan oleh admin fakultas dan universitas. <br> Silahkan tambahkan data manual jika diperlukan !!
                            </div>
                    @endif
                </div>
                
                <div class="col-md-12">
                    <a href="{{ route('admin.pegawais.add') }}" class="btn btn-primary btn-sm" id="button-tambah" style="color:white; cursor:pointer;"><i class="fa fa-briefcase"></i>&nbsp; Tambah Data Pegawai</a>
                </div>

                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>Nip</th>
                                <th>Jenis Kelamin</th>
                                <th>Nama Prodi</th>
                                <th>Nama Fakultas</th>
                                <th>Nama Departemen</th>
                                <th>Detail Pegawai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($pemohons as $pemohon)
                                <tr>
                                    <td> {{ $no++ }} </td>
                                    <td> {{ $pemohon->gelar_depan }}{{ $pemohon->nm_dosen }} {{ $pemohon->gelar_belakang }} </td>
                                    <td> {{ $pemohon->nip }} </td>
                                    <td> {{ $pemohon->jenis_kelamin = '1' ? 'Laki-Laki' : 'Perempuan' }} </td>
                                    <td> {{ $pemohon->prodi_nama }} </td>
                                    <td> {{ $pemohon->fakultas_nama }} </td>
                                    <td> {{ $pemohon->departemen_nama }} </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('operator.pemohons.dosen.show',[$pemohon->slug]) }}" class="btn btn-primary btn-sm pr-3 pl-3" style="color:white;cursor:pointer;"><i class="fa fa-info"></i></a>
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

        @if (count($errors) > 0)
            $('#modalverifikasi').modal('show');
        @endif

        @if (count($errors) > 0)
            $('#form-pegawai').show();
        @endif
    </script>
@endpush
