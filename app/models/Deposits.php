<?php

namespace app\models;

class Deposits extends \app\base\Model {
    
    public $table = 'db_deposits';
    
    public function getTotalUserDeposits($usid) {
        $sql = "SELECT COUNT(*) FROM {$this->table} "
                . "WHERE user_id = ?";
        return $this->findColumnBySql($sql, [$usid]);
    }
    
    public function getUserDeposits($usid, $lim, $on_page) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} " 
                . "LEFT JOIN db_paysystems " 
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.user_id = ? "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql, [$usid]);
    }
	
    public function getUserDepositsAtType($usid, $status) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} " 
                . "LEFT JOIN db_paysystems " 
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.user_id = ? AND {$this->table}.status = $status "
                . "ORDER BY {$this->table}.id DESC ";
        return $this->findBySql($sql, [$usid]);
    }

    public function getDeposit($id) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} " 
                . "LEFT JOIN db_paysystems " 
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.id = ?";
        return $this->findRowBySql($sql, [$id]);
    }
	
    public function getDepositLimit($usid, $type) {
        $sql = "SELECT SUM(sum) "
                . "FROM {$this->table} "
                . "WHERE user_id = ? "
				. "AND payment_system = ? "
				. "AND status = 1 ";
        return $this->findBySql($sql, [$usid,$type]);
	}
    
    public function getDeposits($lim, $on_page) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql);
    }
    
    public function getCountActiveUserDeposits($usid) {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE user_id = ? "
                . "AND status = 1";
        return $this->findColumnBySql($sql, [$usid]);
    }
	
    /*
	// старый метод
    public function getDepositsToEarn($time) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE status = 1 "
                . "AND date_add + (plan_term * (count_earn + 1)) <= ?";
        return $this->findBySql($sql, [$time]);
    }
	*/
	
    public function getDepositsToEarn($time) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE status = 1 "
                . "AND date_upd <= ?";
        return $this->findBySql($sql, [$time]);
    }
    
    public function getCountActiveDeposits() {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE status = 1";
        return $this->findColumnBySql($sql);
    }
	
	// ---
	public function getDepositsToEarnOut($time) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE status = 2 "
                . "AND date_add + (plan_term * (count_earn + 1)) <= ?";
        return $this->findBySql($sql, [$time]);
    }
	
	public function updateDepOut($var1, $var2) {
		//$sum_earn = 
        $sql = "UPDATE {$this->table} SET plan_perc = ?, status = ?, count_earn = 1, sum_earn = sum_earn WHERE status = 2";
        $this->query($sql, [$var1, $var2]);
    }
	
    public function getCountOutDeposits() {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE status = 2";
        return $this->findColumnBySql($sql);
    }
	
    public function getOutDeposits($lim, $on_page) {
		 $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE status = 2 " // status 2 - статус ожидающий выставки процента за период
                . "ORDER BY date_add DESC "
                . "LIMIT {$lim}, {$on_page}";
		return $this->findBySql($sql);
    }
	// ---
	
	public function UserlastDep($usid) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE user_id = {$usid} "
                . "ORDER BY id DESC "
                . "LIMIT 1";
        return $this->findBySql($sql);
    }
    
}
