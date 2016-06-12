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

$app->get('/', function () use ($app) {
    return $app->version();
});
$api = app('Dingo\Api\Routing\Router');
$api->version('v1',function ($api){
    $api->group(['prefix' => 'v1','middleware'=>'cors','namespace'=>'App\Http\Controllers\Api\V1'],function ($api){
        $api->post('user/login','Auth\AuthController@userLogin');
        $api->post('user/register','Auth\AuthController@userRegister');
        $api->group(['middleware'=>'jwt.auth'],function($api){
            $api->get('user/me','Auth\AuthController@myUserInfo');
            $api->get('user/refreshtoken','Auth\AuthController@refreshToken');
            $api->get('lessons/{id}','LessonsController@show');
        });

    });
});
