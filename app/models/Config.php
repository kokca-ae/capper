<?php

namespace app\models;

class Config extends \app\base\Model {
    
    public $table = 'db_config';
    
    public function getConfig() {
        $config = $this->findAll();
        $result = [];
        foreach ($config as $row) {
            $result[$row['name']] = $row['value'];
        }
        return $result;
    }
    
    public function updateOneOption($option, $value) {
        $sql = "UPDATE {$this->table} SET value = ? WHERE name = ?";
        $this->query($sql, [$value, $option]);
    }
    
    private function getSettingsKeys() {
        $keys = array();
        $sql = "SELECT id, name FROM {$this->table}";
        $result = $this->findBySql($sql);
        foreach ($result as $row) {
            $keys[$row['name']] = $row['id'];
        }
        return $keys;
    }
    
    public function updateOptions($options) {
        $keys = $this->getSettingsKeys();
        $sql = "INSERT INTO {$this->table} (id, value) VALUES ";
        
        $arrgs = [];
        foreach ($options as $key => $value) {
            $sql .= '(' . $keys[$key] . ', ?), ';
            $arrgs[] = $value;
        }
        
        $sql = substr($sql, 0, -2);
        $sql .= ' ON DUPLICATE KEY UPDATE value = VALUES (value)';
        $this->query($sql, $arrgs);
    }

}
