<?php

use Illuminate\Http\Request;

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


$router->group(['prefix' => 'api/v1/oauth', 'middleware' => 'client'], function () use (&$router) {

    // User information
    $router->group(['prefix' => 'user'], function () use (&$router) {
        $router->post('/register',  'Auth\AuthController@register');
        // $router->post('/login',  'Auth\AuthController@login');
    });

    // Post Information
    $router->group(['prefix' => 'post'], function () use (&$router) {
        $router->post('/add',  'Post\PostController@store');
        $router->get('/{slug}/detail',  'Post\PostController@show');
        $router->post('/{slug}/update',  'Post\PostController@update');
    });

    // Comment Information
    $router->group(['prefix' => 'comment'], function () use (&$router) {
        $router->post('/add',  'Comment\CommentController@store');
        $router->get('/{id}/detail',  'Comment\CommentController@showById');
        $router->post('/{slug}/update',  'Comment\CommentController@update');
    });

});
