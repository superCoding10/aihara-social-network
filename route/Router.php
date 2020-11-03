<?php
use Aihara\Routing\Router;

Router::get('/', function() {
    response()->view('welcome', ['title' => 'Aihara social network']);
});

// namespace route;
Router::get('/register', function() {
    response()->view('auth/register', ['title' => 'Регистрация']);
})->name('register')->middleware('nostr');

Router::post('/register', function() {
    // echo 'register post';
});

// Router::get('/login', function() {
//     response()->view('auth/login');
// })->name('login')->middleware('csrf');

Router::post('/login', function() {

});
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