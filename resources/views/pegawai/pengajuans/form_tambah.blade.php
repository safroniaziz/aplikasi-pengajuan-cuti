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
        <label for="">Jenis Pengajuan Cuti</label>
        <select name="cuti_id" id="cuti_id" class="form-control @error('cuti_id') is-invalid @enderror">
            <option selected disabled>-- pilih jenis pengajuan cuti --</option>
            @foreach ($cutis as $cuti)
                <option value="{{ $cuti->id }}">{{ $cuti->jenis_cuti }}</option>
            @endforeach
        </select>
        @error('cuti_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-12">
        <label for="">Keterangan / Alasan</label>
        <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" cols="30" rows="7"></textarea>
        @error('keterangan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" value="{{ old('tanggal_awal')  }}" class="form-control @error('keterangan') is-invalid @enderror">
        @error('tanggal_awal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" value="{{ old('tanggal_akhir')  }}" class="form-control @error('keterangan') is-invalid @enderror">
        @error('tanggal_akhir')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-md-12 text-center">
        <hr style="width: 50%">
        <a href="{{ route('pegawai.pengajuans.new',[$data_dosen['slug']]) }}" class="btn btn-info btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-close"></i>&nbsp; Reset Data</button>
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-circle"></i>&nbsp;{{ $title ?? 'Simpan Perubahan'}}</button>
    </div>
</div>