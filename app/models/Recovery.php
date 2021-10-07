<?php

namespace app\models;

class Recovery extends \app\base\Model {
    
    public $table = 'db_recovery';
    
    public function getLastUserRow($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        return $this->findRowBySql($sql, [$email]);
    }
    
    public function getRow($key) {
        $sql = "SELECT * FROM {$this->table} "
                . "WHERE _key = ? "
                . "ORDER BY date_add DESC "
                . "LIMIT 1";
        return $this->findRowBySql($sql, [$key]);
    }

    public function clean($need = 604800) {
        $sql = "DELETE FROM {$this->table} WHERE date_add < ?";
        return $this->query($sql, [$need]);
    }
    
}
