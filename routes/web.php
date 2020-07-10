<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('pegawai.login.form');
});

/*
    Kondisi ketika langsung mengakses route operator
*/
Route::get('/operator', function () {
    return redirect()->route('operator.dashboard');
});

/*
    Kondisi ketika langsung mengakses route admin
*/
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

/*
    route auth pegawai
*/
Route::group(['prefix'  => '/'],function(){
    Route::get('/login','AuthPegawaiController@showLoginForm')->name('pegawai.login.form');
    Route::post('/login','AuthPegawaiController@pandaLogin')->name('pegawai.login.submit');
    Route::get('/pegawai_logout','AuthPegawaiController@pandaLogout')->name('pegawai.logout');
});

Route::group(['prefix'  =>  'pegawai'], function(){
    /*
        Route untuk dashboard pegawai
    */
    Route::get('/{dosen:slug}/dashboard','PegawaiDashboardController@index')->name('pegawai.dashboard');
    
    /*
        Route untuk manajemen pengajuans pegawai
    */
    Route::get('/{dosen:slug}/permohonans','PengajuanCutiController@index')->name('pegawai.pengajuans.new');
    Route::get('/{dosen:slug}/permohonans/tambah_pengajuan','PengajuanCutiController@add')->name('pegawai.pengajuans.add');
    Route::get('/{dosen:slug}/permohonans/menunggu','PengajuanCutiController@menunggu')->name('pegawai.pengajuans.menunggu');
    Route::post('/{dosen:slug}/permohonans/post','PengajuanCutiController@post')->name('pegawai.pengajuans.new.post');
    Route::get('/{dosen:slug}/permohonans/{pivot_id}/edit','PengajuanCutiController@edit')->name('pegawai.pengajuans.new.edit');
    Route::patch('/{dosen:slug}/permohonans/{pivot_id}/update','PengajuanCutiController@update')->name('pegawai.pengajuans.new.update');
    Route::get('/{dosen:slug}/permohonans/{pivot_id}/send','PengajuanCutiController@send')->name('pegawai.pengajuan.send');
    Route::patch('/{dosen:slug}/pengajuan/{pivot_id}/send_submit','PengajuanCutiController@sendSubmit')->name('pegawai.pengajuans.new.send_submit');

    /*
        Route untuk manajemen pengajuans status hasil verifikasi fakultas
    */
    Route::get('/{dosen:slug}/permohonans/disetujui_fakultas','PengajuanVerifikasiFakultasController@disetujuiFakultas')->name('pegawai.pengajuans.new.disetujui_fakultas');
    Route::get('/{dosen:slug}/permohonans/ditolak_fakultas','PengajuanVerifikasiFakultasController@ditolakFakultas')->name('pegawai.pengajuans.new.ditolak_fakultas');

    /*
        Route untuk manajemen pengajuans status hasil verifikasi administrator universitas
    */
    Route::get('/{dosen:slug}/permohonans/disetujui_universitas','PengajuanVerifikasiUniversitasController@disetujuiUniversitas')->name('pegawai.pengajuans.new.disetujui_universitas');
    Route::get('/{dosen:slug}/permohonans/ditolak_universitas','PengajuanVerifikasiUniversitasController@ditolakUniversitas')->name('pegawai.pengajuans.new.ditolak_universitas');

    /*
        Route untuk menampilkan semua permohonan pegawai
    */
    Route::get('/{dosen:slug}/semua_permohonan','PengajuanCutiController@semuaPermohonan')->name('pegawai.all_permohonans');
});


