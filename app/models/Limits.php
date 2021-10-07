<?php

namespace app\models;

class Limits extends \app\base\Model {
    
    public $table = 'db_limits';
    
    public function getLimits($lim = 1) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "ORDER BY id DESC "
                . "LIMIT {$lim}";
        return $this->findBySql($sql);
    }
	
	public function updateCurrs($a,$b,$id=1) {
		$sql = "UPDATE {$this->table} SET $a = '$b' WHERE id = ?";
        $this->query($sql, [$id]);
    }

}
