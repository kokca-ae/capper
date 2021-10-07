<?php

namespace app\modules\sender;

class BeforeRecovery extends \app\modules\Sender {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function sendLetter ($email, $params = []) {
        $this->Subject = 'Восстановление пароля в ' . NAME;
        $this->addAddress($email);
        
        $params['$name'] = NAME;
        
        $this->Body = $this->render('before_recovery', $params);
        $this->AltBody = $this->render('before_recovery_alt', $params);

        if ($this->send()) {
            return true;
        }
        else {
            return $this->ErrorInfo;
        }
    }
    
}
