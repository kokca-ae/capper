<?php

namespace app\models;

class News extends \app\base\Model {
    
    public $table = 'db_news';
    
    public function getNewsAtId($id) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE id = $id ";
        return $this->findBySql($sql);
    }
	
    public function lastNews($lim = 7) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE status = 1 "
                . "ORDER BY date_add DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql);
    }
	
	public function getCountNews($type) {
        $sql = "SELECT COUNT(*) FROM {$this->table} "
                . "WHERE status = ?";
        return $this->findColumnBySql($sql, [$type]);
    }
	
    public function getNews($type, $lim, $on_page) {
		$sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE status = ?" // status 1 - активные новости
                . "ORDER BY date_add DESC "
                . "LIMIT {$lim}, {$on_page}";
		return $this->findBySql($sql, [$type]);
    }
    
}
