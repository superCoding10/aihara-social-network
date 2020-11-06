<?php
namespace App\Middleware;
class RecaptchaMiddleware {
    public function handle()
    {
        # code...

        $result = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcYq94ZAAAAAG6Vi2MyF0h8tE3yWUwDgROxcG4k&response=' . $_POST['g-recaptcha-response']));
        if(!$result->success || $result->score < 0.6 || $result->action !== 'submit') {
            header('Location: ' . url('domain') . '/register');
            exit;
        }
    }
}