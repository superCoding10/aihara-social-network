<?php

namespace App\Http;


class UploadedFiles {

    private $filename;
    private $filesize;
    private $type;
    private $error;
    private $tmp_name;

    public function __construct($file) {

        $this->filename = $file['name'];
        $this->tmp_name = $file['tmp_name'];
        $this->filesize = $file['size'];
        $this->type = $file['type'];
        $this->error = $file['error'];
    }

    public function getName()
    {
        # code...

        return $this->filename;
    }

    public function getSize()
    {
        # code...

        return $this->filesize;
    }

    public function getType()
    {
        # code...

        return $this->type;
    }

    public function error()
    {
        # code...

        return $this->error;
    }

    public function getTmpName()
    {
        # code...

        return $this->tmp_name;
    }
}