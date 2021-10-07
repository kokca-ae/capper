<?php

namespace app\modules\paysystems;

class Ac extends \app\modules\Paysystems {
    
    public $payconfig = [];
    public $installed = true;
    
    public $name = 'ac';
    public $fullname = 'AdvCash';
    public $url = 'https://advcash.com';
    public $currs = 'RUB';
    public $format = '%.2f';
    public $min_insert = 6;
    public $max_insert = 10000;
    public $min_payment = 6;
    public $max_payment = 10000;
    public $regex = '^([a-zA-Z0-9\+_\-]+)(\.[a-zA-Z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$';
    
    public $fields = [
        'sci_account' => [
            'regex' => '/^([a-zA-Z0-9\+_\-]+)(\.[a-zA-Z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'type' => 'text',
        ],
        'sci_name' => [
            'regex' => '/^[a-zA-Z0-9]+$/',
            'type' => 'text',
        ],
        'sci_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
        'api_account' => [
            'regex' => '/^([a-zA-Z0-9\+_\-]+)(\.[a-zA-Z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'type' => 'text',
        ],
        'api_name' => [
            'regex' => '/^[a-zA-Z0-9]+$/',
            'type' => 'text',
        ],
        'api_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
    ];
    
    public function __construct() {
        parent::__construct();
    }

    public function prepeareMerchant($insert_row) {
        if (!$this->installed) {
            return false;
        }
        $sign = hash("sha256", $this->payconfig['sci_account'] . ":" . $this->payconfig['sci_name'] . ":" . $insert_row['sum'] . ":RUR:" . $this->payconfig['sci_secret'] . ":" . $insert_row['id']);
        $params = array(
            'location' => 'https://wallet.advcash.com/sci/',
            'method' => 'post',
            'fields' => array(
                'ac_account_email' => $this->payconfig['sci_account'],
                'ac_sci_name' => $this->payconfig['sci_name'],
                'ac_amount' => $insert_row['sum'],
                'ac_currency' => 'RUR',
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
        $arg1->currency = "RUR";
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
    
    public function handler($post) {
        if (!isset($post["ac_order_id"]) || !isset($post["ac_hash"])) {
            return false;
        }
        
        $ac_key = $this->payconfig['sci_secret'];
        $sign_hash = hash("sha256", $post['ac_transfer'] . ":" .
                $post['ac_start_date'] . ":" .
                $post['ac_sci_name'] . ":" .
                $post['ac_src_wallet'] . ":" .
                $post['ac_dest_wallet'] . ":" .
                $post['ac_order_id'] . ":" .
                $post['ac_amount'] . ":" .
                $post['ac_merchant_currency'] . ":" .
                $ac_key);
        
        if ($post["ac_hash"] == $sign_hash) {
            $insid = intval($post['ac_order_id']);
            $operid = strval($post['ac_transfer']);
            $amount = floatval($post['ac_amount']);
            $currency = ($post['ac_merchant_currency'] == 'USD') ? 'USD' : 'RUB';
            return [
                'insid' => $insid,
                'operid' => $operid,
                'amount' => $amount,
                'currency' => $currency,
            ];
        }
        return false;
    }

}
