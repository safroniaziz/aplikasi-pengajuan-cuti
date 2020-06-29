<!-- Modal Hapus-->
<div class="modal fade modal" id="modalverifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action=" {{ route('admin.pengajuans.verifikasi',[$pegawai->id]) }} " method="POST">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <div class="modal-header">
                    <p style="font-size:15px; font-weight:bold;" class="modal-title"><i class="fa fa-check-circle"></i>&nbsp;Form Verifikasi</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">Silahkan verifikasi ajuan cuti pegawai berikut, harap berhati-hati, anda tidak dapat mengubah status jika sudah diverifikasi !!</div>
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="{{ $cuti->id ?? '' }}">
                                <label for="status">Status Verifikasi</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror ">
                                    <option value="" disabled selected="selected">-- pilih status verifikasi --</option>
                                    <option value="4">Setujui</option>
                                    <option value="5">Tidak Setujui</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batalkan</button>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i>&nbsp; Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
</div>