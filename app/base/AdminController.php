<?php

namespace app\base;

class AdminController extends Controller {
    
    public $config;
    public $usid;
    public $user;
    public $admin;

    public function __construct($controller) {
        parent::__construct($controller);
        
        $this->usid = $this->isLogged();
        if (!$this->usid) {
            $this->notFound();
        }
        
        $this->user = new \app\modules\User($this->usid);
        if ($this->user->data['roots'] < 99) {
            $this->notFound();
        }
        
        $this->admin = $this->admin();
        if (!$this->admin() && $_SERVER['REQUEST_URI'] != '/panel/login') {
            header('location: /panel/login');
            return;
        }
        
        $this->sessionControll($this->user->data['salt']);
        $m_Config = new \app\models\Config();
        $this->config = $m_Config->getConfig();
		
        $m_RewAccept = new \app\models\Reviews();
        $this->RewAccept = $m_RewAccept->getReviews(0);
		
		$m_Insert = new \app\models\Insert();
        $this->Payin = $m_Insert->getTotalInsertsPanel(0);
		$m_Payment = new \app\models\Payment();
        $this->Payout = $m_Payment->getTotalPaymentsPanel(0);

    }
    
}
