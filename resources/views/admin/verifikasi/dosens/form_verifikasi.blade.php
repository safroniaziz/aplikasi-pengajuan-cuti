<div id="form-pegawai">
    <hr style="width: 50%;">
    <input type="hidden" name="id" id="id">
    <div class="form-group col-md-6">
        <label for="">Nama Lengkap</label>
        <input type="text" name="nm_dosen" value="{{ old('nm_dosen') ?? $data_dosen['gelar_depan'].$data_dosen['nm_dosen'].', '.$data_dosen['gelar_belakang']}}" class="form-control" readonly>
        @error('nm_pegawai')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">Status Verifikasi</label>
        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
            <option disabled selected>-- pilih status verifikasi --</option>
            <option value="5">Setujui</option>
            <option value="6">Tidak Setujui</option>
        </select>
        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>


    <div class="col-md-12 text-center">
        <hr style="width: 50%">
        <a href="{{ route('admin.verifikasi.dosens',[$data_dosen['slug']]) }}" class="btn btn-info btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-close"></i>&nbsp; Reset Data</button>
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i>&nbsp;{{ $title ?? 'Simpan Perubahan'}}</button>
    </div>
</div>