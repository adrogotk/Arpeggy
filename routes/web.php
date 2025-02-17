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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('home');
});*/
Auth::routes();
Route::get('/home', 'DAO@obtenerPaginaPrincipal')->name('home');
Route::get('perfil', 'DAO@irAPerfil')->name('perfil');
Route::get('topCanciones', 'DAO@irATopCanciones')->name('topCanciones');
Route::get('mostrarCrearLista', 'DAO@mostrarCrearLista')->name('mostrarCrearLista');
Route::get('listasReproduccion', 'DAO@irAListasReproduccion')->name('listasReproduccion');
Route::get('artistasSeguidos', 'DAO@irAArtistasSeguidos')->name('artistasSeguidos');
Route::get('artistasSeguidosCanciones', 'DAO@irAArtistasSeguidosCanciones')->name('artistasSeguidosCanciones');
Route::get('/', 'DAO@obtenerInicioLaravel');
Route::get('/rt','DAO@mostrarLogin' );
Route::get('/index', 'DAO@obtenerPaginaPrincipal')->name('index');
Route::get('DAO/mostrarCancionEditar/{cancionId}', 'DAO@mostrarCancionEditar')->name('DAO/mostrarCancionEditar');
Route::get('DAO/mostrarCrearDisco/{artista_id}', 'DAO@mostrarCrearDisco')->name('DAO/mostrarCrearDisco');
Route::get('DAO/mostrarCrearCancion/{id}', 'DAO@mostrarCrearCancion')->name('DAO/mostrarCrearCancion');
Route::get('DAO/obtenerPaginaComprar/{id}', 'DAO@obtenerPaginaComprar')->name('DAO/obtenerPaginaComprar');
Route::get('DAO/mostrarCrearLista', 'DAO@mostrarCrearLista')->name('DAO/mostrarCrearLista');
//Route::get('/home', 'DAO@iniciarSesion');
Route::get('DAO/obtenerArtistaPorNombre/{nombre}', 'DAO@obtenerArtistaPorNombre')->name('DAO/obtenerArtistaPorNombre');
Route::get('DAO/obtenerArtistaPorId/{id}', 'DAO@obtenerArtistaPorId')->name('DAO/obtenerArtistaPorId');
Route::get('DAO/obtenerArtistaCancion/{id}', 'DAO@obtenerArtistaCancion')->name('DAO/obtenerArtistaCancion');
Route::get('DAO/obtenerCancionPorNombre/{nombre}', 'DAO@obtenerCancionPorNombre')->name('DAO/obtenerCancionPorNombre');
Route::get('DAO/obtenerDiscoPorNombre/{nombre}', 'DAO@obtenerDiscoPorNombre')->name('DAO/obtenerDiscoPorNombre');
Route::get('DAO/obtenerListasPorNombre/{nombre}', 'DAO@obtenerListasPorNombre')->name('DAO/obtenerListasPorNombre');
Route::get('DAO/obtenerArtistasColaboradores/{artista}', 'DAO@obtenerArtistasColaboradores')->name('DAO/obtenerArtistasColaboradores');
//Route::get('DAO/insertarCompra/{id}', 'DAO@insertarCompra')->name('DAO/insertarCompra');
Route::post('DAO/obtenerArtistaPorNombre', 'DAO@obtenerArtistaPorNombre');
Route::post('DAO/obtenerDiscoPorNombre', 'DAO@obtenerDiscoPorNombre');
Route::post('DAO/obtenerCancionPorNombre', 'DAO@obtenerCancionPorNombre');
Route::post('DAO/obtenerListasPorNombre', 'DAO@obtenerListasPorNombre');
Route::post('DAO/obtenerPaginaComprar', 'DAO@obtenerPaginaComprar');
Route::post('DAO/obtenerDiscoPorIdFormulario', 'DAO@obtenerDiscoPorIdFormulario');
Route::post('DAO/obtenerCancionPorIdFormulario', 'DAO@obtenerCancionPorIdFormulario');
Route::post('DAO/obtenerPaginaPrincipal', 'DAO@obtenerPaginaPrincipal');
Route::post('DAO/obtenerListaPorId', 'DAO@obtenerListaPorId');
Route::post('DAO/actualizarArtista', 'DAO@actualizarArtista');
Route::post('DAO/mostrarDiscoEditar', 'DAO@mostrarDiscoEditar');
Route::post('DAO/actualizarTituloDisco', 'DAO@actualizarTituloDisco');
Route::post('DAO/mostrarCancionEditar', 'DAO@mostrarCancionEditar');
Route::post('DAO/borrarCancion', 'DAO@borrarCancion');
Route::post('DAO/borrarDisco', 'DAO@borrarDisco');
Route::post('DAO/borrarLista', 'DAO@borrarLista');
Route::post('DAO/borrarCancionLista', 'DAO@borrarCancionLista');
Route::post('DAO/borrarSeguimiento', 'DAO@borrarSeguimiento');
Route::post('DAO/actualizarCancion', 'DAO@actualizarCancion');
Route::post('DAO/actualizarUrl', 'DAO@actualizarUrl');
Route::post('DAO/actualizarImagenArtista', 'DAO@actualizarImagenArtista');
Route::post('DAO/actualizarImagenDisco', 'DAO@actualizarImagenDisco');
Route::post('DAO/actualizarNombreLista', 'DAO@actualizarNombreLista');
Route::post('DAO/editarPerfil', 'DAO@editarPerfil');
Route::post('DAO/mostrarCrearDisco', 'DAO@mostrarCrearDisco');
Route::post('DAO/mostrarCrearCancion', 'DAO@mostrarCrearCancion');
Route::post('DAO/crearDisco', 'DAO@crearDisco');
Route::post('DAO/crearCancion', 'DAO@crearCancion');
Route::post('DAO/crearLista', 'DAO@crearLista');
Route::post('DAO/crearSeguimiento', 'DAO@crearSeguimiento');
Route::post('DAO/insertarCompra', 'DAO@insertarCompra');
Route::post('DAO/insertarCancionesLista', 'DAO@insertarCancionesLista');
Route::resource('HomeController', 'HomeController');
Route::resource('DAO','DAO');

