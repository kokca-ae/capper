<?php

namespace app\models;

class Userdata extends \app\base\Model {
    
    public $table = 'db_user_data';
    
    public function getNewUsers($period = '86400') {
        $need = time() - 86400;
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE date_reg > {$need}";
        return $this->findColumnBySql($sql);
    }
    
    public function getOnlineUsers($need) {
        $sql = "SELECT id, user, banned_chat, roots "
                . "FROM {$this->table} "
                . "WHERE last_active > ?";
        return $this->findBySql($sql, [$need]);
    }
    
    public function getUsers($lim, $on_page) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "LEFT JOIN db_user_balance "
                . "ON db_user_balance.id = {$this->table}.id "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql);
    }
	
    public function getUserRefback($usid) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE id = {$usid} "
                . "ORDER BY id DESC "
                . "LIMIT 1";
        return $this->findBySql($sql);
    }
	//SELECT * FROM db_user_data LEFT JOIN db_user_balance ON db_user_balance.id = db_user_data.id ORDER BY db_user_data.id DESC LIMIT 2, 2
    
	public function panelROOT($usid) { // получение значения админ прав для текущего акка (админ или нет) нужно для вывода кнопки на админку
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE id = {$usid} "
                . "ORDER BY id DESC "
                . "LIMIT 1";
        return $this->findBySql($sql);
    }
	/*
    public function getUsersPlus($lim, $on_page) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "LEFT JOIN {$this->table} "
                . "ON db_user_balance.id = {$this->table}.id "
                . "ORDER BY {$this->table}.id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql);
    }*/
	/*
    public function getUserAllHistory($usid, $lim, $on_page) {
		LEFT JOIN Realty_peoples ON Peoples.id = Realty_peoples.id_peoples;
		$sql = "SELECT * FROM db_payment, db_insert, db_earn LEFT JOIN db_insert ON db_insert.user_id = db_earn.user_id = db_payment.user_id = ?"
	*/
        /*$sql = "SELECT db_payment.*, db_insert.*, db_earn.*, db_paysystems.fullname, db_paysystems.format "
                . "FROM db_payment, db_insert, db_earn "
                . "LEFT JOIN db_paysystems "
                . "ON db_paysystems.name = {$this->table}.payment_system "
                . "WHERE {$this->table}.user_id = ? "
                . "ORDER BY id DESC "
                . "LIMIT {$lim}, {$on_page}";*/
/*        return $this->findBySql($sql, [$usid]);
    }
	
SELECT `db_payment`.*
FROM `db_payment` 
LEFT JOIN `db_insert` ON `db_insert`.`user_id`=`db_payment`.`user_id` 
LEFT JOIN  `db_earn`  ON `db_earn`.`user_id`=`db_insert`.`user_id`
GROUP BY `user_id`
ORDER BY `date_add` DESC;
	*/
}
