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

    Route::get('/perfil','PessoaController@index')->name('pessoa.index');
    Route::put('/perfil/{id}', 'PessoaController@update')->name('pessoa.update');
    Route::delete('/perfil/{id}', 'PessoaController@destroy')->name('pessoa.destroy');

    Route::group(['prefix' => 'pedidos'], function(){
        Route::get('/novo', 'PedidoController@create')->name('pedido.create');
        Route::post('/novo','PedidoController@store')->name('pedido.store');
        Route::get('/meus', 'PedidoController@index')->name('pedidos.index');
        Route::delete('/meus/{pedido}','PedidoController@destroy')->name('pedido.destroy');
        Route::get('/meus/editar/{pedido}', 'PedidoController@edit')->name('pedido.edit');
        Route::put('/meus/editar/{pedido}', 'PedidoController@update')->name('pedido.update');

    });
    
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

