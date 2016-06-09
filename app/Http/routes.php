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
//$app->get('/', function () use ($app) {
//    return $app->version();
//});
$app->post('auth/register', 'AuthController@register');
//$api->version('v1',function ($api){
//    $api->group(['namespace'=>'App\Api\V1\Controllers'],function ($api){
//        $api->post('user/login','AuthController@userLogin');
//        $api->post('user/register','AuthController@register');
//        $api->group(['middleware'=>'jwt.auth'],function($api){
////            $api->get('user/me','AuthController@getAuthenticatedUser');
////            $api->get('lessons','LessonsController@index');
////            $api->get('lessons/{id}','LessonsController@show');
//        });
//
//    });
//});
