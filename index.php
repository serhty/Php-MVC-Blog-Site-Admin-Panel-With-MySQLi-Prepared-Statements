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

if(empty($types[3])){
    $pageType = "home";
}elseif(!empty($types[3]) && empty($types[4])){
    $pageType = "category";
}elseif(!empty($types[3]) && !empty($types[4])){
    $pageType = "post";
}

if($pageType == "home"){
	Route::run('/', 'homeController@index');
}elseif($pageType == "category"){
	Route::run('/{url}', 'categoryController@select');
}elseif($pageType == "post"){
	Route::run('/{url}/{detail}', 'postController@select');
}
?>