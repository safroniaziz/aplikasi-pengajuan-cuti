<div id="form-pegawai">
    <hr style="width: 50%;">
    <input type="hidden" name="id" id="id">
    <div class="form-group col-md-6">
        <label for="">Nama Pegawai</label>
        <input type="text" name="nm_pegawai" value="{{ old('nm_pegawai') }}" id="nm_pegawai" class="form-control @error('nm_pegawai') is-invalid @enderror">
        @error('nm_pegawai')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">Nip Pegawai</label>
        <input type="number" name="nip" value="{{ old('nip') }}" id="nip" class="form-control @error('nip') is-invalid @enderror">
        @error('nip')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">Jenis Kelamin</label>
        <select name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
            <option selected="selected" disabled>-- pilih jenis kelamin --</option>
            <option value="1" {{ old('jenis_kelamin') == "1" ? 'selected' : '' }}>Laki-Laki</option>
            <option value="0" {{ old('jenis_kelamin') == "0" ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">Jabatan <a class="text-danger">catatan : sesuai dengan jabatan di absensi.unib.ac.id</a></label>
        <input type="text" name="jabatan" value="{{ old('jabatan') }}" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
        @error('jabatan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">Level Departemen <a class="text-danger">contoh : LPTIK</a></label>
        <input type="text" name="level_departemen" value="{{ old('level_departemen') }}" id="level_departemen" class="form-control @error('level_departemen') is-invalid @enderror">
        @error('level_departemen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">Cabang <a class="text-danger"></a></label>
        <input type="text" name="cabang" value="{{ old('cabang') }}" id="cabang" class="form-control @error('cabang') is-invalid @enderror">
        @error('cabang')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="">Jenis Kepegawaian</label>
        <select name="jenis_kepegawaian" value="{{ old('jenis_kepegawaian') }}" id="jenis_kepegawaian" class="form-control @error('jenis_kepegawaian') is-invalid @enderror">
            <option selected="selected" disabled>-- pilih jenis kepegawaian --</option>
            <option value="dosen" {{ old('jenis_kepegawaian') == "dosen" ? 'selected' : '' }}> Dosen</option>
            <option value="tendik_pns {{ old('jenis_kepegawaian') == "tendik_pns" ? 'selected' : '' }}">Tendik PNS</option>
            <option value="tendik_non_pns {{ old('jenis_kepegawaian') == "tendik_non_pns" ? 'selected' : '' }}">Tendik Non PNS</option>
        </select>
        @error('jenis_kepegawaian')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-md-12 text-center">
        <hr style="width: 50%">
        <a href="{{ route('admin.pegawais') }}" class="btn btn-info btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-close"></i>&nbsp; Reset Data</button>
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>&nbsp; Simpan Data</button>
    </div>
</div>