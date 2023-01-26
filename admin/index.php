<?php 

error_reporting(1);
date_default_timezone_set('Europe/Istanbul');

require __DIR__ . '/database.php';
require __DIR__ . '/model.php';
require __DIR__ . '/controller.php';
require __DIR__ . '/route.php';


$urlprotocol = Route::the_url($_SERVER);
$fullurl = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$urlremove = str_replace($urlprotocol,"",$fullurl);
$types = explode("/", $urlremove);

Route::run('/', 'loginController@index');
Route::run('/', 'loginController@login', 'post');

Route::run('/home', 'homeController@index');

Route::run('/category-list', 'categoryController@select_all');
Route::run('/category-add', 'categoryController@insert');
Route::run('/category-add', 'categoryController@insert', 'post');
Route::run('/category-edit/{id}', 'categoryController@select');
Route::run('/category-edit/{id}', 'categoryController@update', 'post');

Route::run('/post-list', 'postController@select_all');
Route::run('/post-add', 'postController@insert');
Route::run('/post-add', 'postController@insert', 'post');
Route::run('/post-edit/{id}', 'postController@select');
Route::run('/post-edit/{id}', 'postController@update', 'post');

Route::run('/settings', 'settingsController@select');
Route::run('/settings', 'settingsController@update', 'post');
?>