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

Route::get('/home', 'PagesController@home');

Route::resource('samples', 'SamplesController');
Route::controller('sample', 'SamplesController');
Route::get('/samples',[
  'as' => 'sample.amostras',
  'uses' => 'SamplesController@getTodasAmostras'
]);

Route::auth();

Route::group(['middleware' => 'auth'], function () {
  Route::resource('projects', 'ProjectsController');

  Route::resource('labels', 'LabelsController');

  Route::controller('intermediate', 'IntermediatesController');

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

  Route::get('/projects/{projectId}/samples/{sampleId}',[
      'as' => 'sample.exibeAmostra',
      'uses' => 'SamplesController@getExibeAmostra'
  ]);

  Route::get('/projects/{projectId}/samples/import',[
    'as' => 'sample.importaAmostra',
    'uses' => 'SamplesController@getImportaAmostra'
  ]);

  Route::post('/projects/{id}/samples/Excel',[
    'as' => 'sample.excelAmostra',
    'uses' => 'SamplesController@postExcelArmazena'
  ]);

  Route::post('/projects/{id}/samples/setExcel',[
    'as' => 'sample.excelConfigura',
    'uses' => 'SamplesController@postExcelSet'
  ]);

  Route::post('/projects/{id}/samples/exportExcel',[
    'as' => 'sample.excelExporta',
    'uses' => 'SamplesController@postExcelExport'
  ]);
});
