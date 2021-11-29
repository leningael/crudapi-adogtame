<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//MASCOTAS

$router->get('/mascotas', 'MascotaController@index');

$router->get('/mascotas/{id}', 'MascotaController@show');

$router->post('/mascotas', 'MascotaController@store');

$router->post('/mascotas/{id}', 'MascotaController@update');

$router->delete('/mascotas/{id}', 'MascotaController@destroy');

//USUARIOS

$router->get('/usuarios', 'UsuarioController@index');

$router->get('/usuarios/{username}', 'UsuarioController@show');

$router->post('/usuarios', 'UsuarioController@store');

$router->post('/usuarios/{username}', 'UsuarioController@update');

$router->delete('/usuarios/{username}', 'UsuarioController@destroy');

//ARTICULOS

$router->get('/articulos', 'ArticuloController@index');

$router->get('/articulos/{id}', 'ArticuloController@show');

$router->post('/articulos', 'ArticuloController@store');

$router->post('/articulos/{id}', 'ArticuloController@update');

$router->delete('/articulos/{id}', 'ArticuloController@destroy');
