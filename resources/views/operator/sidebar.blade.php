<li>
    <a href=" {{ route('operator.dashboard') }} "><i class="fa fa-home"></i>Dashboard</a>
</li>

<li><a><i class="fa fa-check-circle"></i>Verifikasi Permohonan<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('operator.verifikasi.dosens') }} ">Permohonan Dosen</a></li>
         {{-- <li><a href=" {{ route('admin.ditolak') }} ">Usulan Tidak Didanai</a></li>  --}}
    </ul>
</li>

<li><a><i class="fa fa-history"></i>Riwayat Permohonan<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('operator.riwayat.dosens') }} ">Permohonan Dosen</a></li>
         {{-- <li><a href=" {{ route('admin.ditolak') }} ">Usulan Tidak Didanai</a></li>  --}}
    </ul>
</li>

<li class="{{ Request::route()->getName() == "operator.pegawais.show" ? 'current-page' : '' }}"">
    <a href=" {{ route('operator.pegawais') }} "><i class="fa fa-users"></i>Daftar Pegawai Terdaftar</a>
</li>
