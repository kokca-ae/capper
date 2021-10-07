<?php

namespace app\models;

class Userreferal extends \app\base\Model {
    
    public $table = 'db_user_referal';
    
    public function getTotalReferalsLvl($usid, $l) {
        $field = 'referer' . $l . '_id';
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE {$field} = ?";
        return $this->findColumnBySql($sql, [$usid]);
    }
	
    public function getTotalActiveReferalsLvl($usid, $l) {
        $field = 'to_referer' . $l . ' > 0 AND referer' . $l . '_id';
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE {$field} = ?";
        return $this->findColumnBySql($sql, [$usid]);
    }
    
    public function getReferalsLvl($usid, $l, $lim, $on_page) {
        $field = 'referer' . $l . '_id';
        $sql = "SELECT db_user_data.date_reg, db_user_data.email, {$this->table}.* "
                . "FROM {$this->table} "
                . "LEFT JOIN db_user_data "
                . "ON db_user_data.id = {$this->table}.id "
                . "WHERE {$field} = ? "
                . "ORDER BY db_user_data.date_reg DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql, [$usid]);
    }
	
	//---
	public function getReferalsLvLnotLim($usid, $l) {
        $field = 'referer' . $l . '_id';
        $sql = "SELECT db_user_data.date_reg, db_user_data.email, {$this->table}.* "
                . "FROM {$this->table} "
                . "LEFT JOIN db_user_data "
                . "ON db_user_data.id = {$this->table}.id "
                . "WHERE {$field} = ? "
                . "ORDER BY db_user_data.date_reg DESC";
        return $this->findBySql($sql, [$usid]);
    }
    //---
	
    public function topReferers($lim = 7) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE all_count_refs <> 0 "
                . "ORDER BY all_from_referals DESC "
                . "LIMIT $lim";
        return $this->findBySql($sql);
    }
	public $table_users_data = 'db_user_data';
	public function referer($id) {
        $sql = "SELECT {$this->table_users_data}.id, {$this->table_users_data}.user, {$this->table}.*"
                . "FROM {$this->table}, {$this->table_users_data} "
				. "ON {$this->table_users_data}.id = {$this->table}.id "
                . "WHERE {$this->table_users_data}.id = {$id} "
                . "ORDER BY id DESC "
                . "LIMIT 1";
        return $this->findBySql($sql, [$usid]);
    }
    
}
