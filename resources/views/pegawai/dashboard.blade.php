@extends('layouts.app')
@section('title', 'Dashboard')
@section('login_as', 'Pegawai')
@section('user-login')
    {{ $data_pegawai['gelar_depan'] .$data_pegawai['nm_dosen'] .' '.$data_pegawai['gelar_belakang'] }}
@endsection
@section('user-login2')
    {{ $data_pegawai['gelar_depan'] .$data_pegawai['nm_dosen'] .' '.$data_pegawai['gelar_belakang'] }}
@endsection
@section('sidebar-menu')
    @include('pegawai/sidebar')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
                <section class="panel">
                    <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
                        <i class="fa fa-info-circle"></i>&nbsp;Informasi Penilaian
                        <span class="tools pull-right" style="margin-top:-5px;">
                        </span>
                    </header>
                    <div class="panel-body" style="border-top: 1px solid #eee; padding:15px; background:white;">
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-md-12" style="padding-bottom:10px !important;">
                                <!-- small box -->
                                <div class="small-box bg-aqua" style="margin-bottom:0px;">
                                    <div class="inner">
                                    <h3>{{ $jumlah }} <a class="text-white" style="font-size: 20px;">Permohonan</a></h3>

                                    <p>Jumlah permohonan pengajuan Cuti</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-list"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 col-md-12" style="padding-bottom:10px !important;">
                                <!-- small box -->
                                <div class="small-box bg-aqua" style="margin-bottom:0px;">
                                    <div class="inner">
                                    <h3>{{ $sisa }} <a class="text-white" style="font-size: 20px;">Permohonan</a></h3>

                                    <p>Sisa Permohonan Cuti</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-list"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 col-md-12" style="padding-bottom:10px !important;">
                                <!-- small box -->
                                <div class="small-box bg-green" style="margin-bottom:0px;">
                                    <div class="inner">
                                    <h3>{{ $menunggu }} <a class="text-white" style="font-size: 20px;">Permohonan</a></h3>

                                    <p>permohonan pengajuan Cuti Menunggu Verifikasi</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 col-md-12" style="padding-bottom:10px !important;">
                                <!-- small box -->
                                <div class="small-box bg-success text-white" style="margin-bottom:0px;">
                                    <div class="inner">
                                    <h3>{{ $diterima }} <a class="text-white" style="font-size: 20px;">Permohonan</a></h3>

                                    <p>permohonan pengajuan Cuti Diterima</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-list-alt"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 col-md-12" style="padding-bottom:10px !important;">
                                <!-- small box -->
                                <div class="small-box bg-danger text-white" style="margin-bottom:0px;">
                                    <div class="inner">
                                    <h3>{{ $ditolak }} <a class="text-white" style="font-size: 20px;">Permohonan</a></h3>

                                    <p>permohonan pengajuan Cuti Tidak Diterima</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-wpforms"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 col-md-12" style="padding-bottom:10px !important;">
                                <!-- small box -->
                                <div class="small-box bg-info text-white" style="margin-bottom:0px;">
                                    <div class="inner">
                                    <h3>{{ $diteruskan }} <a class="text-white" style="font-size: 20px;">Permohonan</a></h3>

                                    <p>permohonan pengajuan Diteruskan ke Admin Universitas</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-wpforms"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 col-md-12" style="padding-bottom:10px !important;">
                                <!-- small box -->
                                <div class="small-box bg-primary text-white" style="margin-bottom:0px;">
                                    <div class="inner">
                                    <h3>{{ $tidak_diteruskan }} <a class="text-white" style="font-size: 20px;">Permohonan</a></h3>

                                    <p>permohonan pengajuan Ditolak Operator Fakultas</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-wpforms"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-9">
                <section class="panel">
                    <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
                        <i class="fa fa-home"></i>&nbsp;Dashboard
                        <span class="tools pull-right" style="margin-top:-5px;">
                            <a class="fa fa-chevron-down" href="javascript:;" style="float: left;margin-left: 3px;padding: 10px;text-decoration: none;"></a>
                            <a class="fa fa-times" href="javascript:;" style="float: left;margin-left: 3px;padding: 10px;text-decoration: none;"></a>
                        </span>
                    </header>
                    <div class="panel-body" style="border-top: 1px solid #eee; padding:15px; background:white;">
                        <div class="row">
                            <div class="col-md-12">
                                <div  style="text-align:center;">
                                    <strong>Selamat Datang <b class="text-uppercase text-primary">{{ $data_pegawai['gelar_depan'] .$data_pegawai['nm_dosen'] .' '.$data_pegawai['gelar_belakang'] }}</b> di aplikasi permohonan pengajuan surat cuti pegawai <a href="https://www.unib.ac.id" target="_blank">Universitas Bengkulu</a>. Silahkan ajukan keperluan cuti anda, untuk mempermudah proses pengajuan anda silahkan bacalah buku panduan jika disediakan !!</strong>
                                    <p class="text-danger mb-0">Penting, Jangan lupa keluar setelah menggunkan aplikasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-9" style="margin-bottom:5px;">
                <section class="panel">
                    <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
                        <i class="fa fa-user"></i>&nbsp;Informasi Pegawai Universitas Bengkulu
                        <span class="tools pull-right" style="margin-top:-5px;">
                            <a class="fa fa-chevron-down" href="javascript:;" style="float: left;margin-left: 3px;padding: 10px;text-decoration: none;"></a>
                            <a class="fa fa-times" href="javascript:;" style="float: left;margin-left: 3px;padding: 10px;text-decoration: none;"></a>
                        </span>
                    </header>
                    <div class="panel-body" style="border-top: 1px solid #eee; padding:15px; background:white;">
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom:5px;">
                                <div class="alert alert-primary" role="alert">
                                    <strong><i class="fa fa-info-circle"></i>&nbsp;Perhatian</strong> Data anda didapat dari  <b>Portal Akademik(PAK)</b>, jika terdapat kesalahan data, harap menghubungi admin <b>Portal Akademik(PAK)</b> !!
                                </div>
                            </div>
                            <div class="col-md-12" id="table-data">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>:</td>
                                        <td>{{ $data_pegawai['gelar_depan'].$data_pegawai['nm_dosen'].', '.$data_pegawai['gelar_belakang'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Induk Pegawai</th>
                                        <td>:</td>
                                        <td>{{ $data_pegawai['nip'] }}</td>
                                    </tr>
                                  
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>:</td>
                                        <td>
                                            @if (empty($data_pegawai['jenis_kelamin']))
                                                <a class="text-danger">Data Jenis Kelamin di Sitem Informasi Kepegawaian(SIMPEG) anda tidak lengkap</a>
                                                @elseif($data_pegawai['jenis_kelamin'] == "L")
                                                <label class="badge badge-primary"><i class="fa fa-male"></i>&nbsp; Laki-Laki</label>
                                                @else
                                                <label class="badge badge-success"><i class="fa fa-female"></i>&nbsp; Perempuan</label>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Fakultas</th>
                                        <td>:</td>
                                        <td>{{ $data_pegawai['fakultas_nama'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>:</td>
                                        <td>{{ $data_pegawai['prodi_nama'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function ubahPassword(){
            $('#modalUbahPassword').modal('show');
        }
    </script>
@endpush