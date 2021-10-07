<?php

namespace app\modules\form\account;

class SetWalletForm extends \app\modules\Form {
    
    public function validateFields($post, $user, $ps) {
        /*if (!isset($post['purse_1']) AND !isset($post['purse_2']) AND !isset($post['purse_3'])) {
            return ['error' => 10];
        }
        if (empty($post['purse_1']) AND empty($post['purse_2']) AND empty($post['purse_3'])) {
            return ['error' => 10];
        }
        if (!isset($post['ps_1']) AND !isset($post['ps_2']) AND !isset($post['ps_3'])) {
            return ['error' => 1];
        }
        if (empty($post['ps_1']) AND empty($post['ps_2']) AND empty($post['ps_3'])) {
            return ['error' => 1];
        }*/
		foreach ($ps as $paysystem) {
            if ($paysystem['name'] == $post['ps_'.$paysystem['name']]) {
                //$system[$i] = $paysystem;
                //break;
			$b = $post['purse_'.$paysystem['name']] ? 1 : 0;
				// все хорошо
            }
			$check_sum +=$b;
		//$i++;
		}
		
		if($check_sum<1){
			return ['error' => 10];
		}
		
		
        return $this->validateValues($post, $user, $ps);

    }
    
    public function validateValues($post, $user, $ps) {
		
		
        foreach ($ps as $paysystem) {
            if ($paysystem['name'] == $post['ps_'.$paysystem['name']]) {
                //$system[$i] = $paysystem;
                //break;
			if(!empty($post['purse_'.$paysystem['name']])){
			$regex = $paysystem['regex'];
			if (!preg_match("/$regex/", $post['purse_'.$paysystem['name']])) {
            return ['error' => 111, 'purse' => $paysystem['fullname']]; // отдача с название кошелька по которому ошибка
			}
			if(!empty($user->wallets[$paysystem['name']]) AND $post['purse_'.$paysystem['name']] !== $user->wallets[$paysystem['name']]) {
            return ['error' => 121, 'purse' => $paysystem['fullname']]; // отдача с название кошелька по которому ошибка
					}
				
				// если в базе нет коша юзера и введеный кош отличен от того что в базе делаем инсерт
				if(empty($user->wallets[$paysystem['name']]) AND $post['purse_'.$paysystem['name']] !== $user->wallets[$paysystem['name']])
					{
				
					$m_Userwallets = new \app\models\Userwallets();
					$params = [
                        'user_id' => $user->usid,
                        'name' => $paysystem['name'],
                        'value' => $post['purse_'.$paysystem['name']],
                    ];
                    $m_Userwallets->insertRow($params);
					// все хорошо
					
				
					}
				
				}
					
            }
		}
        //$system = false;
		//$m_Paysystems = new \app\models\Paysystems();
        //$WMR = $m_Paysystems->getNeedSystem('wmr');
		//$WMZ = $m_Paysystems->getNeedSystem('wmz');
		//$WME = $m_Paysystems->getNeedSystem('wme');
		
		//--
		/*
		$i=1;
        foreach ($ps as $paysystem) {
            if ($paysystem['name'] == $post['ps_']) {
                $system[$i] = $paysystem;
                break;
            }
		$i++;
        }*/
		//--
		
		//$system = $ps;
		
		/*
        if (!$system) {
            return ['error' => 1];
        }*/
		
		//print_r($WMR);
		
		/*
		if(!empty($post['purse_1'])){
			$regex = $WMR[0]['regex'];
			if (!preg_match("/$regex/", $post['purse_1'])) {
            return ['error' => 111];
			}
			
			if(!empty($user->wallets[$post['ps_1']]) AND $post['purse_1'] !== $user->wallets[$post['ps_1']]) {
            return ['error' => 121];
			}
			
		}
		
		if(!empty($post['purse_2'])){
			$regex = $WMZ[0]['regex'];
			if (!preg_match("/$regex/", $post['purse_2'])) {
            return ['error' => 112];
			}
			
			if (!empty($user->wallets[$post['ps_2']]) AND $post['purse_2'] !== $user->wallets[$post['ps_2']]) {
            return ['error' => 122];
			}
			
		}
		
		if(!empty($post['purse_3'])){
			$regex = $WME[0]['regex'];
			if (!preg_match("/$regex/", $post['purse_3'])) {
            return ['error' => 113];
			}
			
			if (!empty($user->wallets[$post['ps_3']]) AND $post['purse_3'] !== $user->wallets[$post['ps_3']]) {
            return ['error' => 123];
			}
			
        }
		*/
		//return $post;
		
        return [
            'error' => false, 
            'fields' => [
                'purse_py' => strval($post['purse_py']),
				'purse_pyusd' => strval($post['purse_pyusd']),
				'purse_pm' => strval($post['purse_pm']),
				'purse_cpbtc' => strval($post['purse_cpbtc']),
				'purse_cpltc' => strval($post['purse_cpltc']),
				'purse_cpeth' => strval($post['purse_cpeth']),
				'purse_cpdoge' => strval($post['purse_cpdoge']),
				'purse_cpdash' => strval($post['purse_cpdash']),
				'usid' => $user->usid,
                ]
            ];
		
    }
    
}
