<?php

namespace app\controllers\main;

class HomeController extends \app\base\MainController {
 
    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex() {

        $_title['en'] = 'Home';
        $_title['ru'] = 'Главная';
		
		$m_Reviews = new \app\models\Reviews();
		$text_reviews = $m_Reviews->lastReviews(1,6);
		$video_reviews = $m_Reviews->lastReviews(2,6);
		//---
		// LogIn
		if (isset($_POST['form']) && $_POST['form'] == 'login_form') {
            /*
            if (!$this->checkToken($_POST['token'], 'login_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }*/
            if (!$this->error) {
				
				if ($this->usid) {
				header('location: /'.STARTPAGELOGIN);
				return;
				}
				
                $form = new \app\modules\form\main\LoginForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }
                else {
                    $result = $this->user->login($result['fields']['data']);
					
					$m_Userdata = new \app\models\Userdata();
					$uData = $m_Userdata->findOne(intval($result['id']));

                    
					$this->setSessionId($result['salt']);
                    $_SESSION['usid'] = $result['id'];
					$this->typeReq = 4;
					$this->login_hi = $uData['user'];
					
					
					//print_r($uData);
					
                    //header('location: /'.STARTPAGELOGIN);
                    //return;
                }
            }
        }
		
		//---
		// SignUp
        $recaptcha = new \vendor\Recaptcha();
		
		// -------------------------
		// кто пригласил
		//$referer = (isset($_SESSION["ref"])) ? $_SESSION["ref"] : "None"; // описал все на HomeController (с проверкой там же)
		
		// -------------------------
        
        if (isset($_POST['form']) && $_POST['form'] == 'signup_form') {

            /*
            if (!$this->checkToken($_POST['token'], 'signup_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }*/
            if (!$this->error) {
                $form = new \app\modules\form\main\SignupForm();
                $result = $form->validateFields($_POST, $this->config, $recaptcha);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }
                else {
                    $user = new \app\modules\User();
                    $result = $user->signup($result['fields'], $this->config);

                    $this->setError($this->errors[$this->lang][30]);
					$this->typeReq = 2;
                    //header('location: /');
                    //return;

                }
            }
        }
		//---
		// Recovery
		if (isset($_POST['form']) && $_POST['form'] == 'recovery_form') {

            if (!$this->checkToken($_POST['token'], 'recovery_form')) {
                $this->setError($this->errors[$this->lang][1]);
				$this->typeReq = 3;
            }
            if (!$this->error) {
                $form = new \app\modules\form\main\RecoveryForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
					$this->typeReq = 3;
                }
                else {
                    $result = $this->user->recovery($result['fields']['data']);
                    
                    $sender = new \app\modules\sender\BeforeRecovery();
                    $sender->sendLetter($result['fields']['email'], ['$link' => $result['link']]);

                    $this->setError($this->errors[$this->lang][50]);
					$this->typeReq = 2;
                }
            }
        }
		
		
		//----
		// Other
        $m_Plans = new \app\models\Plans();
        $m_Userbalance = new \app\models\Userbalance();
        $m_Insert = new \app\models\Insert();
        $m_Payment = new \app\models\Payment();

        $plans = $m_Plans->findAll();

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

        $stats['users_count'] = $m_Userbalance->getCount();
        $stats['total_insert'] = $m_Userbalance->getTotalInsertSum();
        $stats['total_payment'] = $m_Userbalance->getTotalPaymentSum();
        $stats['days_work'] = floor((time() - $this->config['date_start']) / 60 / 60 / 24);
        
        $last_inserts = $m_Insert->lastInserts(6);
        $last_payments = $m_Payment->lastPayments(6);
        
        $m_Userreferal = new \app\models\Userreferal();
        $top_referers = $m_Userreferal->topReferers(); // топ рефоводов
		$top_invests = $m_Userbalance->topInvest(); // топ инвесторов
		//$top_referers = $m_Userreferal->getTotalRefererRefs();
		
		//----
		// Вычленяем рефку по сумме процентов с уровней и с первого
		$refPerc[]='';
		for($i = 1; $i <= $this->config['ref_lvls']; $i++){
			$refPerc[$i]=$this->config['ref'.$i];
			$allRefPerc+=$refPerc[$i];
		}
		$refPercOne=$this->config['ref1'];
		//---
		// Вычленяем первый тарифный план
		$i=1;
		foreach ($plans as $row){
			
			$PlanAllPerc[$i] = $row['perc'];
			$PlanEarns[$i] = $row['earns'];
			$PlanPerHour[$i] = intval($PlanAllPerc[$i]/$PlanEarns[$i]*100)/100;
			$PlanProfit[$i] =($PlanAllPerc[$i]-100)/100;
			$PlanMin[$i] = $row['min_sum'];
			$PlanMax[$i] = $row['max_sum'];
			
		$i++;
		}
		//---
		$i=1;
		foreach ($this->ps as $row) {
			//$str_start[] ='';
			if ($row['name'] == "pyusd" || $row['name'] == "py"){$row['fullname']="Payeer";}else{ $row['fullname'] = $row['fullname'];}
			$str_start['ps'][$i]=$row['fullname'];
			$str_start['currs'][$i]=strtolower($row['currs']);
			$str_start['min_insert'][$i]=$row['min_insert'];
			$str_start['max_insert'][$i]=$row['max_insert'];
			$str_start['min_payment'][$i]=$row['min_payment'];
			$str_start['max_payment'][$i]=$row['max_payment'];
		$i++;
		}

