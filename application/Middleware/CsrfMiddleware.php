<?php
namespace App\Middleware;
class CsrfMiddleware {
    public function handle()
    {
        # code...
        echo 'csrf';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(empty(request()->post('csrf_token'))) {
                echo '<h3 style="color: red;">Seem like you have forgotten to include your csrf token in your form</h3>';
                exit;
            }

            if(! hash_equals(request()->post('csrf_token'), session('csrf_token'))) {
                header('HTTP/1.1 403 Forbidden', true, 403);
                response()->view('403');
                exit;
            }
        }
        
    }
}