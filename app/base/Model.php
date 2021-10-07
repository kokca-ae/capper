<?php

namespace app\base;

abstract class Model{
    
    use F;
    
    protected $pdo;
    protected $table;
    protected $pk = 'id';

    public function __construct() {
        $this->pdo = Db::instance();
    }
    
    public function query($sql, $arrgs = []) {
        return $this->pdo->execute($sql, $arrgs);
    }
    
    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }
    
    public function findLastRows($lim = 20) {
        $sql = "SELECT * FROM {$this->table} "
                . "ORDER BY {$this->pk} DESC "
                . "LIMIT {$lim}";
        return $this->pdo->query($sql);
    }

    public function findOne($id, $field = '') {
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
        return $this->pdo->queryRow($sql, [$id]);
    }
    
    public function findBySql($sql, $params = []) {
        return $this->pdo->query($sql, $params);
    }
    
    public function findRowBySql($sql, $params = []) {
        return $this->pdo->queryRow($sql, $params);
    }
    
    public function findColumnBySql($sql, $params = []) {
        return $this->pdo->queryColumn($sql, $params);
    }
    
    public function getCount($id = '', $field = '') {
        if ($id) {
            $field = $field ?: $this->pk;
            $sql = "SELECT COUNT(*) FROM {$this->table} WHERE $field = ?";
            $arrgs = [$id];
        }
        else {
            $sql = "SELECT COUNT(*) FROM {$this->table}";
            $arrgs = [];
        }
        return $this->pdo->queryColumn($sql, $arrgs);
    }
    
    public function updateRow($fields, $id, $field = 'id') {
        $sql = "UPDATE {$this->table} SET ";
        $arrgs = [];
        foreach ($fields as $key => $value) {
            $sql .= "$key = ?,";
            $arrgs[] = $value;
        }
        $sql = substr($sql, 0, -1);
        $sql .= " WHERE $field = ?";
        $arrgs[] = $id;
        $this->pdo->execute($sql, $arrgs);
    }
    
    public function insertRow($fields) {
        $sql = "INSERT INTO {$this->table} ";
        $_fields = '(';
        $_values = '(';
        $arrgs = [];
        foreach ($fields as $key => $value) {
            $_fields .= $key . ',';
            $_values .= '?,';
            $arrgs[] = $value;
        }
        $_fields = substr($_fields, 0, -1) . ')';
        $_values = substr($_values, 0, -1) . ')';
        $sql .= $_fields . ' VALUES ' . $_values;
        return $this->pdo->insert($sql, $arrgs);
    }
    
    public function insertRows($fields) {
        $sql = "INSERT INTO {$this->table} ";
        $_fields = '(';
        $_values = '';
        $arrgs = [];
        foreach ($fields as $key => $row) {
            foreach ($row as $field => $value) {
                $_fields .= $field . ',';
            }
            break;
        }
        $_fields = substr($_fields, 0, -1) . ')';
        foreach ($fields as $key => $row) {
            $_values .= '(' . substr(str_repeat('?,', count($row)), 0, -1) . '),';
            foreach ($row as $value) {
                $arrgs[] = $value;
            }
             
        }        
        $_values = substr($_values, 0, -1);
        $sql .= $_fields . ' VALUES ' . $_values;
        $this->pdo->execute($sql, $arrgs);
    }
    
}