Route::group(['prefix'  =>  'admin'], function(){
    Auth::routes(['register'    =>  false]);
    Route::get('/dashboard','AdminDashboardController@index')->name('admin.dashboard');

    /*
        Route untuk verifikasi permohonan oleh admin universitas
    */
    Route::get('/verifikasi','AdminPermohonanController@verifikasiDosen')->name('admin.verifikasi.dosens.menunggu');
    Route::get('/verifikasi/{dosen:slug}/{cuti_dosen}','AdminPermohonanController@verifikasiDosenDetail')->name('admin.verifikasi.dosens.detail');
    Route::patch('/verifikasi/{dosen:slug}/{cuti_dosen}','AdminPermohonanController@verifikasiDosenUpdate')->name('admin.verifikasi.dosens.update');

    /*
        Route untuk riwayat verifikasi dari admin universitas
    */
    Route::get('/riwayat/permohonan_disetujui','AdminPermohonanController@riwayatDosenDisetujui')->name('admin.riwayat.dosens.disetujui');
    Route::get('/riwayat/permohonan_tidak_disetujui','AdminPermohonanController@riwayatDosenTidakDisetujui')->name('admin.riwayat.dosens.ditolak');

     /*
        Route untuk verifikasi permohonan oleh operator fakultas
    */
    Route::get('/verifikasi','AdminVerifikasiController@verifikasiDosen')->name('admin.verifikasi.dosens');
    Route::get('/verifikasi/{dosen:slug}/{cuti_dosen}','AdminVerifikasiController@verifikasiDosenDetail')->name('admin.verifikasi.dosens.detail');
    Route::patch('/verifikasi/{dosen:slug}/{cuti_dosen}','AdminVerifikasiController@verifikasiDosenUpdate')->name('admin.verifikasi.dosens.update');

    /*
        Route untuk riwayat verifikasi dari fakultas
    */
    Route::get('/riwayat','OperatorRiwayatController@riwayatDosenDisetujui')->name('operator.riwayat.dosens');

    /*
        Route untuk melihat semua permohonan berdasarkan status
    */
    Route::get('/permohonans/belum_diajukan','OperatorPermohonanController@belumDIajukan')->name('operator.permohonans.belum_diajukan');
    Route::get('/permohonans/menunggu_verifikasi','OperatorPermohonanController@menungguVerifikasi')->name('operator.permohonans.menunggu_verifikasi');
    Route::get('/permohonans/dilanjutkan','OperatorPermohonanController@dilanjutkan')->name('operator.permohonans.dilanjutkan');
    Route::get('/permohonans/tidak_dilanjutkan','OperatorPermohonanController@tidakDilanjutkan')->name('operator.permohonans.tidak_dilanjutkan');
    Route::get('/permohonans/disetujui','OperatorPermohonanController@disetujui')->name('operator.permohonans.disetujui');
    Route::get('/permohonans/tidak_disetujui','OperatorPermohonanController@tidakDisetujui')->name('operator.permohonans.tidak_disetujui');

    /*
        Route untuk melihat semua dosen pemohon
    */
    Route::group(['prefix'  =>  'operator/pemohons'], function(){
        Route::get('/','OperatorDosenPemohonController@index')->name('operator.pemohons.dosen');
        Route::get('/detail/{dosen:slug}','OperatorDosenPemohonController@show')->name('operator.pemohons.dosen.show');
        Route::patch('/{dosen:id}/verifikasi','OperatorDosenPemohonController@verifikasi')->name('admin.pemohons.dosen.verifikasi');
    });
});

