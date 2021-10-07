<?php

namespace app\modules;

abstract class Paysystems extends \app\base\Module {

    public function __construct() {
        $config_file = ROOT . '/config/paysystems/' . ucfirst($this->name) . '.cnf';
        if (file_exists($config_file)) {
            $this->payconfig = unserialize(file_get_contents($config_file));
            foreach ($this->fields as $k => $field) {
                $regex = $field['regex'];
                if (!isset($this->payconfig[$k])) {
                    $this->installed = false;
                    break;
                }
                if (!preg_match("$regex", $this->payconfig[$k])) {
                    $this->installed = false;
                    break;
                }
            }
        } else {
            $this->installed = false;
        }
    }
    
    public function config($post) {
        $result = [];
        foreach ($this->fields as $k => $field) {
            $regex = $field['regex'];
            if (!isset($post[$k])) {
                return ['error' => 1];
            }
            if (!preg_match("$regex", $post[$k])) {
                return ['error' => 1];
            }
            $result[$k] = $post[$k];
        }
        $config_file = ROOT . '/config/paysystems/' . ucfirst($this->name) . '.cnf';
        $data = serialize($result);
        
        $fp = fopen($config_file, "w");
        fwrite($fp, $data);
        fclose($fp);

        return ['error' => false];
    }

    public static function comment($login) {
        return "Payment to user $login from " . HOST;
    }
    
    public static function getSystem($ps) {
        $file = '\\app\\modules\\paysystems\\' . ucfirst($ps);
        if (class_exists($file)) {
            return new $file();
        }
        else {
            return false;
        }
    }
    
    public static function getSystems() {
        $dir = ROOT . '/app/modules/paysystems/';
        $result = scandir($dir);
        $return = [];
        foreach ($result as $file){
            $class_name = '\\app\\modules\\paysystems\\';
            $class_name .= preg_replace("~\.php~", '', $file);
            if (class_exists($class_name)) {
                $return[] = new $class_name();
            }
        }
        return $return;
    }

    abstract public function prepeareMerchant($insert_row);
    
    abstract public function doPayment($user_data, $amount, $purse);

}
