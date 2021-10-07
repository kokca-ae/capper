<?php

namespace app\models;

class Search extends \app\base\Model {
    
    public $table = 'db_user_data';
    
    public function SearchUser($id,$login,$email) {
		
		if(!empty($id)){
			$qr="id LIKE '%$id%'";
		}elseif(!empty($login)){
			$qr="user LIKE '%$login%'";
		}elseif(!empty($email)){
			$qr="email LIKE '%$email%'";
		}
		
       
        $sql = "SELECT * FROM {$this->table} WHERE {$qr} LIMIT 1";
        return $this->findBySql($sql);
    }
    
}