Route::group(['prefix'  =>  'operator'], function(){
    Route::get('/login','Auth\LoginController@showOperatorLoginForm');
    Route::post('/login','Auth\LoginController@operatorLogin')->name('operator.login');
    Route::get('/dashboard','AdminDashboardController@index')->name('operator.dashboard');
    Route::get('/logout','Auth\LoginController@logoutOperator')->name('operator.logout');

    /*
        Route untuk verifikasi permohonan oleh operator fakultas
    */
    Route::get('/verifikasi','OperatorVerifikasiController@verifikasiDosen')->name('operator.verifikasi.dosens');
    Route::get('/verifikasi/{dosen:slug}/{cuti_dosen}','OperatorVerifikasiController@verifikasiDosenDetail')->name('operator.verifikasi.dosens.detail');
    Route::patch('/verifikasi/{dosen:slug}/{cuti_dosen}','OperatorVerifikasiController@verifikasiDosenUpdate')->name('operator.verifikasi.dosens.update');

    /*
        Route untuk riwayat verifikasi dari fakultas
    */
    Route::get('/riwayat','OperatorRiwayatController@riwayatDosenDisetujui')->name('operator.riwayat.dosens');

    /*
        Route untuk melihat semua permohonan berdasarkan status
    */
    Route::get('/permohonans/belum_diajukan','OperatorPermohonanController@belumDIajukan')->name('operator.permohonans.belum_diajukan');
    Route::get('/permohonans/menunggu_verifikasi','OperatorPermohonanController@menungguVerifikasi')->name('operator.permohonans.menunggu_verifikasi');
    Route::get('/permohonans/dilanjutkan','OperatorPermohonanController@dilanjutkan')->name('operator.permohonans.dilanjutkan');
    Route::get('/permohonans/tidak_dilanjutkan','OperatorPermohonanController@tidakDilanjutkan')->name('operator.permohonans.tidak_dilanjutkan');
    Route::get('/permohonans/disetujui','OperatorPermohonanController@disetujui')->name('operator.permohonans.disetujui');
    Route::get('/permohonans/tidak_disetujui','OperatorPermohonanController@tidakDisetujui')->name('operator.permohonans.tidak_disetujui');

    /*
        Route untuk melihat semua dosen pemohon
    */
    Route::group(['prefix'  =>  'operator/pemohons'], function(){
        Route::get('/','OperatorDosenPemohonController@index')->name('operator.pemohons.dosen');
        Route::get('/detail/{dosen:slug}','OperatorDosenPemohonController@show')->name('operator.pemohons.dosen.show');
        Route::patch('/{dosen:id}/verifikasi','OperatorDosenPemohonController@verifikasi')->name('admin.pemohons.dosen.verifikasi');
    });
});

Route::group(['prefix'  =>  'admin/pegawais','middleware'   =>  'auth:operator'], function(){
    Route::get('/','PegawaiController@index')->name('admin.pegawais');
    Route::get('/detail/{pegawai:slug}','PegawaiController@show')->name('admin.pegawais.show');
    Route::get('/add','PegawaiController@add')->name('admin.pegawais.add');
    Route::post('/','PegawaiController@post')->name('admin.pegawais.post');
    Route::get('/{pegawai:slug}/edit','PegawaiController@edit')->name('admin.pegawais.edit');
    Route::patch('/{pegawai:slug}/update','PegawaiController@update')->name('admin.pegawais.update');
    Route::delete('/{pegawai:slug}/delete','PegawaiController@delete')->name('admin.pegawais.delete');
});

Route::group(['prefix'  =>  'admin/operators'], function(){
    Route::get('/','OperatorFakultasController@index')->name('admin.operators');
    Route::get('/detail/{pegawai:slug}','OperatorFakultasController@show')->name('admin.operators.show');
    Route::get('/add','OperatorFakultasController@add')->name('admin.operators.add');
    Route::post('/','OperatorFakultasController@post')->name('admin.operators.post');
    Route::get('/{pegawai:slug}/edit','OperatorFakultasController@edit')->name('admin.operators.edit');
    Route::patch('/{pegawai:slug}/update','OperatorFakultasController@update')->name('admin.operators.update');
    Route::delete('/{pegawai:slug}/delete','OperatorFakultasController@delete')->name('admin.operators.delete');
});


Route::group(['prefix'  =>  'operator'], function(){
    Route::get('/dashboard','OperatorDashboardController@index')->name('operator.dashboard');
});

Route::group(['prefix'  =>  'operator/pegawais'], function(){
    Route::get('/','OperatorPegawaiController@index')->name('operator.pegawais');
    Route::get('/detail/{pegawai:slug}','OperatorPegawaiController@show')->name('operator.pegawais.show');
});

Route::group(['prefix'  =>  'admin/pengajuans'], function(){
    Route::get('/','AdminPengajuanController@index')->name('admin.pengajuans');
    Route::patch('/{pegawai}/verifikasi','AdminPengajuanController@verifikasi')->name('admin.pengajuans.verifikasi');

    // Route::get('/detail/{pegawais:slug}','AdminPengajuanController@show')->name('admin.pengajuans.show');
});