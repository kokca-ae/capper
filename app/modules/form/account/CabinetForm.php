<?php

namespace app\modules\form\account;

class CabinetForm extends \app\modules\Form {
    
    public function validateFields($post, $config) {
        if (!isset($post['plan'])) {
            return ['error' => 2];
        }
        if (empty($post['plan'])) {
            return ['error' => 2];
        }
        if (!isset($post['amount'])) {
            return ['error' => 5];
        }
        if (empty($post['amount'])) {
            return ['error' => 3];
        }
        if (!isset($post['ps'])) {
            return ['error' => 7];
        }
        if (empty($post['ps'])) {
            return ['error' => 7];
        }
        return $this->validateValues($post, $config);

    }
    
    public function validateValues($post, $config) {
        
        $m_Plans = new \app\models\Plans();
        $plan = $m_Plans->findOne($post['plan']);
        $m_Paysystems = new \app\models\Paysystems();
        $ps = $m_Paysystems->findOne($post['ps'], 'name');

        if (!$plan) {
            return ['error' => 1];
        }
        if (!$ps) {
            return ['error' => 1];
        }
        if ($ps['active'] == 0) {
            return ['error' => 1];
        }
        if ($ps['active_insert'] != 1) {
            return ['error' => 1];
        }
        
        $amount = floatval($post['amount']);
        $amount_i = $post['amount'] * $config['bal_' . $ps['currs']];
		$amount_is = $post['amount'];
		//echo $plan['min_sum'];
		
		// сверка ЛИМИТОВ 26.08.18
		$m_DepL = new \app\models\Deposits();
        $nowDEPatThisPS = $m_DepL->getDepositLimit(intval($post['io']), $ps['name']);
		
		// --------------------------
		// LIMIT dep
		// --------------------------
		$m_Limits = new \app\models\Limits(); // new 24.08.18
		$Limit = $m_Limits->getLimits(); // new 24.08.18
		
		foreach ($Limit as $k => $v) {
            
                $this->limit = $v['limit_now'];
                $curs["usd"] = $v['currs_usd'];
				$curs["rub"] = $v['currs_rub'];
				$curs["btc"] = $v['currs_btc'];
				$curs["ltc"] = $v['currs_ltc'];
				$curs["eth"] = $v['currs_eth'];
				$curs["doge"] = $v['currs_doge'];
				$curs["dash"] = $v['currs_dash'];

        }
		// --------------------------
		
		$small_currs = strtolower($ps['currs']);
		
		$re_amount = $amount*$config['bal_' . $ps['currs']];
		
		if($re_amount > $this->limit){
			//echo $re_amount;
			return ['error' => 9];
		}
		
		if($nowDEPatThisPS[0]["SUM(sum)"]*$config['bal_' . $ps['currs']]+$re_amount > $this->limit){
			//print_r($nowDEPatThisPS);
			//echo $nowDEPatThisPS[0]["SUM(sum)"];
			return ['error' => 8];
		}
        /*if ($amount_i < $plan['min_sum']) {
            return ['error' => 7];
        }*/
		// сверка отправленой суммы по курсу с минималкой плана
        if ($amount_i < $plan['min_sum']) {
            return ['error' => 7];
        }
        if ($amount_i > $plan['max_sum']) {
            return ['error' => 6];
        }
        if ($amount < $ps['min_insert']) {
            return ['error' => 5];
        }
        if ($amount > $ps['max_insert']) {
            return ['error' => 6];
        }
		
        return [
            'error' => false, 
            'fields' => [
                'plan' => $plan,
                'ps' => $ps,
                'amount' => $amount,
                'amount_i' => $amount_i,
                ],
            ];
    }
    
}
