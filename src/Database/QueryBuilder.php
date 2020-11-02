<?php

namespace App\Database;

use PDO;
use Throwable;
use InvalidArgumentException;


class QueryBuilder extends DB {

    protected $tableName = '';
    protected $query = '';
    protected $whereClause = '';
    protected $stmt;
    protected $placeholders = [];
    protected $arg = 1;
    protected $limit = '';
    protected $orderBy = '';
    public function __construct(string $tableName) {
        $this->tableName = $tableName;
    }

    public function insert(array $values, array $placeholders = []): void
    {
        # code...
        // convert :placeholder to placeholder\
        $placeholders = array_merge($this->placeholders, $placeholders);
        foreach($placeholders as $key => $value) {
            if(is_string($key)) {
                unset($placeholders[$key]);
                $placeholders[':' . $key] = $value;
            }
        }
        
        $query = "INSERT INTO $this->tableName ( ";
        foreach($values as $key => $value) {
            if(array_key_first($values) === $key) {
                $query .= $key;
            } else {
                $query .= ", $value";
            }
        }

        $query .= ' ) VALUES ( ';
        foreach($values as $key => $value) {
            if(array_key_first($values) === $key) {
                $query .= ":" . preg_replace('/["\']/', '', $value);
                $placeholders[":" .  preg_replace('/["\']/', '', $value)] = $value;
            } else {
                $query .= ", :" . preg_replace('/["\']/', '', $value);
                $placeholders[":" .  preg_replace('/["\']/', '', $value)] = $value;
            }
        }

        $query .= ' )';


        $stmt = self::$db->prepare($query, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        try {
            //code...
           $stmt->execute($placeholders);

        } catch (\Throwable $th) {
            //throw $th;
            if(request()->isJson()) {
                response()->json(['status' => 'failed', 'message' => 'Ошибка подключения. Попробуйте позже']);
            } else {
                session('db_error', 'Ошибка подключения. Попробуйте позже', true);
            }
        }

    }

    public function update(array $values, array $placeholders = []): void
    {
        # code...
        $placeholders = array_merge($this->placeholders, $placeholders);
        $this->query .= "UPDATE $this->tableName SET ";

        foreach($values as $key => $value) {
            if(array_key_first($values) === $key) {
                $this->query .= "$key = :" . preg_replace('/["\']/', '', $value);
                $placeholders[":" .  preg_replace('/["\']/', '', $value)] = $value;
            } else {
                $this->query .= ", $key = :" . preg_replace('/["\']/', '', $value);
                $placeholders[":" .  preg_replace('/["\']/', '', $value)] = $value;
            }
        }

        $this->query .= ' ' . $this->whereClause;
        try {
            $stmt = self::$db->prepare($this->query);
            //code...

        } catch (Throwable $e) {
            //throw $th;
            if(request()->isJson()) {
                response()->json(['status' => 'failed', 'message' => 'Ошибка подключения. Попробуйте позже']);
            } else {
                session('db_error', 'Ошибка подключения. Попробуйте позже', true);
            }
        }
        $stmt->execute($placeholders);

    }

    public function delete(): void
    {
        # code...

        $this->query = "DELETE FROM $this->tableName $this->whereClause";
        try {
            $stmt = self::$db->prepare($this->query);
            //code...

        } catch (Throwable $e) {
            //throw $th;
            if(request()->isJson()) {
                response()->json(['status' => 'failed', 'message' => 'Ошибка подключения. Попробуйте позже']);
            } else {
                session('db_error', 'Ошибка подключения. Попробуйте позже', true);
            }
        }
        $stmt->execute();

    }

    public function select($fields, $placeholders = [])
    {
        # code...
        // SELECT * FROM users WHERE id = :id


        $placeholders = array_merge($this->placeholders, $placeholders);

        foreach($placeholders as $key => $value) {
            if($key[0] !== ':') {
                unset($placeholders[$key]);
                $placeholders[':' . $key] = $value;
            }
        }

 
        $this->query .= "SELECT $fields FROM $this->tableName " . $this->whereClause . $this->orderBy . $this->limit;
        

        try {
            $stmt = self::$db->prepare($this->query);
            //code...

        } catch (Throwable $e) {
            //throw $th;
            if(request()->isJson()) {
                response()->json(['status' => 'failed', 'message' => 'Ошибка подключения. Попробуйте позже']);
            } else {
                session('db_error', 'Ошибка подключения. Попробуйте позже', true);
            }
        }
        $stmt->execute($placeholders);
        $this->stmt = $stmt;
        return $this;

    }

    public function where(string $key, string $valueOrOperator, string $value = null): QueryBuilder
    {
        # code...

        $operators = ['<', '=', '>'];

        if($value !== null && ! in_array($valueOrOperator, $operators)) {
            throw new InvalidArgumentException('Invalid operator provided; Expected: <, = or >');
        }

        if($value === null) {
            $this->whereClause .= "WHERE $key = :arg" . $this->arg;
        } else {
            $this->whereClause .= "WHERE $key $valueOrOperator :arg" . $this->arg;
        }

        $this->placeholders[':' . 'arg'  . $this->arg] = $valueOrOperator;
        $this->arg++;

        return $this;

    }

    public function orWhere(string $key, string $valueOrOperator, string $value = null): QueryBuilder
    {
        # code...
        $operators = ['<', '=', '>'];

        if($value !== null && ! in_array($valueOrOperator, $operators)) {
            throw new InvalidArgumentException('Invalid operator provided; Expected: <, = or >');
        }

        if($value === null) {
            $this->whereClause .= " OR $key = $valueOrOperator";
        } else {
            $this->whereClause .= " OR $key $valueOrOperator $value";
        }

        return $this;


    }


    public function andWhere(string $key, string $valueOrOperator, string $value = null): QueryBuilder
    {
        # code...
        $operators = ['<', '=', '>'];

        if($value !== null && ! in_array($valueOrOperator, $operators)) {
            throw new InvalidArgumentException('Invalid operator provided; Expected: <, = or >');
        }

        if($value === null) {
            $this->whereClause .= " OR $key = :arg" . $this->arg;
        } else {
            $this->whereClause .= " OR $key $valueOrOperator :arg" . $this->arg;
        }

        $this->placeholders[':' . 'arg'  . $this->arg] = $valueOrOperator;
        $this->arg++;

        return $this;

    }

    public function like(string $value, string $clause)
    {
        # code...

        $this->whereClause .= " WHERE $value LIKE '$clause'";
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): QueryBuilder
    {
        # code...

        $this->orderBy = "ORDER BY $column $direction";

        return $this;
    }

    public function limit(int $limit): QueryBuilder
    {
        # code...
        $this->limit = 'LIMIT ' . $limit . ' ';

        return $this;


    }

    public function take(int $take = null)
    {
        # code...

        $result = [];
        if(is_null($take)) {
            return $this->stmt->fetch();
        }

        for($i = 0; $i < $take; $i++) {
            $result[$i] = $this->stmt->fetch();
        }
        return array_filter($result, function($value) {
            return $value !== false;
        });

    }

    public function takeAll()
    {
        # code...

        return $this->stmt->fetchAll();
    }




}