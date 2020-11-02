<?php

use App\Routing\Router;

dd($_COOKIE);
dd(session());
Router::post('/', function() {
});
Router::get('/', function() {
    
});

// namespace route;
Router::get('/register', function() {
    
});
Router::post('/register', function() {

})->add('csrf');

Router::get('/login', function() {

});
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