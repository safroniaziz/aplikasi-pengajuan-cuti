<li>
    <a href=" {{ route('admin.dashboard') }} "><i class="fa fa-home"></i>Dashboard</a>
</li>

<li><a><i class="fa fa-check-circle"></i>Permohonan Dosen<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('admin.verifikasi.dosens.menunggu') }} ">Menunggu Verifikasi</a></li>
        <li><a href=" {{ route('admin.riwayat.dosens.disetujui') }} ">Permohonan Disetujui</a></li>
        <li><a href=" {{ route('admin.riwayat.dosens.ditolak') }} ">Permohonan Tidak Disetujui</a></li>
    </ul>
</li>

<li class="{{ Request::route()->getName() == "admin.pegawais.show" ? 'current-page' : '' }}">
    <a href=" {{ route('admin.pegawais') }} "><i class="fa fa-users"></i>Daftar Pegawai Terdaftar</a>
</li>

<li >
    <a href=" {{ route('admin.operators') }} "><i class="fa fa-user"></i>Akun Fakultas</a>
</li>