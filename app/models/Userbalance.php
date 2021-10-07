<?php

namespace app\models;

class Userbalance extends \app\base\Model {
    
    public $table = 'db_user_balance';
    
    public function getMoneySum($field) {
        $sql = "SELECT SUM({$field}) FROM {$this->table}";
        return $this->findColumnBySql($sql);
    }
    
    public function getTotalInsertSum() {
        $sql = "SELECT SUM(insert_sum) FROM {$this->table}";
        return $this->findColumnBySql($sql);
    }
    
    public function getTotalReinsertSum() {
        $sql = "SELECT SUM(reinsert_sum) FROM {$this->table}";
        return $this->findColumnBySql($sql);
    }
    
    public function getTotalPaymentSum() {
        $sql = "SELECT SUM(payment_sum) FROM {$this->table}";
        return $this->findColumnBySql($sql);
    }
    
    public function addBalanceField($field) {
        $sql = "ALTER TABLE {$this->table} "
                . "ADD {$field} "
                . "DOUBLE "
                . "NOT NULL "
                . "DEFAULT '0'";
        return $this->query($sql);
    }
    
	public $table_users_data = 'db_user_data';
	
	public function topInvest($lim = 7) {
        $sql = "SELECT * "
                . "FROM {$this->table}, {$this->table_users_data} "
                . "WHERE {$this->table}.id = {$this->table_users_data}.id AND {$this->table}.insert_sum <> 0 "
                . "ORDER BY insert_sum DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql);
    }
}
