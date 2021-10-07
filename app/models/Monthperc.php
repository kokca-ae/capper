<?php

namespace app\models;

class Monthperc extends \app\base\Model {
    
    public $table = 'db_percmonth';
    
    public function period($lim = 12) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "ORDER BY id DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql);
    }
    
}
