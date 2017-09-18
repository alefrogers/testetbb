<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Route::get('/', function () {
    return redirect()->route('investments.type.index');
});

Route::group(['prefix' => 'investments', 'as' => 'investments.'], function() {
    ## Tipos de Investimentos ##
    Route::resource('type', 'Investments\TypesInvestmentsController');
    
    ## Simulações de investimento ##
    Route::resource('simulation', 'Investments\SimulationsInvestmentsController');
});
