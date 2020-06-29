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
                                <th>Jabatan</th>
                                <th>Departemen</th>
                                <th>Level Departemen</th>
                                <th>Cabang</th>
                                <th>Jenis Kepegawaian</th>
                                <th>Detail Pegawai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($pegawais as $pegawai)
                                <tr>
                                    <td> {{ $no++ }} </td>
                                    <td> {{ $pegawai->nm_pegawai }} </td>
                                    <td> {{ $pegawai->nip }} </td>
                                    <td> {{ $pegawai->jenis_kelamin = '1' ? 'Laki-Laki' : 'Perempuan' }} </td>
                                    <td> {{ $pegawai->jabatan }} </td>
                                    <td> {{ $pegawai->departemen }} </td>
                                    <td> {{ $pegawai->level_departemen }} </td>
                                    <td> {{ $pegawai->cabang }} </td>
                                    <td> {{ $pegawai->jenis_kepegawaian }} </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('admin.pegawais.show',[$pegawai->slug]) }}" class="btn btn-primary btn-sm pr-3 pl-3" style="color:white;cursor:pointer;"><i class="fa fa-info"></i></a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-info text-white" style="cursor: pointer;"> <i class="fa fa-edit"></i>&nbsp;</a>
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

        // function tambah(){
        //     $('#form-pegawai').show(300);
        //     $('#id').val("");
        //     $('#nm_pegawai').val("");
        //     $('#nip').val("");
        //     $('#jenis_kelamin').val("");
        //     $('#jabatan').val("");
        //     $('#level_departemen').val("");
        //     $('#cabang').val("");
        //     $('#jenis_kepegawaian').val("");
        //     (['#jenis_kelamin','jenis_kepegawaian']).find('option[selected="selected"]').each(function(){
        //         $(this).prop('selected', true);
        //     });
        // }

        // function batalkan(){
        //     $('#form-pegawai').hide(300);
        // }
        
        // function verifikasi(id){
        //     $('#modalverifikasi').modal('show');
        //     $('#id_hapus').val(id);
        // }

        // function edit(id){
        //     $.ajax({
        //         url: "{{ url('admin/pegawais') }}"+'/'+ id + "/edit",
        //         type: "GET",
        //         dataType: "JSON",
        //         success: function(data){
        //             $('#form-pegawai').show(300);
        //             $('#button-tambah').hide();
        //             $('#id').val(data.id);
        //             $('#nm_pegawai').val(data.nm_pegawai);
        //             $('#nip').val(data.nip);
        //             $('#jenis_kelamin').val(data.jenis_kelamin);
        //             $('#jabatan').val(data.jabatan);
        //             $('#level_departemen').val(data.level_departemen);
        //             $('#cabang').val(data.cabang);
        //             $('#jenis_kepegawaian').val(data.jenis_kepegawaian);
        //         },
        //         error:function(){
        //             alert("Nothing Data");
        //         }
        //     });
        // }

        @if (count($errors) > 0)
            $('#modalverifikasi').modal('show');
        @endif

        @if (count($errors) > 0)
            $('#form-pegawai').show();
        @endif
    </script>
@endpush
