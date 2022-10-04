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

$router->group(["prefix" => "user"], function () use ($router) {
    $router->get("getalluser", ["uses" => "UserController@getAllUser"]);
    $router->get("getuserbyid/{id}", ["uses" => "UserController@getUserById"]);
    $router->post("getlogin", ["uses" => "UserController@getLogin"]);
    $router->post("register", ["uses" => "UserController@register"]);
});

$router->group(["prefix" => "tempat"], function () use ($router) {
    $router->get("getalltempat", ["uses" => "TempatController@getAllTempat"]);
    $router->get("getjenistempat", ["uses" => "TempatController@getJenisTempat"]);
    $router->get("gettempatbyjenis/{id}", ["uses" => "TempatController@getTempatByJenis"]);
});

$router->group(["prefix" => "area"], function () use ($router) {
    $router->get("getjenisarea", ["uses" => "AreaController@getJenisArea"]);
    $router->get("getareabyjenis/{id}", ["uses" => "AreaController@getAreaByJenis"]);
});

$router->group(["prefix" => "nilai"], function () use ($router) {
    $router->get("getallpenilaian", ["uses" => "PenilaianController@getAllPenilaian"]);
});
