<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\App;

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

$router->group(['prefix' => 'api/v1', 'middleware' => 'client'], function () use ($router) {
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('register', [
            'as' => 'authRegister',
            'uses' => 'Core\User\Controllers\AuthController@register'
        ]);
        $router->post('login', [
            'as' => 'authlogin',
            'uses' => 'Core\User\Controllers\AuthController@login'
        ]);
    });

    $router->group(['prefix' => 'user', 'middleware' => 'auth'], function () use ($router) {
        $router->get('{id}', [
            'as' => 'getUserInfo',
            'uses' => 'Core\User\Controllers\UserController@getUserInfo'
        ]);
    });

    $router->group(['prefix' => 'projects', 'middleware' => 'auth'], function () use ($router) {
        $router->get('/', [
            'as' => 'listProjects',
            'uses' => 'Core\Project\Controllers\ProjectController@list'
        ]);
        $router->get('{id}', [
            'as' => 'showProject',
            'uses' => 'Core\Project\Controllers\ProjectController@show'
        ]);
        $router->post('/', [
            'as' => 'storeProject',
            'uses' => 'Core\Project\Controllers\ProjectController@store'
        ]);
        $router->post('{id}', [
            'as' => 'updateProject',
            'uses' => 'Core\Project\Controllers\ProjectController@update'
        ]);
        $router->delete('{id}', [
            'as' => 'deleteProject',
            'uses' => 'Core\Project\Controllers\ProjectController@delete'
        ]);
    });

    $router->get('test', [
        'as' => 'test',
        'uses' => 'Core\Common\Controllers\ExampleController@test'
    ]);
});
