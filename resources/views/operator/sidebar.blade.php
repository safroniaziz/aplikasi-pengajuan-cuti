<li>
    <a href=" {{ route('operator.dashboard') }} "><i class="fa fa-home"></i>Dashboard</a>
</li>

<li><a><i class="fa fa-check-circle"></i>Verifikasi Permohonan<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('operator.verifikasi.dosens') }} ">Permohonan Dosen</a></li>
         {{-- <li><a href=" {{ route('admin.ditolak') }} ">Usulan Tidak Didanai</a></li>  --}}
    </ul>
</li>

<li><a><i class="fa fa-history"></i>Riwayat Verifikasi<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('operator.riwayat.dosens') }} ">Permohonan Dosen</a></li>
         {{-- <li><a href=" {{ route('admin.ditolak') }} ">Usulan Tidak Didanai</a></li>  --}}
    </ul>
</li>

<li><a><i class="fa fa-list"></i>Semua Permohonan<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('operator.permohonans.belum_diajukan') }} ">Belum Diajukan</a></li>
        <li><a href=" {{ route('operator.permohonans.menunggu_verifikasi') }} ">Menunggu Verifikasi</a></li>
        <li><a href=" {{ route('operator.permohonans.dilanjutkan') }} ">Dilanjutkan</a></li>
        <li><a href=" {{ route('operator.permohonans.tidak_dilanjutkan') }} ">Tidak Dilanjutkan</a></li>
        <li><a href=" {{ route('operator.permohonans.disetujui') }} ">Disetujui</a></li>
        <li><a href=" {{ route('operator.permohonans.tidak_disetujui') }} ">Tidak Disetujui</a></li>
    </ul>
</li>


<li><a><i class="fa fa-history"></i>Daftar Pemohon<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('operator.pemohons.dosen') }} ">Dosen</a></li>
    </ul>
</li>

<li>
    <a href=" {{ route('operator.logout') }} "><i class="fa fa-power-off text-danger"></i> Logout</a>
</li>
