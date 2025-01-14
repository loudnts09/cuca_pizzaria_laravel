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

Route::get('/', 'LoginController@index')->name('site.index');
Route::post('/','LoginController@login')->name('site.login');
Route::post('/home', 'HomeController@logoff')->name('site.logoff');

Route::get('/cadastro', 'PessoaController@create')->name('cadastro.create');
Route::post('/cadastro', 'PessoaController@store')->name('cadastro.store');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', 'HomeController@index' )->name('home.index');

    Route::group(['prefix' => 'pedidos'], function(){
        Route::get('/novo', 'PedidoController@create')->name('pedido.create');
        Route::post('/novo','PedidoController@store')->name('pedido.store');
        Route::get('/meus', 'PedidoController@show')->name('meus_pedidos.show');
        Route::delete('/meus/{pedido}','PedidoController@destroy')->name('pedido.destroy');
        Route::get('/meus/editar/{pedido}', 'PedidoController@edit')->name('pedido.edit');
        Route::put('/meus/editar/{pedido}', 'PedidosController@update')->name('pedido.update');

    });
    
});

