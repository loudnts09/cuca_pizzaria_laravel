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

Route::get('/create', 'PessoaController@create');

Route::post('/create', 'PessoaController@store')->name('app.cadastro.create');

Route::get('/', 'LoginController@index')->name('site.login');

Route::get('/home', 'HomeController@index' )->name('site.home');