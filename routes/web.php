<?php

use Illuminate\Support\Facades\Route;

Route::prefix('refresh-csrf', function(){
    return csrf_token();
});

Auth::routes();
Route::middleware('auth')->group(function (){
    Route::get('/','App\Http\Controllers\HomeController@index')->name('index');
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

    Route::prefix('usuario')->group(function () {
        Route::get('/','App\Http\Controllers\UsuarioController@index')->name('usuarios');
        Route::get('/listar/{page?}','App\Http\Controllers\UsuarioController@listar')->name('listarUsuarios');
        Route::get('/nuevo','App\Http\Controllers\UsuarioController@nuevo')->name('nuevoUsuario');
        Route::post('/grabar','App\Http\Controllers\UsuarioController@grabar')->name('grabarUsuario');
        Route::get('/{id}/editar','App\Http\Controllers\UsuarioController@editar')->name('editarUsuario');
        Route::get('/{id}/cambiarContrasenia','App\Http\Controllers\UsuarioController@cambiarContrasenia')->name('cambiarContrasenia');
        Route::post('/{id}/actualizar','App\Http\Controllers\UsuarioController@actualizar')->name('actualizarUsuario');
        Route::post('/{id}/actualizarContrasenia','App\Http\Controllers\UsuarioController@actualizarContrasenia')->name('actualizarContrasenia');
        Route::get('/{id}/eliminar','App\Http\Controllers\UsuarioController@eliminar')->name('eliminarUsuario');
        Route::get('/buscar/','App\Http\Controllers\UsuarioController@listar')->name('buscarUsuario');
        Route::get('/buscar/{consulta}','App\Http\Controllers\UsuarioController@buscar')->name('buscarUsuario');
        Route::get('/{id}','App\Http\Controllers\UsuarioController@info')->name('infoUsuario');
    });

    Route::prefix('persona')->group(function () {
        Route::get('/','App\Http\Controllers\PersonaController@index')->name('personas');
        Route::get('/listar/{page?}','App\Http\Controllers\PersonaController@listar')->name('listarPersonas');
        Route::get('/nuevo','App\Http\Controllers\PersonaController@nuevo')->name('nuevoPersona');
        Route::post('/grabar','App\Http\Controllers\PersonaController@grabar')->name('grabarPersona');
        Route::get('/{id}/editar','App\Http\Controllers\PersonaController@editar')->name('editarPersona');
        Route::post('/{id}/actualizar','App\Http\Controllers\PersonaController@actualizar')->name('actualizarPersona');
        Route::get('/{id}/eliminar','App\Http\Controllers\PersonaController@eliminar')->name('eliminarPersona');
        Route::get('/buscar/','App\Http\Controllers\PersonaController@listar')->name('buscarPersona');
        Route::get('/buscar/{consulta}','App\Http\Controllers\PersonaController@buscar')->name('buscarPersona');
        Route::get('/{id}','App\Http\Controllers\PersonaController@info')->name('infoPersona');
    });

    Route::prefix('mensaje')->group(function () {
        Route::get('/','App\Http\Controllers\MensajeController@index')->name('mensajes');
        Route::get('/listar/{page?}','App\Http\Controllers\MensajeController@listar')->name('listarMensajes');
        Route::get('/buscar/','App\Http\Controllers\MensajeController@listar')->name('buscarMensaje');
        Route::get('/buscar/{consulta}','App\Http\Controllers\MensajeController@buscar')->name('buscarMensaje');
        Route::get('/{id}','App\Http\Controllers\MensajeController@info')->name('infoMensaje');
    });

    Route::prefix('log')->group(function () {
        Route::get('/','App\Http\Controllers\LogController@index')->name('logs');
        Route::get('/listar/{page?}','App\Http\Controllers\LogController@listar')->name('listarLog');
        Route::get('/buscar/','App\Http\Controllers\LogController@listar')->name('buscarLog');
        Route::get('/buscar/{consulta}','App\Http\Controllers\LogController@buscar')->name('buscarLog');
        Route::get('/{id}','App\Http\Controllers\LogController@info')->name('infoLog');
    });

    
});
