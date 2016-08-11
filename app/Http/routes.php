<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);

Route::resource('projects', 'ProjectsController');

Route::resource('labels', 'LabelsController');
Route::resource('samples', 'SamplesController');

Route::controller('intermediate', 'IntermediatesController');

Route::controller('sample', 'SamplesController');

Route::post('/intermediate/atualiza/{id}',[
    'as' => 'intermediate.atualiza',
    'uses' => 'IntermediatesController@atualiza'
]);

Route::post('/intermediate/adiciona',[
    'as' => 'intermediate.adiciona',
    'uses' => 'IntermediatesController@adiciona'
]);

Route::get('/projects/{id}/samples/',[
  'as' => 'project.amostras',
  'uses' => 'ProjectsController@getAmostras'
]);

Route::get('/projects/{id}/novoregistro',[
    'as' => 'sample.novaAmostra',
    'uses' => 'SamplesController@getAdiciona'
]);

Route::post('/projects/{id}/insereSample',[
    'as' => 'sample.insereSample',
    'uses' => 'SamplesController@postArmazena'
]);
