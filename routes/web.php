<?php

use Illuminate\Support\Facades\Route;

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
//user routes
Route::get('/','HomeController@index')->name('user.dashboard');
Route::get('/home','HomeController@index')->name('user.dashboard');
Route::get('/players/{id}','HomeController@getTeamPlayers')->name('user.players');
Route::get('/listteams','HomeController@teams')->name('user.teams');
Route::get('/listmatches','HomeController@matches')->name('user.matches');
Route::get('/points','HomeController@points')->name('user.points');



//admin routes
Route::get('/admin','AdminController@index')->name('admin.dashboard'); 
Route::get('/teams','TeamsController@index')->name('admin.teams');
Route::get('/addteam','TeamsController@add')->name('admin.addteam');
Route::post('/postteam','TeamsController@postTeam')->name('admin.postteam');
Route::get('/editteam','TeamsController@edit')->name('admin.editteam');


Route::get('/players','PlayersController@index')->name('admin.players');
Route::get('/addplayer','PlayersController@add')->name('admin.addplayer');
Route::post('/postplayer','PlayersController@postPlayer')->name('admin.postplayer');
Route::get('/editplayer','PlayersController@edit')->name('admin.editplayer');
Route::get('/managestats/{id}','PlayersController@manageStats')->name('admin.managestats');
Route::post('/postmanagestats/{id}','PlayersController@postManageStats')->name('admin.postmanagestats');

Route::get('/matches','MatchesController@index')->name('admin.matches');
Route::get('/addmatch','MatchesController@addMatch')->name('admin.addmatch');
Route::post('/postmatch','MatchesController@postMatch')->name('admin.postmatch');
Route::get('/editmatch','MatchesController@editMatch')->name('admin.editmatch');

Route::get('/managepoints/{id}','TeamsController@managePoints')->name('admin.managepoints');
Route::post('/postpoints/{id}','TeamsController@postpoints')->name('admin.postpoints'); 
