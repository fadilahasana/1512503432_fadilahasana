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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });
$api=app('Dingo\Api\Routing\Router');
$api->version('v1',function($api){
  $api->get('/', function(){
    throw new
    Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException([], "Method Not Allowed");
  });
  // Default_Controller
  $api->get('categories','App\Http\Controllers\CategoryController@index');

  // read
  $api->get('categories/{id}','App\Http\Controllers\CategoryController@show');

  // Creat
  $api->post('categories','App\Http\Controllers\CategoryController@store');

  // Update
  $api->put('categories/{id}','App\Http\Controllers\CategoryController@update');

  // Delete
  $api->delete('categories/{id}','App\Http\Controllers\CategoryController@destroy');


$api->get('books','App\Http\Controllers\BookController@index');

  // read
  $api->get('books/{id}','App\Http\Controllers\BookController@show');

  // Creat
  $api->post('books','App\Http\Controllers\BookController@store');

  // Update
  $api->put('books/{id}','App\Http\Controllers\BookController@update');

  // Delete
  $api->delete('books/{id}','App\Http\Controllers\BookController@destroy');

});
