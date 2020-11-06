<?php

use Aihara\database\DB;
use Aihara\database\Model;
use Aihara\Mail\Mail;
use Aihara\Routing\Router;
use Aihara\Validator;

Router::get('/', function() {
    $model = new Model('users', 'sss');
    $model->user_email = 'none';
    // $model->user_name = 'name';
    $model->save();
    // dd(DB::table('users')->findLast());

    response()->view('welcome', ['title' => 'Aihara social network']);
});

// namespace route;
Router::get('/register', function() {
    response()->view('auth/register', ['title' => 'Регистрация']);
    Mail::send('konyukkio@gmail.com', 'petr_konyuk@mail.ru');
})->name('register');

Router::post('/register', function() {
    $validator = new Validator([
        'user_name' => 'required',
        'user_email' => 'required|max:255',
        'user_password' => 'required|min:8',
        'user_password_repeat' => 'required|same:user_password'
    ]);
    if(!request()->isJson()) {
        if(!$validator->isValid()) {
            session('errors', $validator->getErrors(), true);
            session('input.user_name', request()->post('user_name'), true);
            session('input.user_email', request()->post('user_email'), true);
            response()->view('auth/register');
        }
    }
    dd($_SESSION);

})->middleware('recaptcha|csrf');

Router::get('/login', function() {
    response()->view('auth/login');
})->name('login');

Router::post('/login', function() {

})->middleware('csrf');


Router::get('/password_reset', function() {

});
Router::post('/password_reset', function() {

});
Router::get('/password_reset/{hash}', function() {

});
Router::post('/password_reset/{hash}', function() {

});






Router::get('/json', function() {



    // dd(session());

});