<?php

namespace app\modules\sender;

class ContactForm extends \app\modules\Sender {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function sendLetter ($email, $params = []) {
        $this->Subject = 'Контактная форма с проекта ' . NAME;
        $this->addAddress($email);
        
        $params['$name'] = NAME;
        
        $this->Body = $this->render('contact_form', $params);
        $this->AltBody = $this->render('contact_form_alt', $params);

        if ($this->send()) {
            return true;
        }
        else {
            var_dump($this->ErrorInfo);
            die();
            return $this->ErrorInfo;
        }
    }
    
}
