<?php

namespace app\modules;

class Referal extends \app\base\Module {
    
    public function referalMoney($ps, $config, $amount, $user_id) {
        $user = new User($user_id); // обращение к таблицам самого юзера
        if ($user->referal['referer1_id'] == 0) {
            return false;
        }
        $m_Earn = new \app\models\Earn();
        for ($i = 1; $i <= $config['ref_lvls']; $i++)
        {
            $ref_id = $user->referal['referer' . $i . '_id'];
            if ($ref_id > 0) {
                
                $referer = new User($ref_id); // обращение к таблицам аплайнерам структуры (к тем кому юзер приходится рефом такого-то уровня)
				// получает 3 показателя аплайнера (баланс / рефку / инфу) уровня $i
				
                $to_referer = $config['ref' . $i] / 100 * $amount;
                $balance_params = [
                    'money_' . $ps['name'] => $referer->balance['money_' . $ps['name']] + $to_referer, // считает сколько денег на этой ЭПС + от рефа
                ];
                $to_referer_i = $to_referer * $config['bal_' . $ps['currs']]; // считает сколько $ аплайнеру из валюты пополнения рефом по курсу
                $referal_params = [ 'from_referals' . $i => $referer->referal['from_referals' . $i] + $to_referer_i, 'all_from_referals' => $referer->referal['all_from_referals'] + $to_referer_i,]; // получил с рефов такого то уровня
				$user_params = [ 'to_referer' . $i => $user->referal['to_referer' . $i] + $to_referer_i, 'all_to_referer' => $user->referal['all_to_referer'] + $to_referer_i,]; // отдал аплайнеру такого то уровня

                $referer->updateBalance($balance_params);
                $referer->updateReferal($referal_params);
				$user->updateReferal($user_params);
				
                $earn_params = [
                    'user_id' => $referer->data['id'],
                    'user' => $referer->data['user'],
                    'sum' => $to_referer,
                    'payment_system' => $ps['name'],
                    'currs' => $ps['currs'],
                    'date_add' => time(),
                    'type' => 1,
                    'info' => $user->data['user'],
                ];
                $m_Earn->insertRow($earn_params);
				
				
				
				
                //$params['to_referer' . $i] = $to_referer_i;
            }
        }
				$ref_id = $user->referal['referer1_id'];
				if ($ref_id > 0) {
                
                $referer = new User($ref_id);
				$to_referer = $config['ref1'] / 100 * $amount;
				if($referer->data['refback']>0){
					$refback_percent = $referer->data['refback_percent'];
					if($refback_percent>0 and $refback_percent<101) 
					{
					$refback_params = ['money_' . $ps['name'] => $user->balance['money_' . $ps['name']] + ($refback_percent/100)*$to_referer, // РЕФБЭК
                ];
				$refback_params_referer = ['money_' . $ps['name'] => $referer->balance['money_' . $ps['name']] - (($refback_percent/100)*$to_referer),];
				$user->updateBalance($refback_params);
				$referer->updateBalance($refback_params_referer);
				
				$refback_referer = [
                    'user_id' => $referer->data['id'],
                    'user' => $referer->data['user'],
                    'sum' => ($refback_percent/100)*$to_referer,
                    'payment_system' => $ps['name'],
                    'currs' => $ps['currs'],
                    'date_add' => time(),
                    'type' => 3,
                    'info' => $user->data['user'],
                ];
				
				$refback_user = [
                    'user_id' => $user->data['id'],
                    'user' => $user->data['user'],
                    'sum' => ($refback_percent/100)*$to_referer, //
                    'payment_system' => $ps['name'],
                    'currs' => $ps['currs'],
                    'date_add' => time(),
                    'type' => 4,
                    'info' => $referer->data['user'],
                ];
				
				$m_Earn->insertRow($refback_user);
				$m_Earn->insertRow($refback_referer);
						}

					}
				}
		
				
        return true;
    }
    
}
