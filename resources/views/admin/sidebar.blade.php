<li>
    <a href=" {{ route('admin.dashboard') }} "><i class="fa fa-home"></i>Dashboard</a>
</li>

<li class="{{ Request::route()->getName() == "admin.pegawais.show" ? 'current-page' : '' }}">
    <a href=" {{ route('admin.pegawais') }} "><i class="fa fa-users"></i>Daftar Pegawai Terdaftar</a>
</li>

<li >
    <a href=" {{ route('admin.operators') }} "><i class="fa fa-user"></i>Akun Fakultas</a>
</li>