<?php
namespace Aihara\database;
use Aihara\database\DB;
class Model {
    private $table;
    public function __construct($table, $arg) {
        $this->table = $table;
        if(is_array($arg)) {
            DB::table($table)->insert($arg);
            $this->model = DB::table('users')->findLast();
            foreach($this->model as $key => $value) {
                $this->$key = $value;
            }
        } else if(is_int($arg)) {
            $this->model = DB::table($table)->where('user_id', $arg)->select('*')->takeAll()[0];
            foreach($this->model as $key => $value) {
                $this->$key = $value;
            }
        } else if(is_string($arg)) {
            $this->model = DB::table($table)->where('user_email', $arg)->select('*')->takeAll()[0];
            foreach($this->model as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function save() {
        // return get_object_vars($this);
        dd(array_filter(get_object_vars($this), function($key) {
            return $key !== 'table' && $key !== 'model';
        }, ARRAY_FILTER_USE_KEY));
        DB::table($this->table)->where('user_id', (string) $this->user_id)->update(array_filter(get_object_vars($this), function($value, $key) {
            return $key !== 'table' && $key !== 'model' && $value && $key !== 'user_id' && $key !== 'created_at';
        }, ARRAY_FILTER_USE_BOTH));
    }
}