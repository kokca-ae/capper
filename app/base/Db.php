<?php

namespace app\base;

class Db {
    
    protected $pdo;
    protected static $instance;
    
    protected function __construct() {
        $db = require ROOT . '/config/config_db.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['password'], $options);

       

    }
    
    public static function instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function execute($sql, $arrgs = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($arrgs);
    }
    
    public function insert($sql, $arrgs = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($arrgs);
        return $this->pdo->lastInsertId();
    }
    
    public function query($sql, $arrgs = []) {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($arrgs);
        if ($result !== false) {
            $result = $stmt->fetchAll();
            if(count($result)){
                return $result;
            }
            return false;
        }
        return false;
    }

    public function queryRow($sql, $arrgs = []) {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($arrgs);
        if ($result !== false) {
            $result = $stmt->fetch();
            if(count($result)){
                return $result;
            }
            return false;
        }
        return false;
    }
    
    public function queryColumn($sql, $arrgs = []) {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($arrgs);
        return $stmt->fetchColumn();
    }

}
