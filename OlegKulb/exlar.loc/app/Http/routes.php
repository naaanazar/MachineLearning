<?php

Route::get('/', function () {
    return 'Hello World';
});

Route::get('doit', function () {
    return 'you can do it!! Just do it!';
});

Route::get('first',[
    'as' => 'firsRoure', 'uses' => 'BaseController@home'
]);

//Route::get('/', [
//    'as' => 'home', 'uses' => 'BaseController@home'
//]);


