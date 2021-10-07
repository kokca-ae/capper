<?php

namespace app\modules\paysystems;

class Acusd extends Ac {
    
    public $name = 'acusd';
    public $fullname = 'AdvCashUSD';
    public $currs = 'USD';
    public $min_insert = 1;
    public $max_insert = 10000;
    public $min_payment = 1;
    public $max_payment = 10000;
    
    public function __construct() {
        parent::__construct();
    }

    public function prepeareMerchant($insert_row) {
        if (!$this->installed) {
            return false;
        }
        $sign_params = $this->payconfig['sci_account'] . ':' . $this->payconfig['sci_name'] . ':' . $insert_row['sum'] . ':' . 'USD' . ':' . $this->payconfig['sci_secret'] . ':' . $insert_row['id'];
        $sign = hash('sha256', $sign_params);
        $params = array(
            'location' => 'https://wallet.advcash.com/sci/',
            'method' => 'post',
            'fields' => array(
                'ac_account_email' => $this->payconfig['sci_account'],
                'ac_sci_name' => $this->payconfig['sci_name'],
                'ac_amount' => $insert_row['sum'],
                'ac_currency' => 'USD',
                'ac_order_id' => $insert_row['id'],
                'ac_sign' => $sign,
            ),
        );

        return $params;
    }

    public function doPayment($user_data, $amount, $purse) {
        if (!$this->installed) {
            return false;
        }
        $comment = parent::comment($user_data['user']);
        require_once(ROOT . "/vendor/MerchantWebService.php");
        $merchantWebService = new \MerchantWebService();

        $arg0 = new \authDTO();
        $arg0->apiName = $this->payconfig['api_name'];
        $arg0->accountEmail = $this->payconfig['api_account'];
        $arg0->authenticationToken = $merchantWebService->getAuthenticationToken($this->payconfig['api_secret']);

        $arg1 = new \sendMoneyRequest();
        $arg1->amount = sprintf("%.2f", $amount);
        $arg1->currency = "USD";
        $arg1->email = $purse;
        $arg1->note = $comment;
        $arg1->savePaymentTemplate = false;

        $validationSendMoney = new \validationSendMoney();
        $validationSendMoney->arg0 = $arg0;
        $validationSendMoney->arg1 = $arg1;

        $sendMoney = new \sendMoney();
        $sendMoney->arg0 = $arg0;
        $sendMoney->arg1 = $arg1;

        try {

            $merchantWebService->validationSendMoney($validationSendMoney);
            $sendMoneyResponse = $merchantWebService->sendMoney($sendMoney);

            if ($res = strval($sendMoneyResponse->return)) {
                return $res;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

}
