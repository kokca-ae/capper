<?php

namespace app\controllers\admin;

class LimitsController extends \app\base\AdminController {

    function __construct() {
        parent::__construct(__CLASS__);
    }
    
    public function actionIndex($page = 1) {
        $_title['ru'] = 'Настройки лимитов';
        $_title['en'] = 'Change Limits';
		
		$m_Limits = new \app\models\Limits(); // new 24.08.18
		$Limit = $m_Limits->getLimits(); // new 24.08.18
		
		//print_r($Limit); // включать только для отладки 30.08.18
        
        if (isset($_POST['form']) && $_POST['form'] == 'limits_form') {
            
            if (!$this->checkToken($_POST['token'], 'limits_form')) {
                $this->setError($this->errors[$this->lang][1]);
            }
            if (!$this->error) {
                $form = new \app\modules\form\admin\LimitsForm();
                $result = $form->validateFields($_POST);
				
				//print_r($result); // включать только для отладки 30.08.18
				
				
                if ($result['error']) {
                    $this->setError($this->errors[$this->lang][$result['error']]);
                }
                else {
        
		$m_Lim = new \app\models\Limits();
					
        $arrgs1 = [];
		$arrgs2 = [];
		
		$i = 1;
        foreach ($result['fields'] as $key => $value) {
            $arrgs1[$i] = $key;
            $arrgs2[$i] = $value;
			$m_Lim->updateCurrs($arrgs1[$i],$arrgs2[$i]);
			$i++;
        }
		/* // включать только для отладки 30.08.18
		for($x=1;$x<$i;$x++){
		echo "<br>";
		echo $x." :: ".$arrgs1[$x]." :: ".$arrgs2[$x];
		}*/
					
                    //$m_Lim->updateCurrs($result['fields']);
                    $this->setError($this->errors[$this->lang][20]);
                    $Limit = $m_Limits->getLimits(); // new 30.08.18
                }
            }
			
        }
        
        require_once($this->render(__METHOD__));
    }

}
