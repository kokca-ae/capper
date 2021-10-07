<?php

namespace app\models;

class Userwallets extends \app\base\Model {
    
    public $table = 'db_user_wallets';
    
    public function getUserWallets($paysystems, $usid) {
        $wallets = [];
        $sql = "SELECT * FROM {$this->table} "
                . "WHERE user_id = ? "
                . "AND name = ?";
        foreach ($paysystems as $paysystem) {
            $arrgs = [$usid, $paysystem['name']];
            $wallet = $this->findRowBySql($sql, $arrgs);
            if ($wallet) {
                $wallets[$paysystem['name']] = $wallet['value'];
            }
            else {
                $wallets[$paysystem['name']] = false;
            }
        }
        return $wallets;
    }
    
    public function getUserWallet($usid, $ps) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "WHERE user_id = ? "
                . "AND name = ?";
        return $this->findRowBySql($sql, [$usid, $ps]);
    }
    
    public function deleteWallet($id) {
        $sql = "DELETE FROM {$this->table} "
                . "WHERE id = ?";
        $this->query($sql, [$id]);
    }
    
}
