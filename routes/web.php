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

$router->get('/', 'MainController@index');

$router->get('/signup', 'AuthController@signup');
$router->get('/signin', 'AuthController@signin');
$router->get('/logout', 'AuthController@logout');
$router->get('/info', 'UserController@info');


$router->post('/signup', 'AuthController@register');
$router->post('/signin', 'AuthController@login');
$router->post('/info', 'UserController@editInfo');

$router->get('/friend/add', 'MainController@addFriend');