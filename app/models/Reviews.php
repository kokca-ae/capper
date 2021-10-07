<?php

namespace app\models;

class Reviews extends \app\base\Model {
    
    public $table = 'db_reviews';
    
    public function lastReviews($type, $lim = 7) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE type = $type AND status = 1 "
                . "ORDER BY date_add DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql);
    }
	
	public function getReviews($type) {
        $sql = "SELECT COUNT(*) FROM {$this->table} "
                . "WHERE status = ?";
        return $this->findColumnBySql($sql, [$type]);
    }
	
    public function getNotAcceptReviews($lim, $on_page) {
		 $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE status = 0 " // status 0 - статус ожидающий модерации
                . "ORDER BY date_add DESC "
                . "LIMIT {$lim}, {$on_page}";
		return $this->findBySql($sql);
    }
	
	public function getUserReviews($usid, $type) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE type = {$type} AND user_id = ?";
        return $this->findBySql($sql, [$usid]);
    }
    
}
