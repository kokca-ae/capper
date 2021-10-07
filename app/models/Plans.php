<?php

namespace app\models;

class Plans extends \app\base\Model {
    
    public $table = 'db_plans';
    
    public function getPlans($lim, $on_page) {
        $sql = "SELECT * "
                . "FROM {$this->table} "
                . "ORDER BY id DESC "
                . "LIMIT {$lim}, {$on_page}";
        return $this->findBySql($sql);
    }
    
    public function deletePlan($id) {
        $sql = "DELETE "
                . "FROM {$this->table} "
                . "WHERE id = ?";
        return $this->query($sql, [$id]);
    }
    
}
