<?php

namespace Aihara;

use InvalidArgumentException;

class Validator {

    private $errors = [];
    private $err_messages;
    function __construct($validation_arr, $err_messages = []) {
        $this->err_messages = $err_messages;
        foreach($validation_arr as $req_par_name => $validation_types) {
            foreach(explode('|', $validation_types) as $validation_type) {
                $method_and_param = explode(':', $validation_type);
                
                if(isset($method_and_param[1])) {
                    // if($this->errorExists($method_and_param[1])) {
                    // break;
                    // }
                    $this->{$method_and_param[0]}($req_par_name, $method_and_param[1]);
                } else {
                    $this->{$method_and_param[0]}($req_par_name);
                }
                // if(!$this->isValid()) {
                //     break;
                // }
                
                
            }
        }
    }
    
    private function errorExists($name) {
        return isset($this->errors[$name]);
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
        if(!isset($this->errors[$name])) {
            $this->errors[$name] = $this->err_messages[$name] ?? config('validation.' . $name . '.' . $type);
        }
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
        if(strlen($value) > $max) {
            $this->addError($req_par_name, __FUNCTION__);
        }
    }
    
    function min($req_par_name, $min = 8) {
        $value = $_POST[$req_par_name] ?? $_GET[$req_par_name];
        if(!isset($value)) {
            throw new InvalidArgumentException('Parameter ' . $req_par_name . ' not found');
        }
        if(strlen($value) < $min) {
            $this->addError($req_par_name, __FUNCTION__);
        }
    }
    
    function email($req_par_name) {
        $value = $_POST[$req_par_name] ?? $_GET[$req_par_name];
        if(!isset($value)) {
            throw new InvalidArgumentException('Parameter ' . $req_par_name . ' not found');
        }

        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($req_par_name, __FUNCTION__);
        }
    }

    function same($req_par_name, $req_par_name2) {
        $value1 = $_POST[$req_par_name] ?? $_GET[$req_par_name];
        $value2 = $_POST[$req_par_name2] ?? $_GET[$req_par_name2];
        if(!isset($value1)) {
            throw new InvalidArgumentException('Parameter ' . $req_par_name . ' not found');
        }
        if(!isset($value1)) {
            throw new InvalidArgumentException('Parameter ' . $req_par_name2 . ' not found');
        }

        if($value1 !== $value2) {
            $this->addError($req_par_name, __FUNCTION__);
        }
    }

}

