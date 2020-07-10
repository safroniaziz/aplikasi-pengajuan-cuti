@extends('layouts.app')
@section('title', 'Dashboard')
@section('login_as', 'Operator Fakultas')
@section('user-login')
    @if (Auth::guard('operator')->check())
        {{ Auth::guard('operator')->user()->nm_operator }}
    @endif
@endsection
@section('user-login2')
    @if (Auth::guard('operator')->check())
        {{ Auth::guard('operator')->user()->nm_operator }}
    @endif
@endsection
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@push('styles')
    <!-- Styles -->
    <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
    </style>
@endpush
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
                                    <h3>{{ $today }} <a class="text-white" style="font-size: 20px;">Permohonan</a></h3>

                                    <p>Permohonan Baru (Hari Ini)</p>
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

                                    <p>Permohonan Menunggu Verifikasi</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 col-md-12" style="padding-bottom:10px !important;">
                                <!-- small box -->
                                <div class="small-box bg-red" style="margin-bottom:0px;">
                                    <div class="inner">
                                    <h3>{{ $total }} <a class="text-white" style="font-size: 20px;">Permohonan</a></h3>

                                    <p>Total Permohonan</p>
                                    </div>
                                    <div class="icon">
                                    <i class="fa fa-list-alt"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 col-md-12" style="padding-bottom:10px !important;">
                                <!-- small box -->
                                <div class="small-box bg-yellow" style="margin-bottom:0px;">
                                    <div class="inner">
                                    <h3>{{ $jumlah_dosen }} <a class="text-white" style="font-size: 20px;">Dosen</a></h3>

                                    <p>Jumlah Dosen Mengajukan Permohonan</p>
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
                                    <strong>Selamat Datang <b class="text-uppercase text-primary">{{ Auth::guard('operator')->user()->nm_operator }}</b> di halaman <b class="text-uppercase">operator fakultas</b> aplikasi pengajuan surat cuti pegawai <a href="https://www.unib.ac.id" target="_blank">Universitas Bengkulu</a>. Silahkan ajukan keperluan cuti anda, untuk mempermudah proses pengajuan anda silahkan bacalah buku panduan jika disediakan !!</strong>
                                    <p style="margin-bottom:0px;">Jangan lupa keluar setelah menggunkan aplikasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-9" style="margin-bottom:5px;">
                <section class="panel">
                    <header class="panel-heading" style="color: #ffffff;background-color: #074071;border-color: #fff000;border-image: none;border-style: solid solid none;border-width: 4px 0px 0;border-radius: 0;font-size: 14px;font-weight: 700;padding: 15px;">
                        <i class="fa fa-user"></i>&nbsp;Informasi Operator Universitas Bengkulu
                        <span class="tools pull-right" style="margin-top:-5px;">
                            <a class="fa fa-chevron-down" href="javascript:;" style="float: left;margin-left: 3px;padding: 10px;text-decoration: none;"></a>
                            <a class="fa fa-times" href="javascript:;" style="float: left;margin-left: 3px;padding: 10px;text-decoration: none;"></a>
                        </span>
                    </header>
                    <div class="panel-body" style="border-top: 1px solid #eee; padding:15px; background:white;">
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom:5px;">
                                <div class="alert alert-primary" role="alert">
                                    <strong><i class="fa fa-info-circle"></i>&nbsp;Perhatian</strong> Data anda didapat dari  <b>Absensi UNIB(<a href="http://absensi.unib.ac.id" target="_blank">absensi.unib.ac.id</a>)</b>, jika terdapat kesalahan data, harap menghubungi bagian kepegawaian <b>Universitas Bengkulu</b> !!
                                </div>
                                @if ($error = Session::get('error'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button> 
                                        <strong>Gagal :</strong>{{ $error }}
                                    </div>
                                    @elseif($success = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button> 
                                        <strong>Berhasil :</strong>{{ $success }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12" id="table-data">
                                <table class="table">
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>:</td>
                                        <td>{{ $operator->nm_operator }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Induk Pegawai</th>
                                        <td>:</td>
                                        <td>{{ $operator->nip }}</td>
                                    </tr>
                                    <tr>
                                        <th>Departemen</th>
                                        <td>:</td>
                                        <td>{{ $operator->dept_nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jeis Kepegawaian</th>
                                        <td>:</td>
                                        <td>
                                            @if ($operator->jenis_kepegawaian == "tendik")
                                                Tendik
                                                @else
                                                Tendik PNS
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>:</td>
                                        <td>
                                            @if ($operator->jenis_kelamin == "1")
                                                <label class="badge badge-primary"><i class="fa fa-male"></i>&nbsp; Laki-laki</label>
                                                @else
                                                <label class="badge badge-success"><i class="fa fa-female"></i>&nbsp; Perempuan</label>
                                            @endif
                                        </td>
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

        function editData(){
            $('#form-edit').show(300);
            $('#table-data').hide(300);
            $('#button-data').hide(300);
        }

        function batalkanEdit(){
            $('#form-edit').hide(300);
            $('#table-data').show(300);
            $('#button-data').show(300);
        }
    </script>
@endpush