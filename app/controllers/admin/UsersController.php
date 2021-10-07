<?php

namespace app\controllers\admin;

class UsersController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Пользователи';
        $_title['en'] = 'Users';
        
        $m_Userdata = new \app\models\Userdata();
        $total = $m_Userdata->getCount();
        $format = '/panel/users/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $users = $m_Userdata->getUsers($navigation['lim'], $navigation['on_page']);

		//$psRows = $m_Paysystems->getActiveSystemsRows(); // rows in PaySYS
        
        require_once($this->render(__METHOD__));
    }
    
    public function actionView($id) {
        $user = new \app\modules\User($id);
        if (!$user) {
            header('location: /panel/users');
            return;
        }
        
        $_title['ru'] = 'Пользователь "' . $user->data['user'] . '"';
        $_title['en'] = 'User "' . $user->data['user'] . '"';
        
		//-----------------------
		// VIEWS balance user at USD & Remainder (invest-payout)
		// update at 04.12.18
        $m_Paysystems = new \app\models\Paysystems();
        $ps = $m_Paysystems->getActiveSystems();
		
		$i = 1;
        foreach ($ps as $row){
        $x[$i] = $user->balance['money_' . $row['name']];

	        $b = number_format(($x[$i]*$this->config['bal_'.$row["currs"]]), '2', '.', ',');
	        $userBalView +=$b;
	        //echo $x[$i]." - ".$row["name"]." - ".$b."<br>";  // проверка правильности НЫНЕ успешна
	        $i++;
        }
		
		$userRemainderView = $user->balance['insert_sum']-$user->balance['payment_sum'];
		if($userRemainderView<=0){
		$style="style='color: red;'";
		}else $style="style='color: #29dc29;'";
		//-----------------------
        
        if (isset($_POST['form']) && $_POST['form'] == 'user_ban_form') {
            
            if (!$this->checkToken($_POST['token'], 'user_ban_form')) {
                $this->setError($this->errors[1]);
            }
            if (!$this->error) {
                if ($user->data['banned'] == 1) {
                    $user->updateData(['banned' => 0]);
                    $this->setError($this->errors[20]);
                }
                else {
                    $user->updateData(['banned' => 1]);
                    $this->setError($this->errors[21]);
                }
            }
        }
        
        if (isset($_POST['form']) && $_POST['form'] == 'user_login_form') {
            
            if (!$this->checkToken($_POST['token'], 'user_login_form')) {
                $this->setError($this->errors[1]);
            }
            if (!$this->error) {
                $result = $user->login($user->data);
                $this->setSessionId($result['salt']);
                $_SESSION['usid'] = $result['id'];
                header('location: /'.STARTPAGELOGIN);
                return;
            }
        }

        require_once($this->render(__METHOD__));
    }
	
	// поиск юзера new от 30.08.18
    public function actionSearch() {
		
        $_title['ru'] = 'Поиск Пользователя';
        $_title['en'] = 'User Search';
		
		$SetUser = 0;
        
        if (isset($_POST['form']) && $_POST['form'] == 'search_form') {
            
            if (!$this->checkToken($_POST['token'], 'search_form')) {
                $this->setError($this->errors[1]);
            }
            if (!$this->error) {
				$form = new \app\modules\form\admin\SearchForm();
                $result = $form->validateFields($_POST);
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
					$Search = new \app\models\Search();
					
        $arrgs1 = [];
		$arrgs2 = [];
		
		$i = 1;
        foreach ($result['fields'] as $key => $value) {
            $arrgs1[$i] = $key;
            $arrgs2[$i] = $value;
			//$m_Lim->updateCurrs($arrgs1[$i],$arrgs2[$i]);
			$i++;
        }
		
		// включать только для отладки 30.08.18
		/*for($x=1;$x<$i;$x++){
		echo "<br>";
		echo $x." :: ".$arrgs1[$x]." :: ".$arrgs2[$x];
		}*/
					
		$SetUser = $Search->SearchUser($arrgs2[3],$arrgs2[4],$arrgs2[5]);
		
		
		//-----------------------
		// SEARCH show balance user at USD
		// update at 04.12.18
		$user = new \app\modules\User($arrgs2[3]);
					
        $m_Paysystems = new \app\models\Paysystems();
        $ps = $m_Paysystems->getActiveSystems();
		
		$i = 1;
        foreach ($ps as $row){
        $x[$i] = $user->balance['money_' . $row['name']];

	        $b = number_format(($x[$i]*$this->config['bal_'.$row["currs"]]), '2', '.', ',');
	        $userBalView +=$b;
	        //echo $x[$i]." - ".$row["name"]." - ".$b."<br>";  // проверка правильности НЫНЕ успешна
	        $i++;
        }
		//-----------------------
					
                    //$user->updateData(['banned' => 1]);
                    //$this->setError($this->errors[21]);
                }
            }
        }
        

        require_once($this->render(__METHOD__));
    }
	//---------------------------------------------------------------------
	
	// мультиаккаунты new от 30.08.18
    public function actionMulty() {
		
        $_title['ru'] = 'Мультиаккаунты';
        $_title['en'] = 'Multy User';
		
			$Multy = new \app\models\Multy();
			$MultySET = $Multy->MultyUser();
			
			if(empty($MultySET)){
				$MultySET = 0;
			}
            

        require_once($this->render(__METHOD__));
    }
	//---------------------------------------------------------------------
    
    public function actionReferal($id, $lvl = 1, $page = 1) {
        $user = new \app\modules\User($id);

        if (!$user) {
            header('location: /panel/users');
            return;
        }
        
        $lvl = ($lvl > 0 && $lvl <= $this->config['ref_lvls']) ? $lvl : 1;
        
        $_title['ru'] = 'Пользователь "' . $user->data['user'] . '"';
        $_title['en'] = 'User "' . $user->data['user'] . '" 1';
        
        $m_Userreferal = new \app\models\Userreferal();
        $total = $m_Userreferal->getTotalReferalsLvl($id, $lvl);
		
		//-----------------------
		// BAN the structure
		// update at 04.12.18
		
		
		//-----------------------
		
        $format = '/panel/users/view/' . $user->data['id'] . '/referal/'.$lvl.'/';
        $navigation = \vendor\Paginator::getNavigation($page, $total, $format);
        $referals = $m_Userreferal->getReferalsLvl($id, $lvl, $navigation['lim'], $navigation['on_page']);

        require_once($this->render(__METHOD__));
    }
    
    public function actionWallets($id) {
        $user = new \app\modules\User($id);

        if (!$user) {
            header('location: /panel/users');
            return;
        }
        
        $_title['ru'] = 'Пользователь "' . $user->data['user'] . '"';
        $_title['en'] = 'User "' . $user->data['user'] . '"';
        
        
        $m_Paysystems = new \app\models\Paysystems();
        $ps = $m_Paysystems->getActiveSystems();
        $user->getWallets($ps);
        
        if (isset($_POST['form']) && $_POST['form'] == 'set_wallet_form') {
            
            if (!$this->checkToken($_POST['token'], 'set_wallet_form')) {
                $this->setError($this->errors[1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\SetWalletForm();
                $result = $form->validateFields($_POST, $ps, $user);
                if ($result['error']) {
                    $this->setError($this->errors[$result['error']]);
                }
                else {
                    $m_Userwallets = new \app\models\Userwallets();
                    $wallet = $m_Userwallets->getUserWallet($user->data['id'], $result['fields']['ps']);
                    if ($wallet) {
                        $m_Userwallets->deleteWallet($wallet['id']);
                    }
                    
                    $params = [
                        'user_id' => $user->data['id'],
                        'name' => $result['fields']['ps'],
                        'value' => $result['fields']['purse'],
                    ];
                    
                    $m_Userwallets->insertRow($params);
                    $this->setError($this->errors[22]);
                    $user->getWallets($ps);
                }
            }
        }
        
        require_once($this->render(__METHOD__));
    }
    
}
