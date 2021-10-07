<?php

namespace app\modules\paysystems;

class Fkqw extends \app\modules\Paysystems {

    public $payconfig = [];
    public $installed = true;
    
    public $name = 'fkqw';
    public $fullname = 'Qiwi';
    public $url = 'http://www.free-kassa.ru, https://payeer.com';
    public $currs = 'RUB';
    public $format = '%.2f';
    public $min_insert = 1;
    public $max_insert = 1000;
    public $min_payment = 1;
    public $max_payment = 1000;
    public $regex = '^\+(91|994|82|372|375|374|44|998|972|66|90|81|1|507|7|77|380|371|370|996|9955|992|373|84)[0-9]{6,14}$';
    
    public $fields = [
        'sci_id' => [
            'regex' => '/^[0-9]+$/',
            'type' => 'text',
        ],
        'sci_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
        'sci_secret2' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
        'api_account' => [
            'regex' => '/^P[0-9]{7,8}$/',
            'type' => 'text',
        ],
        'api_id' => [
            'regex' => '/^[0-9]+$/',
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
        $sum = number_format($insert_row['sum'], 2, ".", "");
        $sign = md5( $this->payconfig['sci_id'] . ":" . $sum . ":" . $this->payconfig['sci_secret'] . ":" . $insert_row['id'] );

        $params = array(
            'location' => 'http://www.free-kassa.ru/merchant/cash.php',
            'method' => 'get',
            'fields' => array(
                'm' => $this->payconfig['sci_id'],
                'i' => 155,
                'oa' => $sum,
                'o' => $insert_row['id'],
                's' => $sign,
                ),
            );

        return $params;
    }

    public function doPayment($user_data, $amount, $purse) {
        if (!$this->installed) {
            return false;
        }
        $comment = parent::comment($user_data['user']);
        $payeer = new \vendor\Payeer($this->payconfig['api_account'], $this->payconfig['api_id'], $this->payconfig['api_secret']);

        if (!$payeer->isAuth()) {
            return false;
        }
        $arBalance = $payeer->getBalance();
        if($arBalance["auth_error"] != 0) {
            return false;
        }
        $balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
        if($balance < $amount) {
            return false;
        }

        $arTransfer = $payeer->initOutput(array(
            // 'ps' => '26808',
            'ps' => '60792237',
            'curIn' => 'RUB',
            'sumOut' => $amount,
            'curOut' => 'RUB',
            'param_ACCOUNT_NUMBER' => $purse,
            'comment' => $comment,
            ));
        
        if (!$arTransfer) {
            return false;
        }

        $historyId = $payeer->output();
        if ($historyId > 0) {
            return $historyId;
        }
        return false;
    }
    
    public function handler($post) {
        if (!isset($post['SIGN'])) {
            return false;
        }
        
        $hash = md5($post['MERCHANT_ID'] . ":" . $post['AMOUNT'] . ":" . $this->payconfig['sci_secret2'] . ":" . $post['MERCHANT_ORDER_ID']);
        
        if ($hash == $post['SIGN']) {
            $insid = intval($post['MERCHANT_ORDER_ID']);
            $operid = strval($post['intid']);
            $amount = floatval($post['AMOUNT']);
            $currency = 'RUB';
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
