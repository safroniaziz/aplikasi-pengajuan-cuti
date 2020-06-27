@extends('layouts.app')
@section('title', 'Manajemen Jabatan')
@section('login_as', 'Administrator')
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
                                <strong><i class="fa fa-info-circle"></i>&nbsp;Perhatian: </strong> Berikut semua Jabatan yang tersedia, data berikut didapatkan dari Sistem Informasi Kepegawaian (SIMPEG), silahkan tambahkan manual jika diperlukan !!
                            </div>
                    @endif
                </div>
                <div class="col-md-12">
                    <a onclick="tambahJabatan()" class="btn btn-primary btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-briefcase"></i>&nbsp; Tambah Jabatan</a>
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
                                <th>Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($ajuans as $ajuan)
                                <tr>
                                    <td> {{ $no++ }} </td>
                                    <td> {{ $ajuan->nm_pegawai }} </td>
                                    <td> {{ $ajuan->nip }} </td>
                                    <td> {{ $ajuan->jenis_kelamin = '1' ? 'Laki-Laki' : 'Perempuan' }} </td>
                                    <td> {{ $ajuan->jabatan }} </td>
                                    <td> {{ $ajuan->departemen }} </td>
                                    <td> {{ $ajuan->level_departemen }} </td>
                                    <td> {{ $ajuan->cabang }} </td>
                                    <td> {{ $ajuan->jenis_kepegawaian }} </td>
                                    <td style="text-align: center">
                                        <a onclick="verifikasi({{ $ajuan->id }})" class="btn btn-primary btn-sm" style="color:white;cursor:pointer;"><i class="fa fa-check-circle"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Modal Hapus-->
                <div class="modal fade modal-danger" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {{-- <form action=" {{ route('admin.jabatan.delete') }} " method="POST"> --}}
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <div class="modal-header">
                                    <p style="font-size:15px; font-weight:bold;" class="modal-title"><i class="fa fa-trash"></i>&nbsp;Form Konfirmasi Hapus Data</p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="id" id="id_hapus">
                                            Apakah anda yakin ingin menghapus data? klik hapus jika iya !!
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" style="border: 1px solid #fff;background: transparent;color: #fff;" class="btn btn-sm btn-outline pull-left" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batalkan</button>
                                    <button type="submit" style="border: 1px solid #fff;background: transparent;color: #fff;" class="btn btn-sm btn-outline"><i class="fa fa-check-circle"></i>&nbsp; Ya, Hapus</button>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>
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

        function tambahJabatan(){
            $('#form-jabatan').show(300);
        }
        
        function editJabatan(id){
            $.ajax({
                url: "{{ url('admin/manajemen_jabatan') }}"+'/'+ id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modalubah').modal('show');
                    $('#id_ubah').val(id);
                    $('#kelas_jabatan').val(data.kelas_jabatan);
                    $('#nm_jabatan').val(data.nm_jabatan);
                    $('#remunerasi').val(data.remunerasi);
                },
                error:function(){
                    alert("Nothing Data");
                }
            });
        }

        function hapusJabatan(id){
            $('#modalhapus').modal('show');
            $('#id_hapus').val(id);
        }

        @if (count($errors) > 0)
            $('#form-jabatan').show(300);
        @endif
    </script>
@endpush
