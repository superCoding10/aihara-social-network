<?php

namespace Aihara;

use InvalidArgumentException;

class Validator {

    private $errors = [];
    private $err_messages;
    function __construct($validation_arr, $err_messages) {
        $this->err_messages = $err_messages;
        foreach($validation_arr as $req_par_name => $validation_types) {
            foreach(explode('|', $validation_types) as $validation_type) {
                $method_and_param = explode(':', $validation_type);
                
                if(isset($method_and_param[1])) {
                    $this->{$method_and_param[0]}($req_par_name, $method_and_param[1]);
                } else {
                    $this->{$method_and_param[0]}($req_par_name);
                }
                if(!$this->isValid()) {
                    return;
                }
                
            }
        }
    }
    
    public function getErrors()
    {
        # code...

        return $this->errors;
    }

    public function isValid()
    {
        # code...

        return empty($this->errors);
    }

    private function addError($name, $type)
    {
        # code...

        $this->errors[$name][$type] = $this->err_messages[$name][$type];
    }

    function required($req_par_name) {
        $value = $_POST[$req_par_name] ?? $_GET[$req_par_name];
        if(!isset($value)) {
            throw new InvalidArgumentException('Parameter ' . $req_par_name . ' not found');
        }
        if(strlen($value) < 1) {
            $this->addError($req_par_name, __FUNCTION__);
        }
    }
    
    function max($req_par_name, $max = 255) {
        $value = $_POST[$req_par_name] ?? $_GET[$req_par_name];
        if(!isset($value)) {
            throw new InvalidArgumentException('Parameter ' . $req_par_name . ' not found');
        }
        if($value > $max) {
            $this->addError($req_par_name, __FUNCTION__);
        }
    }
    
    function min($req_par_name, $min = 8) {
        $value = $_POST[$req_par_name] ?? $_GET[$req_par_name];
        if(!isset($value)) {
            throw new InvalidArgumentException('Parameter ' . $req_par_name . ' not found');
        }
        if($value < $min) {
            $this->addError($req_par_name, __FUNCTION__);
        }
    }
}

