<?php
declare(strict_types=1);

namespace App\Http;


class Request {

    private $headers = [];
    private $get = [];
    private $post = [];
    private $cookie = [];
    private $files = [];

    public function __construct() {
        $this->headers = apache_request_headers();
        $this->cookie = $_COOKIE;
        $this->get = $_GET;
        $this->post = $_POST;

        if(count($_FILES) > 0) {
            foreach($_FILES as $filename => $file) {
                $this->files[$filename] = new UploadedFiles($file);
            }
        }

    }

    public function get(?string $name = null)
    {
        # code...

        if($name) {
            if(isset($this->get[$name])) {
                return $this->get[$name];
            }
            return false;
        }

        return $this->get;

    }

    public function post(?string $name = null)
    {
        # code...

        if($name) {
            if(isset($this->post[$name])) {
                return $this->post[$name];
            }
            return false;
        }

        return $this->post;

    }

    public function header(?string $name = null)
    {
        # code...

        if($name) {
            if(isset($this->headers[$name])) {
                return $this->headers[$name];
            }
            return false;
        }

        return $this->headers;
    }

    public function cookie(?string $name = null)
    {
        # code...

        if($name) {
            if(isset($this->cookie[$name])) {
                return $this->cookie[$name];
            }
            return false;
        }

        return $this->cookie;
    }

    public function getUploadedFiles(?string $name = null)
    {
        # code...

        if($name) {
            if(isset($this->files[$name])) {
                return $this->files[$name];
            }
            return false;
        }

        return $this->files;
    }


    public function isJson()
    {
        # code...
        if(!empty(request()->header('Content-Type'))) {
            return preg_match('/json/', request()->header('Content-Type'));
        }

        return false;

    }
}