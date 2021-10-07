<?php

namespace app\controllers\account;

class ReferalsController extends \app\base\AccountController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($l = 1, $page = 1) {
        $_title['en'] = 'Referral system';
		$_title['ru'] = 'Партнерская система';
		
		$requestCopied['ru'] = 'Ссылка успешно скопирована';
		$requestCopied['en'] = 'Ref link has been copy';
        
        $lvl = (intval($l) > 0 && intval($l) <= $this->config['ref_lvls']) ? intval($l) : 1;
        //$ref_link = PROTOCOL . '://' . HOST . '/ref/' . $this->usid;
        
        $m_Userreferal = new \app\models\Userreferal();
        $total = $m_Userreferal->getTotalReferalsLvl($this->usid, $lvl);
		
		for($i=1;$i<= $this->config['ref_lvls'];$i++){
		$activeRef += $m_Userreferal->getTotalActiveReferalsLvl($this->usid, $i);
		}
		// -------------------------
		// кто пригласил

        $upliner = $this->user->referal['referer1'];
		$upliner = empty($upliner) ? "None" : $upliner;
		// -------------------------
		
		$ref_commission = sprintf("%.2f", ($this->user->referal['from_referals1']+$this->user->referal['from_referals2']+$this->user->referal['from_referals3']));
		$ref_count = $this->user->referal['count_ref1']+ $this->user->referal['count_ref2']+ $this->user->referal['count_ref3'];
		
        //$format = '/referals/' . $lvl . '/';
        //$navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $referals = $m_Userreferal->getReferalsLvLnotLim($this->usid, $lvl);
        
        require_once($this->render(__METHOD__));
    }
    
    public function actionPromo() {
        $_title['en'] = 'Promotions';
		$_title['ru'] = 'Промо';
        
		$ref_commission = sprintf("%.2f", ($this->user->referal['from_referals1']+$this->user->referal['from_referals2']+$this->user->referal['from_referals3']));
        $ref_link = PROTOCOL . '://' . HOST . '/ref/' . $this->usid;

        require_once($this->render(__METHOD__));
    }
	
	public function actionPartnership($l = 1, $page = 1) {
        $_title['en'] = 'Referral system';
		$_title['ru'] = 'Партнерская система';
		
		$requestCopied['ru'] = 'Ссылка успешно скопирована';
		$requestCopied['en'] = 'Ref link has been copy';
        
        $lvl = (intval($l) > 0 && intval($l) <= $this->config['ref_lvls']) ? intval($l) : 1;
        $ref_link = PROTOCOL . '://' . HOST . '/ref/' . $this->usid;
        
        $m_Userreferal = new \app\models\Userreferal();
        $total = $m_Userreferal->getTotalReferalsLvl($this->usid, $lvl);
		
		// -------------------------
		// кто пригласил

        $upliner = $this->user->referal['referer1'];
		$upliner = empty($upliner) ? "None" : $upliner;
		// -------------------------
		
        //$format = '/referals/partnership/';
        //$navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        //$referals = $m_Userreferal->getReferalsLvl($this->usid, $lvl, $navigation['lim'], 3);
		
        $format = '/referals/partnership/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format,20);
        $referals = $m_Userreferal->getReferalsLvl($this->usid, $lvl, $navigation['lim'], $navigation['on_page']);
        
        require_once($this->render(__METHOD__));
    }

}
