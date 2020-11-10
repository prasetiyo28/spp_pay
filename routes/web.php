<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/', 'DashboardController@index')->name('dashboard.index');
// Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard')->middleware('role');

// Route::group(['prefix' => 'u', 'middleware' => 'role:isPelanggan,isBordir'], function(){
//     Route::get('home', 'HomeController@index')->name('home');
// });

// Route::get('beranda', 'BerandaController@beranda');


Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','checkRole:admin,superadmin']], function() {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('home', 'DashboardController@dashboard')->name('dashboard');
    Route::get('profile', 'DashboardController@profile')->name('dashboard.profile');
    Route::put('profile', 'DashboardController@profileUpdate')->name('dashboard.profileUpdate');

    Route::group(['prefix' => 'siswa'], function(){
        Route::get('/', 'SiswaController@index')->name('siswa.index');
        Route::get('create', 'SiswaController@create')->name('siswa.create');
        Route::post('create', 'SiswaController@store')->name('siswa.store');
        Route::get('data', 'SiswaController@getData')->name('siswa.getdata');
        Route::get('edit/{id}', 'SiswaController@edit')->name('siswa.edit');
        Route::post('update/{id}', 'SiswaController@update')->name('siswa.update');
        Route::get('delete/{id}','SiswaController@destroy')->name('siswa.delete');

        Route::post('import','SiswaController@importSiswa')->name('siswa.import');

    });

    Route::group(['prefix' => 'periode'], function(){
        Route::get('/', 'PeriodeController@index')->name('periode.index');
        Route::get('create', 'PeriodeController@create')->name('periode.create');
        Route::post('create', 'PeriodeController@store')->name('periode.store');
        Route::get('edit/{id}', 'PeriodeController@edit')->name('periode.edit');
        Route::post('update/{id}', 'PeriodeController@update')->name('periode.update');
        Route::get('delete/{id}','PeriodeController@destroy')->name('periode.delete');
        Route::get('data', 'PeriodeController@getData')->name('periode.getdata');
        
    });

    Route::group(['prefix' => 'kelas'], function(){
        Route::get('/', 'KelasController@index')->name('kelas.index');
        Route::get('create', 'KelasController@create')->name('kelas.create');
        Route::post('create', 'KelasController@store')->name('kelas.store');
        Route::get('edit/{id}', 'KelasController@edit')->name('kelas.edit');
        Route::post('update/{id}', 'KelasController@update')->name('kelas.update');
        Route::get('{id}/delete', 'KelasController@destroy')->name('kelas.delete');
        Route::get('data', 'KelasController@getData')->name('kelas.getdata');
    });
    
    Route::group(['prefix' => 'tagihan'], function(){
        Route::get('/', 'TagihanController@index')->name('tagihan.index');
        Route::get('create', 'TagihanController@create')->name('tagihan.create');
        Route::post('create', 'TagihanController@store')->name('tagihan.store');
        Route::get('edit/{id}', 'TagihanController@edit')->name('tagihan.edit');
        Route::put('update/{id}', 'TagihanController@update')->name('tagihan.update');
        Route::get('{id}/delete', 'TagihanController@destroy')->name('tagihan.delete');
        Route::get('data', 'TagihanController@getData')->name('tagihan.getdata');
    });

    Route::group(['prefix' => 'transaksi'], function(){
        Route::get('/', 'TransaksiController@index')->name('transaksi.index');
        Route::post('cari-transaksi', 'TransaksiController@cariTagihan')->name('transaksi.cari');
        Route::get('create', 'TransaksiController@create')->name('transaksi.create');
        Route::post('create', 'TransaksiController@store')->name('transaksi.store');
        Route::get('edit/{id}', 'TransaksiController@edit')->name('transaksi.edit');
        Route::post('update/{id}', 'TransaksiController@update')->name('transaksi.update');
        Route::get('{id}/delete', 'TransaksiController@destroy')->name('transaksi.delete');
        Route::get('data', 'TransaksiController@getData')->name('transaksi.getdata');

        Route::get('cetak/{id}','TransaksiController@cetakInvoice')->name('transaksi.invoice');
        Route::get('print/{id}','TransaksiController@printInvoice')->name('transaksi.print');
    });

   
    Route::group(['prefix' => 'laporan'], function(){
        Route::get('/', 'KepsekController@index')->name('kepsek.dashboard');
        Route::get('/siswa', 'KepsekController@siswa')->name('kepsek.siswa');
        Route::get('datasiswa', 'KepsekController@getDataSiswa')->name('siswa.getdata.laporan');
        Route::get('/tagihan', 'KepsekController@tagihan')->name('kepsek.tagihan');
        Route::get('datatagihan', 'KepsekController@getDataTagihan')->name('tagihan.getdata.laporan');
        Route::get('/transaksi', 'KepsekController@transaksi')->name('kepsek.transaksi');
        Route::get('datatransaksi', 'KepsekController@getDataTransaksi')->name('transaksi.getdata.laporan');
        Route::get('siswa/export/', 'KepsekController@exportsiswa')->name('export.siswa');
        Route::get('tagihan/export/', 'KepsekController@exporttagihan')->name('export.tagihan');
        Route::get('transaksi/export/', 'KepsekController@exporttransaksi')->name('export.transaksi');

        Route::get('lap-pembayaran', 'DashboardController@laporan_pembayaran')->name('lap.pembayaran');
        Route::get('lap-tunggakan', 'DashboardController@laporan_tunggakan')->name('lap.tunggakan');
    });
});

Route::get('/getNotifTagihan', 'BerandaController@getTagihan')->name('getTagihan');
Route::group(['prefix' => 'beranda', 'middleware' => ['auth','checkRole:siswa']], function() {
    Route::get('/', 'BerandaController@beranda')->name('beranda');
    Route::get('tagihan', 'BerandaController@tagihan')->name('tagihan');
    Route::get('history', 'BerandaController@history')->name('history');
    Route::get('profil', 'BerandaController@profil')->name('profil');
    Route::get('data', 'BerandaController@getData')->name('tagihan.beranda.getdata');
    Route::get('datahistory', 'BerandaController@getDataHistory')->name('tagihan.beranda.history');

    
});

