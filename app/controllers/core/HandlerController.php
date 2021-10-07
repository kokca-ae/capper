<?php

namespace app\controllers\core;

class HandlerController extends \app\base\Controller {
    
    private $config;
    
    public function __construct() {
        parent::__construct(__CLASS__);

        $m_Config = new \app\models\Config();
        $this->config = $m_Config->getConfig();
    }
    
    public function actionIndex($name) {
        $m_Ps = new \app\models\Paysystems();
        $paysystem = $m_Ps->findOne($name, 'name');
        if (!$paysystem) {
            exit;
        }
        if ($paysystem['active'] != 1) {
            exit;
        }
        if ($paysystem['active_insert'] != 1) {
            exit;
        }
        $ps = \app\modules\Paysystems::getSystem($name);
        if (!$ps) {
            exit;
        }
        
        $result = $ps->handler($_POST);
        if ($result) {
            $insid = $result['insid'];
            $operid = $result['operid'];
            $amount = $result['amount'];
            $currency = $result['currency'];
            
            $insert = new \app\modules\Insert();
            $result = $insert->insert($paysystem, $this->config, $insid, $operid, $amount, $currency);
            
            if ($result) {
                $referal = new \app\modules\Referal();
                $referal->referalMoney($paysystem, $this->config, $result['sum'], $result['user_id']);
            }
            exit;
        }

    }

}
