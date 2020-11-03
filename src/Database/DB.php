<?php 
declare(strict_types=1);

namespace Aihara\database;

use PDO;
use PDOException;
use InvalidArgumentException;
use function env;

class DB {

    protected static $db;

    public static function connection($config = []) {
        try {
            self::$db = new PDO(env('DB_CONNECTION') . ':dbname=' . env('DB_DATABASE') . ';host=' . env('DB_HOST') . ';port=' . env('DB_PORT'),
                env('DB_USERNAME'), env('DB_PASSWORD'),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
        } catch (PDOException $e) {
            if(request()->isJson()) {
                response()->json(['status' => 'failed', 'message' => 'Ошибка подключения. Попробуйте позже']);
            } else {
                session('db_error', 'Ошибка подключения. Попробуйте позже', true);
            }
        }
    }


    static public function schema(string $table, array $values)
    {
        # code...


        if(count($values) === 0) {
            throw new InvalidArgumentException('You must provide at least one column');
        }

        $query = 'CREATE TABLE ' . $table . '(';
        foreach($values as $key => $type) {
            if(array_key_first($values) !== $key) {
                $query .= ", $key $type";
            } else {
                $query .= "$key $type";
            }
        }
        $query .= ',created_at datetime, updated_at datetime )';

        try {
            //code...
        $res = self::$db->exec($query);

        } catch (\Throwable $th) {
            //throw $th;
            if(request()->isJson()) {
                response()->json(['status' => 'failed', 'message' => 'Ошибка подключения. Попробуйте позже']);
            } else {
                session('db_error', 'Ошибка подключения. Попробуйте позже', true);
            }
        }
        
        return $res;

    }

    static public function table(string $tableName) {
        return new QueryBuilder($tableName);
    }

}