<!-- Modal Hapus-->
<div class="modal fade modal" id="modalverifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action=" {{ route('admin.pengajuans.verifikasi') }} " method="POST">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <div class="modal-header">
                    <p style="font-size:15px; font-weight:bold;" class="modal-title"><i class="fa fa-trash"></i>&nbsp;Form Konfirmasi Hapus Data</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">Silahkan verifikasi ajuan cuti pegawai berikut</div>
                            <input type="hidden" name="id" id="id_hapus">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batalkan</button>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i>&nbsp; Verifikasi</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>