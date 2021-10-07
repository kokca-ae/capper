<?php

namespace app\models;

class Earn extends \app\base\Model {
    
    public $table = 'db_earn';
    
    public function getTotalUserEarns($usid) {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE user_id = ?";
        return $this->findColumnBySql($sql, [$usid]);
    }
    
    public function getUserEarns($usid, $lim, $on_page) {
        $sql = "SELECT {$this->table}.*, db_paysystems.fullname, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.user_id = ? "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql, [$usid]);
    }
	
	//---
	public function getLastEarnsUser($usid, $lim = 7) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.user_id = ?"
                . "ORDER BY {$this->table}.date_add DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql, [$usid]);
    }
	
	public function getEarnHistoryUser($usid, $lim = 7, $type) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
				. "WHERE {$this->table}.type = {$type} AND {$this->table}.user_id = ?"
                . "ORDER BY {$this->table}.date_add DESC "
				. "LIMIT {$lim}";
        return $this->findBySql($sql, [$usid]);
    }
	//---
    
    public function getTotalEarns() {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table}";
        return $this->findColumnBySql($sql);
    }
    
    public function getEarns($lim, $on_page) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql);
    }

    public function clean($need = 604800) {
        $sql = "DELETE FROM {$this->table} WHERE date_add < ?";
        return $this->query($sql, [$need]);
    }
	
	public function getSumUserEarns($usid) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE user_id = {$usid}";
        return $this->findBySql($sql);
    }
	
	public function getSumUserEarnsNotRefback($usid) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE user_id = {$usid} AND type != 3";
        return $this->findBySql($sql);
    }
	
	public function getSumUserEarnsRefbackOnly($usid) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE user_id = {$usid} AND type = 3";
        return $this->findBySql($sql);
    }
    
}
