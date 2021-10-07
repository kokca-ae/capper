<?php

namespace app\modules;

class Sender extends \vendor\PHPMailer\PHPMailer {
    
    use \app\base\F;

    public function __construct() {
        parent::__construct();
        
        $params = require ROOT . '/config/config_smtp.php';

        // $this->SMTPDebug = 4;
                
        $this->isSMTP();
        $this->SMTPAuth = true;
        $this->isHTML();
        
        $this->Host = $params['host'];
        $this->SMTPSecure = $params['secure'];
        $this->Port = $params['port'];
        
        $this->Username = $params['username'];
        $this->Password = $params['password'];
        $this->From = $params['from'];
        $this->FromName = $params['fromname'];
        
        $this->CharSet = 'UTF-8';
    }
    
    public function render($template_name, $params = false) {
        $template = ROOT . '/app/views/mail/_' . $template_name . '.php';
        $letter = file_get_contents($template);
        if ($params) {
            foreach ($params as $k => $v) {
                $letter = str_replace($k, $v, $letter);
            }
        }
        return $letter;
    }

}
