<?php

namespace app\controllers\account;

class CabinetController extends \app\base\AccountController {
    
    /*
	private $statuses = [
            0 => 'В обработке',
            1 => 'Выполнена',
            2 => 'Отменена',
        ];
    
    private $earns_statuses = [
            1 => 'Реферальные',
            2 => 'Начисление по депозиту',
        ];
	*/

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        
		$_title['en'] = 'Cabinet';
		$_title['ru'] = 'Аккаунт';
     
		
		//--- таймер
	
		//---
		
		$m_Plans = new \app\models\Plans();
        $plans = $this->plans;
        
        $m_Insert = new \app\models\Insert();
		
		
		
		//---
		// Вычленяем первый тарифный план
		$i=1;
		$plans = $this->plans;
		foreach ($plans as $row){
			$PlanName[$i] = $row['name'];
			$PlanAllPerc[$i] = $row['perc'];
			$PlanEarns[$i] = $row['earns'];
			$PlanPerHour[$i] = intval($PlanAllPerc[$i]/$PlanEarns[$i]*100)/100;
			$PlanProfit[$i] =($PlanAllPerc[$i]-100)/100;
		$i++;
		}
		//---
		
		// -------------------------
		// кол-во рефов
		$ref_count = $this->user->referal['count_ref1']+ $this->user->referal['count_ref2']+ $this->user->referal['count_ref3'];

        //$upliner = $this->user->referal['referer1'];
		//$upliner = 'referer1';
		//$m_Usref = new \app\models\Userreferal();
		//$referer = $m_Usref->findOne($upliner);
		//$referer = empty($referer) ? "None" : $referer['user'];
		
		/*
		$m_Userdata = new \app\models\Userdata();
        $referer_id = (isset($_SESSION["ref"])) ? $_SESSION["ref"] : 0;
        if ($referer_id) { $referer = $m_Userdata->findOne($referer_id);}
		$referer = empty($referer) ? "None" : $referer['user'];
		*/
		// -------------------------
		
		$de_Earn = new \app\models\Earn();
        $dechart = $de_Earn->getUserEarns($this->usid, 5, 5);
		if(!empty($dechart))
		{		
			foreach($dechart as $v) { $data = $v["sum"]; }
			//echo json_encode($data)."<br>";
			$ChartData = json_encode($data);
		}

    $sum_in = round($this->user->balance['insert_sum'],2);
    $sum_out = round($this->user->balance['payment_sum'],2);
    
	// -------------------------
	// сколько % от депа вывел
	// -------------------------
    $sum_in = round($this->user->balance['insert_sum'],2);
    $sum_out = round($this->user->balance['payment_sum'],2);
    
    if($sum_in > 0)
    {
		$r =  $sum_in/100;
		$p =  $sum_out/$r;
		$percent_depOut = number_format($p,2,'.','');
		
		$percent_depIn =  100-$percent_depOut;
		$percent_depIn = number_format($percent_depIn,2,'.','');
	} else{ $percent_depOut = 0; $this->none = 100; $percent_depIn = 0;}
    
        $m_Userdata = new \app\models\Userdata();
		
		$m_Earn = new \app\models\Earn();
        $total_e = $m_Earn->getTotalUserEarns($this->usid);
		$m_Payment = new \app\models\Payment();
        $total_p = $m_Payment->getTotalUserPayments($this->usid);
		$m_Insert = new \app\models\Insert();
        $total_i = $m_Insert->getTotalUserInserts($this->usid);
		
		// считает строки пользователя
        $totalHistoryRows = $total_e+$total_p+$total_i;
		//------
		
		$arrStatus['en'] = array(1=>'Referral',2=>'Deposit');
		$arrStatus['ru'] = array(1=>'Реферальные',2=>'По депозиту');
		$classButInfo = array(1=>'info',2=>'success');
		
        $navigation = \vendor\Paginator::getNavigation($page, $total_e, '', $total_e);
        $earns = $m_Earn->getUserEarns($this->usid, $navigation['lim'], $navigation['on_page']);
		
        //$format = '/inserts/';
        //$navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        //$inserts = $m_Insert->getUserInserts($this->usid, $navigation['lim'], $navigation['on_page']);
	
    require_once($this->render(__METHOD__));
    }

}
