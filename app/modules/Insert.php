<?php

namespace app\modules;

class Insert extends \app\base\Module {
    
    public function insert($ps, $config, $insid, $operid, $amount, $currency) {
        
        $m_Insert = new \app\models\Insert();
        $insert_row = $m_Insert->findOne($insid);

        if (!$insert_row) {
            return false;
        }
        if ($insert_row["sum"] > $amount) {
            return false;
        }
        if ($insert_row["currs"] != $currency) {
            return false;
        }
        if ($insert_row["status"] > 0) {
            return false;
        }

        $m_Plan = new \app\models\Plans();
        $plan = $m_Plan->findOne($insert_row['plan']);

        if (!$plan) {
            return false;
        }

        $params = [
            'status' => 1,
            'date_add' => time(),
            'oper_id' => $operid,
        ];
        $m_Insert->updateRow($params, $insid);

        $m_Deposits = new \app\models\Deposits();
        $params = [
            'user_id' => $insert_row['user_id'],
            'user' => $insert_row['user'],
            'plan' => $insert_row['plan'],
            'sum' => $insert_row['sum'],
            'payment_system' => $ps['name'],
            'currs' => $ps['currs'],
            'sum_earn' => 0,
            'count_earn' => 0,
            'plan_name' => $plan['name'],
            'plan_perc' => $plan['perc'],
            'plan_term' => $plan['term'],
            'plan_earns' => $plan['earns'],
            'plan_back' => $plan['back'],
            'date_add' => time(),
			'date_upd' => time()+$plan['term'],
			'date_del' => time()+$plan['term']*$plan['earns'],
            'status' => 1,
        ];
        $m_Deposits->insertRow($params);
        
        $sum_i = $insert_row['sum'] * $config['bal_' . $ps['currs']];
        $user = new \app\modules\User($insert_row['user_id']);
        $params = [
            'insert_sum' => $user->balance['insert_sum'] + $sum_i,
        ];
        $user->updateBalance($params);
        return $insert_row;
    }
    
}
