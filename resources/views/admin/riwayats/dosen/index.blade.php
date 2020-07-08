@extends('layouts.app')
@section('title', 'Manajemen Jabatan')
@section('login_as', 'Pegawai')
@section('user-login')
    {{ Auth::user()->nm_user }}
@endsection
@section('user-login2')
    {{ Auth::user()->nm_user }}
@endsection
@section('sidebar-menu')
    @include('admin/sidebar')
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
                            <strong>Berhasil :</strong> {{ $message }}
                        </div>
                        @elseif ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>Gagal :</strong> {{ $message }}
                            </div>
                            @else
                            @if (count($riwayats)>0)
                                <div class="alert alert-primary alert-block" id="keterangan">
                                    <strong><i class="fa fa-info-circle"></i>&nbsp;Perhatian: </strong> Data yang ditampilkan dibawah ini adalah data pengajuan pegawai yang sedang menunggu/dalam proses verifikasi oleh administrator universitas !!
                                </div>
                                @else
                                <div class="alert alert-danger alert-block" id="keterangan">
                                    <strong><i class="fa fa-info-circle"></i>&nbsp;Perhatian: </strong> Anda tidak memiliki permohonan pengajuan cuti yang sedang dalam proses menunggu/verifikasi fakultas !!
                                </div>
                            @endif
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
                                <th>File Permohonan</th>
                                <th>Status Permohonan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($riwayats as $riwayat)
                                <tr>
                                    <td> {{ $no++ }} </td>
                                    <td> {{ $riwayat->gelar_depan }}{{ $riwayat->nm_dosen }} {{ $riwayat->gelar_belakang }} </td>
                                    <td> {{ $riwayat->nip }} </td>
                                    <td> {{ $riwayat->jenis_cuti }} </td>
                                    <td> {{ Carbon\Carbon::parse($riwayat->tanggal_awal)->format('d F, Y') }} </td>
                                    <td> {{ Carbon\Carbon::parse($riwayat->tanggal_akhir)->format('d F, Y') }} </td>
                                    <td> {{ $riwayat->keterangan }} </td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/'.$riwayat->file_ajuan) }}" download="{{ $riwayat->file_ajuan }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i></a>
                                    </td>
                                    <td>
                                        @if ($riwayat->status == "5")
                                            <span class="badge badge-success"><i class="fa fa-check-circle"></i>&nbsp; Disetujui Universitas</span>
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
