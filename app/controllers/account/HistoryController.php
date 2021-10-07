<?php

namespace app\controllers\account;

class HistoryController extends \app\base\AccountController {
    

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        //$_title['ru'] = 'история пополнений';
		//$_title['en'] = 'Inserts history';
		
		$arrTitles['en'] = array(0=>'Inserts history',1=>'Earns history',2=>'Payments history');
		$arrTitles['ru'] = array(0=>'история пополнений',1=>'история начислений',2=>'история выплат');
		
		$arrStatus['en'] = array(0=>'Waiting',1=>'Completed',2=>'Cancelled');
		$arrStatus['ru'] = array(0=>'Ожидание',1=>'Выполнено',2=>'Отменено');
		
		$arrType['en'] = array(0=>'Deposit',1=>'Accrual',2=>'Payout');
		$arrType['ru'] = array(0=>'Пополнение',1=>'Начисление',2=>'Выплата');
		
		$classButInfo = array(0=>'waiting',1=>'',2=>'cancel');
		
		$arrComment['en'] = array(1=>'Referral',2=>'Interest on Deposit',3=>'Auto refback payment',4=>'Getting Auto refback');
		$arrComment['ru'] = array(1=>'Реферальные',2=>'Отчисления по депозиту',3=>'Выплата Auto refback',4=>'Получение Auto refback');
		
		
		if (isset($_POST['form']) && $_POST['form'] == 'search_history_form') {
			
			/*
            if (!$this->checkToken($_POST['token'], 'search_history_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }*/
			
			//print_r($_POST);
			
            if (!$this->error) {
                $form = new \app\modules\form\account\HistoryForm(); // форма проверки/выборки
                $result = $form->validateFields($_POST, $this->user);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
					//print_r($result);
                }
                else {
					// здесь магия
					$type_info = $result['fields']['type'];
					$data_history = $result['fields']['data'];
					//print_r($result);
                }
            }
			
        }else{
			
			// stock inserts
			$type_info = 0;
			$m_Insert = new \app\models\Insert();
			$data_history = $m_Insert->getLastInsertsUser($this->usid, 7);
			
			
		}
		
		$_title[$this->lang] = $arrTitles[$this->lang][$type_info];
        
        require_once($this->render(__METHOD__));
    }

}
