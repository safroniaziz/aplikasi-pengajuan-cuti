<div class="modal fade" id="modalkonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">Form Konfirmasi</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah anda yakin ? 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batalkan</button>
          <form action="{{ route('admin.pegawais.delete',[$pegawai->slug]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-primary text-white"><i class="fa fa-check-circle"></i>&nbsp;Ya, saya yakin !</button>
        </form>
        </div>
      </div>
    </div>
</div>