<?php

namespace app\controllers\main;

class ContactsController extends \app\base\MainController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {
        $_title['ru'] = 'Контакты';
        $_title['en'] = 'Contacts';
		
		$set_img_bg = 'contacts';
		$_desc_other['ru'] = 'Всегда на связи с вами!';
		$_desc_other['en'] = 'Always in touch with you!';
		
        $recaptcha = new \vendor\Recaptcha();
  
        if (isset($_POST['form']) && $_POST['form'] == 'contact_form') {

            if (!$this->checkToken($_POST['token'], 'contact_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }
            if ($this->usid) {
                $_POST['email'] = $this->user->data['email'];
            }
            if (!$this->error) {
                $form = new \app\modules\form\main\ContactForm();
                
                $result = $form->validateFields($_POST, $recaptcha);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }
                else {
                    $sender = new \app\modules\sender\ContactForm();
                    $params = [
                        '$message' => $result['fields']['message'], 
                        '$from' => $result['fields']['email']
                    ];
                    $sender->sendLetter($this->config['admin_email'], $params);

                    $this->setError($this->errors[$this->lang][20]);
					$this->typeReq = 2;
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }

}
