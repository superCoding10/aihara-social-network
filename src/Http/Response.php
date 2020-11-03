<?php
declare(strict_types=1);

namespace Aihara\Http;

use Aihara\View;
use function apache_response_headers;
class Response {

    private $headers = [];

    public function __construct() {
        if(function_exists('apache_response_headers')) {
            $this->headers = apache_response_headers();
        } else {
            $this->headers = headers_list();
        }
    }

    public function header(?string $name = null, ?string $value = null, ?int $code = 200)
    {
        # code...

        if($name && $value) {
            header("$name: $value", true, $code);
        } else if($name) {
            if(isset($this->headers[$name])) {
                return $this->headers[$name];
            }
            return false;
        }

        return $this->headers;
    }




    public function view(string $path, ?array $data = null)
    {
        # code...
        new View($path, $data);
    }

    public function json($data) {
        response()->header('Content-Type', 'application/json');
        echo json_encode($data);
    }



}