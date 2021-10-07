<?php

namespace app\modules;

class User extends \app\base\Module {

    public $usid;
    public $data;
    public $balance;
    public $referal;
    public $wallets;

    public function __construct($usid = false) {
        $this->usid = $usid;
        if ($this->usid) {
            $m_Userdata = new \app\models\Userdata();
            $this->data = $m_Userdata->findOne($this->usid);

            $m_Userbalance = new \app\models\Userbalance();
            $this->balance = $m_Userbalance->findOne($this->usid);

            $m_Userreferal = new \app\models\Userreferal();
            $this->referal = $m_Userreferal->findOne($this->usid);
        }
    }

    public function getWallets($paysystems) {
        $m_Userwallets = new \app\models\Userwallets();
        $this->wallets = $m_Userwallets->getUserWallets($paysystems, $this->usid);
    }
    
    public function updateData($fields) {
        $m_Userdata = new \app\models\Userdata();
        $m_Userdata->updateRow($fields, $this->usid);
        foreach ($fields as $field => $value) {
            $this->data[$field] = $value;
        }
    }
    
    public function updateBalance($fields) {
        $m_Userbalance = new \app\models\Userbalance();
        $m_Userbalance->updateRow($fields, $this->usid);
        foreach ($fields as $field => $value) {
            $this->balance[$field] = $value;
        }
    }
    
    public function updateReferal($fields) {
        $m_Userreferal = new \app\models\Userreferal();
        $m_Userreferal->updateRow($fields, $this->usid);
        foreach ($fields as $field => $value) {
            $this->referal[$field] = $value;
        }
    }

    public function recovery($data) {
        $ip = $this->getUserIp(1);
        $key = md5(time());
        $key_crypted = $key;
        $link = PROTOCOL . '://' . HOST . '/recovery/reset/' . $key;

        $fields = [
            'email' => $data['email'],
            'user_id' => $data['id'],
            'ip' => $ip,
            'date_add' => time(),
            '_key' => $key_crypted,
            'status' => 0,
        ];
        $m_Recovery = new \app\models\Recovery();
        $m_Recovery->insertRow($fields);

        return ['error' => false, 'fields' => $fields, 'link' => $link];
    }

    public function login($data) {
        $m_Userdata = new \app\models\Userdata();

        $salt = md5(time());
        $params = [
            'date_login' => time(),
            'ip' => $this->getUserIp(1),
            'salt' => $salt,
        ];
        $m_Userdata->updateRow($params, $data['id']);
        return ['salt' => $salt, 'id' => $data['id']];
    }

    public function signup($fields, $config) {

        $m_Userdata = new \app\models\Userdata();
        
        $ip = $this->getUserIp(1);
        $salt = md5(time());

        $lid = $m_Userdata->insertRow([
            'user' => $fields['login'],
            'email' => $fields['email'],
            'password' => $fields['password'],
            'date_reg' => time(),
            'ip' => $ip,
			'ip_reg' => $ip,
            'salt' => $salt,
        ]);

        $m_Userbalance = new \app\models\Userbalance();
        $m_Userbalance->insertRow([
            'id' => $lid,
        ]);

        $m_Userreferal = new \app\models\Userreferal();
        $referal_params = [
            'id' => $lid,
            'user' => $fields['login'],
        ];
        
		// 117, 118, 119 referer_id сменены на referer_login поскольку принимает логин в сессию на HomeController
		$referer_login = (isset($_SESSION["ref"])) ? $_SESSION["ref"] : "None";
        if ($referer_login) {
            $referer = $m_Userreferal->findOne($referer_login, "user"); // теперь по полю юзер идет выборка
            for ($i = 1; $i <= $config['ref_lvls']; $i++) {
                if ($referer) {
                    $referer_params = [
                        'count_ref' . $i => $referer['count_ref' . $i] + 1,
						'all_count_refs' => $referer['all_count_refs'] + 1, // обновление общего числа рефов у реферера с уровней
                    ];
                    $m_Userreferal->updateRow($referer_params, $referer['id']);

                    $referal_params['referer' . $i] = $referer['user'];
                    $referal_params['referer' . $i . '_id'] = $referer['id'];
                    $referer = $m_Userreferal->findOne($referer['referer1_id']);
                }
            }
        }
        $m_Userreferal->insertRow($referal_params);
        return ['error' => false];
    }

}
