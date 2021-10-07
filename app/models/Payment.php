<?php

namespace app\models;

class Payment extends \app\base\Model {
    
    public $table = 'db_payment';
    
    public function getTotalUserPayments($usid) {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE user_id = ?";
        return $this->findColumnBySql($sql, [$usid]);
    }
    
    public function getUserPayments($usid, $lim, $on_page) {
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
	public function getLastPaymentsUser($usid, $lim = 7) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.user_id = ?"
                . "ORDER BY {$this->table}.date_add DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql, [$usid]);
    }
	
	public function getPaymentHistoryUser($usid, $lim = 7, $status) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
				. "WHERE {$this->table}.status = {$status} AND {$this->table}.user_id = ?"
                . "ORDER BY {$this->table}.date_add DESC "
				. "LIMIT {$lim}";
        return $this->findBySql($sql, [$usid]);
    }
	public function getTotalPaymentsPanel($status) {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE status = ?";
        return $this->findColumnBySql($sql, [$status]);
    }
	public function getUserPaymentsPanel($status, $lim, $on_page) {
        $sql = "SELECT {$this->table}.*, db_paysystems.fullname, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE status = ?"
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql, [$status]);
    }
	//---
    
    public function getTotalPayments() {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE status = 1";
        return $this->findColumnBySql($sql);
    }
    
    public function getPayments($lim, $on_page) {
        $sql = "SELECT {$this->table}.*, db_paysystems.fullname, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.status = 1 "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql);
    }
    
    public function lastPayments($lim = 7) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.status = 1 "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql);
    }
	
	public function UserlastPay($usid) {
        $sql = "SELECT {$this->table}.* "
                . "FROM {$this->table} "
                . "WHERE {$this->table}.user_id = {$usid} "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT 1";
        return $this->findBySql($sql);
    }
    public function getTotalPaymentsSys() {
        $sql = "SELECT db_paysystems.name, db_paysystems.currs, db_paysystems.fullname, SUM({$this->table}.sum) as amount FROM db_paysystems LEFT JOIN {$this->table} ON db_paysystems.name={$this->table}.payment_system WHERE {$this->table}.status =  '1' GROUP BY name";
        return $this->findBySql($sql);
    }
    
}