//date_default_timezone_set('EST');
//date_default_timezone_set('UTC');

$now = time();
$s = $now - $this->config['date_start']; // сколько секунд прошло

// сколько минут прошло
$m = floor($s / (60));

$timestamp00 = (time() - $this->config['date_start']);

$H = (floor($timestamp00/3600)-(24*(floor((time() - $this->config['date_start']) / 60 / 60 / 24))));

$Hf = floor($timestamp00/3600);
floor($minutes =($timestamp00/3600 - $Hf)*60);
$S = ceil(($minutes - floor($minutes))*60);
$I=ceil($minutes)-1;

$recaptcha = new \vendor\Recaptcha();
  
        if (isset($_POST['form']) && $_POST['form'] == 'contact_form') {

            if (!$this->checkToken($_POST['token'], 'contact_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if ($this->usid) {
                $_POST['email'] = $this->user->data['email'];
            }
            if (!$this->error) {
                $form = new \app\modules\form\main\ContactForm();
                
                $result = $form->validateFields($_POST, $recaptcha);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
                    $sender = new \app\modules\sender\ContactForm();
                    $params = [
                        '$message' => $result['fields']['message'], 
                        '$from' => $result['fields']['email']
                    ];
                    $sender->sendLetter($this->config['admin_email'], $params);

                    $this->setError($this->errors[$this->lang][20]);
                }
            }
        }
		
		//echo $_SESSION["ref"];
		
		$m_PerMonth = new \app\models\Monthperc();
		$graph_perc = $m_PerMonth->period();
        
        require_once($this->render(__METHOD__));
    }
	

    // предворительный фильтр реф ссылки на запрещенные символы
	public static function verif($value) {
		if(preg_match("/^[a-zA-Z0-9@*^&\+_\-]{1,20}$/",$value)) {
            return true;
        }
        return false;
    }

    /*
    // старый тип реф.ссылки 
    public function actionRef($ref = 0) {
        if ($this->usid) {
            header("Location: /");
            return;
        }
        if ($ref != 0) {
            $referer = (intval($ref) > 0) ? intval($ref) : 0;
            if ($referer > 0) {
                $m_Userdata = new \app\models\Userdata();
                if (!$m_Userdata->findOne($referer)) {
                    $referer = 0;
                }
            }
            $_SESSION['ref'] = $referer;
            header("Location: /");
            return;
        }
    }
    */
	
	// тип реф.ссылки 3 /go/(number or login)
	public function actionGo($ref) {
        if ($this->usid) {
            header("Location: /");
            return;
        }
        if (!empty($ref)){
			
			if($this->verif($ref) == true){ // проверка на валид логина (или id)
				//$_SESSION["go"] = $ref;
			//$referer = strtolower($ref);
			$m_Userdata = new \app\models\Userdata();
			
			
            $refererSearch = $m_Userdata->findOne($ref); // ищем подставляя как id
			if(!$refererSearch){
			$refererSearch = $m_Userdata->findOne($ref,"user"); // ищем по логину
			}
			$referer = empty($refererSearch) ? "None" : $refererSearch['user']; // если не находим выдаем none
			$_SESSION["ref"] = $referer;
			}
			
            header("Location: /");
            return;
        }
    }
	
	// тип реф.ссылки 2 /r/(number or login)
	public function actionR($ref) {
        if ($this->usid) {
            header("Location: /");
            return;
        }
        if (!empty($ref)){
			
			if($this->verif($ref) == true){ // проверка на валид логина (или id)
				//$_SESSION["go"] = $ref;
			//$referer = strtolower($ref);
			$m_Userdata = new \app\models\Userdata();
			
			
            $refererSearch = $m_Userdata->findOne($ref); // ищем подставляя как id
			if(!$refererSearch){
			$refererSearch = $m_Userdata->findOne($ref,"user"); // ищем по логину
			}
			$referer = empty($refererSearch) ? "None" : $refererSearch['user']; // если не находим выдаем none
			$_SESSION["ref"] = $referer;
			}
			
            header("Location: /");
            return;
        }
    }
	
// тип реф.ссылки 1 /ref/(number or login)
	public function actionRef($ref) {
        if ($this->usid) {
            header("Location: /");
            return;
        }
        if (!empty($ref)){
			
			if($this->verif($ref) == true){ // проверка на валид логина (или id)
				//$_SESSION["go"] = $ref;
			//$referer = strtolower($ref);
			$m_Userdata = new \app\models\Userdata();
			
			
            $refererSearch = $m_Userdata->findOne($ref); // ищем подставляя как id
			if(!$refererSearch){
			$refererSearch = $m_Userdata->findOne($ref,"user"); // ищем по логину
			}
			$referer = empty($refererSearch) ? "None" : $refererSearch['user']; // если не находим выдаем none
			$_SESSION["ref"] = $referer;
			}
			
            header("Location: /");
            return;
        }
    }

}