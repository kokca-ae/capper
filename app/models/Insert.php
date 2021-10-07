<?php

namespace app\models;

class Insert extends \app\base\Model {
    
    public $table = 'db_insert';
    
    public function getTotalUserInserts($usid) {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE user_id = ?";
        return $this->findColumnBySql($sql, [$usid]);
    }
    
    public function getUserInserts($usid, $lim, $on_page) {
        $sql = "SELECT {$this->table}.*, db_paysystems.fullname, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE user_id = ? "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql, [$usid]);
    }
	
	//---
	public function getLastInsertsUser($usid, $lim = 7) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.user_id = ?"
                . "ORDER BY {$this->table}.date_add DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql, [$usid]);
    }
	
	public function getInsertHistoryUser($usid, $lim = 7, $status) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
				. "WHERE {$this->table}.status = {$status} AND {$this->table}.user_id = ?"
                . "ORDER BY {$this->table}.date_add DESC "
				. "LIMIT {$lim}";
        return $this->findBySql($sql, [$usid]);
    }
	public function getTotalInsertsPanel($status) {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE status = ? AND oper_id != 0 ";
        return $this->findColumnBySql($sql, [$status]);
    }
	public function getUserInsertsPanel($status, $lim, $on_page) {
        $sql = "SELECT {$this->table}.*, db_paysystems.fullname, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE status = ? AND oper_id != 0 "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql, [$status]);
    }
	//---
    
    public function getTotalInserts() {
        $sql = "SELECT COUNT(*) "
                . "FROM {$this->table} "
                . "WHERE status = 1";
        return $this->findColumnBySql($sql);
    }
	
    public function getTotalInsertsSys() {
        $sql = "SELECT db_paysystems.name, db_paysystems.currs, db_paysystems.fullname, SUM({$this->table}.sum) as amount FROM db_paysystems LEFT JOIN {$this->table} ON db_paysystems.name={$this->table}.payment_system WHERE {$this->table}.status =  '1' GROUP BY name";
        return $this->findBySql($sql);
    }
    public function getSumInsertsSys($sys) {
        $sql = "SELECT (SELECT SUM(sum) FROM db_insert WHERE status = 1 AND payment_system = $sys) amount";
        return $this->findBySql($sql);
    }
	
	//SELECT (SELECT SUM(sum) FROM {$this->table} WHERE status = 1 AND payment_system = ?) oper"
	//SELECT db_insert.*, db_paysystems.fullname, db_paysystems.format FROM db_insert LEFT JOIN db_paysystems ON db_paysystems.name = db_insert.payment_system WHERE payment_system='pm' AND status=1,
	//SELECT db_paysystems.name, db_paysystems.currs, SUM(db_insert.sum) as amount FROM db_paysystems LEFT JOIN db_insert ON db_paysystems.name=db_insert.payment_system WHERE db_insert.status =  '1' GROUP BY name
    
    public function getInserts($lim, $on_page) {
        $sql = "SELECT {$this->table}.*, db_paysystems.fullname, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.status = 1 "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql);
    }
    
    public function lastInserts($lim = 7) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.status = 1 "
                . "ORDER BY {$this->table}.date_add DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql);
    }
    
    public function getInsertRow($id) {
        $sql = "SELECT {$this->table}.*, db_paysystems.format "
                . "FROM {$this->table} "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.id = ?";
        return $this->findRowBySql($sql, [$id]);
    }

    public function clean($need = 604800) {
        $sql = "DELETE FROM {$this->table} WHERE date_add < ? AND status <> 1";
        return $this->query($sql, [$need]);
    }
    
    
}
