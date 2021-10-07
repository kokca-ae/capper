<?php

namespace app\models;

class Paysystems extends \app\base\Model {
    
    public $table = 'db_paysystems';
    
    public function getActiveSystems () {
        $sql = "SELECT * FROM {$this->table} WHERE active = 1";
        return $this->findBySql($sql);
    }
	
    public function getNeedSystem ($type) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE name = ? AND active = 1";
        return $this->findBySql($sql, [$type]);
    }
    
    public function getPs ($lim, $on_page) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "ORDER BY id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql);
    }
}
