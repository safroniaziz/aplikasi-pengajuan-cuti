<div id="form-pegawai">
    <hr style="width: 50%;">
    <input type="hidden" name="id" id="id">
    <div class="form-group col-md-6">
        <label for="">Nama Lengkap</label>
        <input type="text" name="nm_dosen" value="{{ old('nm_dosen') ?? $data_dosen['gelar_depan'].$data_dosen['nm_dosen'].', '.$data_dosen['gelar_belakang']}}" class="form-control" readonly>
        @error('nm_dosen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">File Permohonan <a class="text-danger">PDF, JPG, PNG Maksimal : 1Mb</a></label>
        <input type="file" name="file_permohonan" class="form-control-file @error('file_permohonan') is-invalid @enderror">
        @error('file_permohonan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    
    <div class="col-md-12 text-center">
        <hr style="width: 50%">
        <a href="{{ route('pegawai.pengajuans.new',[$data_dosen['slug']]) }}" class="btn btn-info btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-close"></i>&nbsp; Reset Data</button>
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i>&nbsp;{{ $title ?? 'Kirimkan File'}}</button>
    </div>
</div>