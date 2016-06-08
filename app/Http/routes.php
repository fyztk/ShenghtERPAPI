<?php

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
$api = app('Dingo\Api\Routing\Router');
$app->get('/', function () use ($app) {
    return $app->version();
});
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
    // 需要jwt验证后才能使用的API 也就是登陆之后,才能访问的路由,比如用户详细
    $api->group(['middleware' => 'jwt.auth'], function ($api) {
        #Auth
        $api->get('auth/show', [
            'as'   => 'auth.show',
            'uses' => 'AuthController@show'
        ]);
    });
});