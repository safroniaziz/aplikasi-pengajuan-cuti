<li>
    <a href=" {{ route('operator.dashboard') }} "><i class="fa fa-home"></i>Dashboard</a>
</li>

<li class="{{ Request::route()->getName() == "operator.pegawais.show" ? 'current-page' : '' }}"">
    <a href=" {{ route('operator.pegawais') }} "><i class="fa fa-users"></i>Daftar Pegawai Terdaftar</a>
</li>
