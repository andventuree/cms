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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return 'This is the about page';
});

Route::get('/example/{parameter}', function ($parameter) {

    return "This is the path /example/" . $parameter;
});

Route::get('/admin/post/example', array('as' => "admin.home", function () {
    //route() is a a global variable in laravel
    $url = route('admin.home'); # nickname or alias for the route
    // Can be used in our templates, for example: 
        //<a href={admin.home}>Admin Panel</a>
    return "this url is ". $url; 
    //remember that the . is string concatenation
}));