<?php

namespace app\models;

class Multy extends \app\base\Model {
    
    public $table = 'db_user_data';
    
    public function MultyUser() {
       
        $qr = "ip IN (SELECT ip FROM {$this->table} GROUP BY ip HAVING COUNT(*) > 1)";
		$sql = "SELECT * FROM {$this->table} WHERE {$qr} ORDER BY ip";
        return $this->findBySql($sql);
    }
    
}

//"SELECT * FROM db_users_a WHERE ip IN (SELECT ip FROM db_users_a GROUP BY ip HAVING COUNT(*) > 1) AND banned = 0 ORDER BY ip ");