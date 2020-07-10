<li>
    <a href=" {{ route('pegawai.dashboard',[Session::get('slug')]) }} "><i class="fa fa-home"></i>Dashboard</a>
</li>

<li class="{{ Request::route()->getName() == "pegawai.pegawais.show" ? 'current-page' : '' }}">
    {{-- <a href=" {{ route('pegawai.pegawais') }} "><i class="fa fa-users"></i>Daftar Pegawai Terdaftar</a> --}}
</li>

<li><a><i class="fa fa-arrow-circle-o-right"></i>Permohonan Cuti<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('pegawai.pengajuans.new',[Session::get('slug')]) }} ">Permohonan Baru</a></li>
        <li><a href=" {{ route('pegawai.pengajuans.menunggu',[Session::get('slug')]) }} ">Menunggu Verifikasi Fakultas</a></li>
        {{-- <li><a href=" {{ route('pegawai.pengajuans.new.ditolak_fakultas',[Session::get('slug')]) }} ">Permohonan Tidak Dilanjutkan</a></li> --}}
    </ul>
</li>

<li><a><i class="fa fa-check-circle"></i>Verifikasi Fakultas<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('pegawai.pengajuans.new.disetujui_fakultas',[Session::get('slug')]) }} ">Permohonan Dilanjutkan</a></li>
        <li><a href=" {{ route('pegawai.pengajuans.new.ditolak_fakultas',[Session::get('slug')]) }} ">Permohonan Tidak Dilanjutkan</a></li>
    </ul>
</li>

<li><a><i class="fa fa-check"></i>Verifikasi Universitas<span class="fa fa-chevron-down" ></span></a>
    <ul class="nav child_menu">
        <li><a href=" {{ route('pegawai.pengajuans.new.disetujui_universitas',[Session::get('slug')]) }} ">Permohonan Disetujui</a></li>
        <li><a href=" {{ route('pegawai.pengajuans.new.ditolak_universitas',[Session::get('slug')]) }} ">Permohonan Tidak Disetujui</a></li>
    </ul>
</li>

<li>
    <a href=" {{ route('pegawai.all_permohonans',[Session::get('slug')]) }} "><i class="fa fa-list"></i>Semua Permohonan</a>
</li>

<li>
    <a href=" {{ route('pegawai.logout') }} "><i class="fa fa-power-off text-danger"></i>Logout</a>
</li>