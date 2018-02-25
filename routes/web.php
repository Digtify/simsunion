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

Route::get('', ['uses' => 'Home\HomeController@show', 'as' => 'homepage']);

/* [AUTH] */
Route::get('login', ['uses' => 'AuthController@login', 'as' => 'login']);
Route::post('login', ['uses' => 'AuthController@postLogin']);
Route::get('register', ['uses' => 'AuthController@register', 'as' => 'register']);
Route::post('register', ['uses' => 'AuthController@postRegister']);
Route::get('logout', ['uses' => 'Auth\LoginController@logout']);

/* [ONBOARDING] */
Route::get('register/verify-mail', ['uses' => 'AuthController@verifyMail', 'as' => 'onboarding_verify-mail']);
Route::get('register/find_people', ['uses' => 'AuthController@findPeople', 'as' => 'onboarding_find-people']);
Route::get('register/details', ['uses' => 'AuthController@giveDetails', 'as' => 'onboarding_details']);
Route::get('register/complete', ['uses' => 'AuthController@registerDone', 'as' => 'onboarding_done']);

/* [ACCOUNT] */
Route::get('{username}', ['uses' => 'AccountController@showAccount', 'as' => 'account']);
Route::get('{username}/families', ['uses' => 'AccountController@showCategoryFamilies', 'as' => 'account_families']);
Route::get('{username}/buildings', ['uses' => 'AccountController@showCategoryBuildings', 'as' => 'account_buildings']);
Route::get('{username}/settings', ['uses' => 'AccountController@showAccountSettings', 'as' => 'account_settings']);
