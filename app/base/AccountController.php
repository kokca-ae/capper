<?php

namespace app\base;

class AccountController extends Controller {
    
    public $config;
    public $usid;
    public $ps;
    public $ps_m;
    public $ps_unset;
	public $plans;
	public $SumEarn;
	public $SumEarnAll;
	public $refbackAllSum;
	public $Lastdep;
	public $Activedep;
	public $Lastpay;
	public $userBal;
	public $ps_b; // для получения общего баланса юзеру на странице аккаунта
    public $user;
    public $ref_link;
	public $news_list;
	public $upliner;
	public $ref_commission;
	public $typeReq;
	public $walletErrName;

    public function __construct($controller) {
        parent::__construct($controller);
        
        $this->usid = $this->isLogged();
        if (!$this->usid) {
            header('location: /');
            return;
        }
        
        $this->admin = $this->admin();
		$this->typeReq = 0;
		$this->walletErrName = 0;
        
        $this->user = new \app\modules\User($this->usid);
        $this->sessionControll($this->user->data['salt']);
        
        $m_Config = new \app\models\Config();
        $this->config = $m_Config->getConfig();
        
        $m_Paysystems = new \app\models\Paysystems();
        $this->ps = $m_Paysystems->getActiveSystems();
        $this->ps_m = $this->ps;
		$this->ps_b = $this->ps;  // для получения общего баланса юзеру на странице аккаунта
		
		//$this->ref_link = PROTOCOL . '://' . HOST . '/ref/' . $this->usid; //старый тип рефки без выбора в админке
		$ref_type = intval($this->config['ref_type'] == 1) ? $this->usid : $this->user->data['user'];
		$this->ref_link = PROTOCOL . '://' . HOST . '/'.$this->config['ref_link'].'/' . $ref_type;
		
		// -------------------------
		// кто пригласил

        $upliner = $this->user->referal['referer1'];
		$this->upliner = empty($upliner) ? "None" : $upliner;
		
		$this->ref_commission = sprintf("%.2f", ($this->user->referal['from_referals1']+$this->user->referal['from_referals2']+$this->user->referal['from_referals3']));
		// -------------------------
		
		// для получения текущего статуса проекта в шапке (на всех стр проекта)
		//$arrStatusPj['en'] = array(0=> 'Bets', 1=> 'Payouts', 2=> 'Deposit Acceptance');
		//$arrStatusPj['ru'] = array(0=> 'Ставки', 1=> 'Выплаты', 2=> 'Прием вкладов');
		//print_r($arrStatusPj);
		
		//$arrTimePeriod['en'] = array(0=> 'Betting period will last', 1=> 'Payout period will last', 2=> 'Reception of deposits period will last');
		//$arrTimePeriod['ru'] = array(0=> 'Период ставок продлится ', 1=> 'Период выплат продлится', 2=> 'Период приема вкладов продлится');
		
		//$this->status_pj = $arrStatusPj[$this->lang][$this->config['now_period']];
		//$this->time_pj_period = $arrTimePeriod[$this->lang][$this->config['now_period']];
		//---
		
		
		//---
		
		// news
		// получение 7ми последних новостей 
		//---
		
		
		
		$m_Plans = new \app\models\Plans();
        $this->plans = $m_Plans->findAll();

        foreach ($this->ps_m as $k => $v) {
            if ($v['name'] == 'acusd' || $v['name'] == 'pyusd') {
                unset($this->ps_m[$k]);
            }
		}
		
		// unset py/pyusd on view foreach
        $this->ps_unset = $this->ps;
        foreach ($this->ps_unset as $k => $v) {
            if ($v['name'] == 'acusd' || $v['name'] == 'py') {
                unset($this->ps_unset[$k]);
            }
        }
		
		// заебался делать подсчет баланса из user_data по сведению перебора массива к валюте из config
        foreach ($this->ps_b as &$v)
		{

            if ($v['name'] == "ac" OR $v['name'] == "py" OR $v['name'] == "fkym" OR $v['name'] == "fkqw")
			{
               $v['name'] = "RUB";
			}elseif($v['name'] == "acusd" OR $v['name'] == "pyusd" OR $v['name'] == "pm"){
			   $v['name'] = "USD";
			}elseif($v['name'] == "cpbtc" OR $v['name'] == "cpltc" OR $v['name'] == "cpeth" OR $v['name'] == "cpdoge" OR $v['name'] == "cpdash"){
			   $v['name'] = strtoupper(substr($v['name'], 2));
			}
			
		}
		
		// получение числа активных депозитов
		$m_Deposit = new \app\models\Deposits();
        $AdepositsU = $m_Deposit->getCountActiveUserDeposits($this->usid);
		if(empty($AdepositsU)){
			
			$this->Activedep = 0;
			
		}else $this->Activedep = $AdepositsU['sum'];
		
		// получение суммы начислений - "Заработано"
		$m_Earn = new \app\models\Earn();
        $SumEarnSet = $m_Earn->getSumUserEarns($this->usid);
		
		if(empty($SumEarnSet)){
			
			$this->SumEarnAll = 0;
			
		}else{
		
		$this->SumEarnAll = 0;
		foreach ($SumEarnSet as $volume) {
			$volume["sum"] = $volume['sum']*$this->config['bal_'.$volume["currs"]];
			//echo $volume["sum"]."<br>";
			$this->SumEarnAll +=$volume["sum"];
		}
		
		$this->SumEarnAll = intval($this->SumEarnAll*100)/100;
		
		
		//считаем сумму рефбеками
		$SumEarnsRefbackOnly = $m_Earn->getSumUserEarnsRefbackOnly($this->usid);
		$this->refbackAllSum = 0;
		foreach ($SumEarnsRefbackOnly as $volume) {
			$volume["sum"] = $volume['sum']*$this->config['bal_'.$volume["currs"]];
			//echo $volume["sum"]."<br>";
			$this->refbackAllSum +=$volume["sum"];
		}
		
		$this->refbackAllSum = intval($this->refbackAllSum*100)/100;
		//---
		$this->SumEarn=$this->SumEarnAll-($this->refbackAllSum*2);
		
		}
		
        // получение суммы последней выплаты
		$m_Payment = new \app\models\Payment();
        $Lastpay_m = $m_Payment->UserlastPay($this->usid);
		
		//print_r($Lastpay[0]);
		//echo "<br>";
		//print_r($Lastpay);
		
		if(empty($Lastpay_m)){
			
			$this->Lastpay = 0;
			
		}else{
			
		foreach ($Lastpay_m as $k => $v) {
				$v["sum"] = number_format(($v['sum']*$this->config['bal_'.$v["currs"]]), '2', '.', '');
				//echo $v["sum"]." в <br>";
		}
		
		$this->Lastpay = $v["sum"];
		}
		
		$m_Deposit = new \app\models\Deposits();

		
		// получение суммы последнего депозита
        $Lastdep_m = $m_Deposit->UserlastDep($this->usid);
		
		if(empty($Lastdep_m)){
			
		$this->Lastdep = 0;
			
		}else{
			
		foreach ($Lastdep_m as $value) {
				$value["sum"] = number_format(($value['sum']*$this->config['bal_'.$value["currs"]]), '2', '.', ',');
				//echo $v["sum"]." в <br>";
		}
		
		$this->Lastdep = $value["sum"];
		}
		
		// 
		
		$allbal = $b=0;
        $i = 1;
        foreach ($this->ps as $row){
        $x[$i] = $this->user->balance['money_' . $row['name']];
        $i++;
        }
        
        
        $i = 1;
        foreach ($this->ps_b as $row => $that)
        {
	        $b = $this->sotTrash($x[$i]*$this->config['bal_'.$that["name"]], substr($that['format'], 2, 1)); // правка 31.03.19
	        $this->userBal +=$b;
	        //echo $x[$i]." - ".$row["name"]." - ".$b."<br>";  // проверка правильности НЫНЕ успешна
	        $i++;
        }
		
		$this->userBal = intval($this->userBal*100)/100;
		
		$m_Paysystems = new \app\models\Paysystems();
		$Paysys = $m_Paysystems->getActiveSystems();
		$i=1;
		foreach ($Paysys as $row) {
			
			if ($row['name'] == "pyusd" || $row['name'] == "py"){$this->fullnameCurr[$i]="Payeer";}else{ $this->fullnameCurr[$i] = $row['fullname'];}
			$this->IcoCurr[$i] = $row['name'];
			$this->nameCurr[$i] = $row['currs'];
			$this->formatCurr[$i] = substr($row['format'], 2, 1);
			$this->minPayment[$i] = $row['min_payment'];
			$this->maxPayment[$i] = $row['max_payment'];
			$this->minInsert[$i] = $row['min_insert'];
			$this->maxInsert[$i] = $row['max_insert'];
			//$fullnameCurr[$i] = $row['fullname'];
			
			//if($this->formatCurr[$i] == '2'){
				$this->balanceCurr[$i] = $this->sotTrash($this->user->balance['money_'.$row['name']],$this->formatCurr[$i]);
			//}else $this->balanceCurr[$i] = sprintf($row['format'], $this->user->balance['money_'.$row['name']]);
			
			$this->balanceCurr[$i] = $this->balanceCurr[$i] > 0 ? $this->balanceCurr[$i] : number_format($this->balanceCurr[$i],$this->formatCurr[$i],'.','');
			
		$i++;
		}
        
    }
    
}
