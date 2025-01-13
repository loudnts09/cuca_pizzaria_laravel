<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/cadastro', 'PessoaController@create')->name('site.cadastro');
Route::post('/cadastro', 'PessoaController@store')->name('site.store');

Route::get('/', 'LoginController@index')->name('site.index');
Route::post('/','LoginController@login')->name('site.login');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index' )->name('app.home');
    Route::get('/pedido', 'PedidoController@create')->name('app.pedido');
});

Route::post('/home', 'HomeController@logoff')->name('site.logoff');
Route::post('/pedido','PedidoController@store')->name('app.store');
