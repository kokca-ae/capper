<?php

namespace app\modules\paysystems;

class Py extends \app\modules\Paysystems {

    public $payconfig = [];
    public $installed = true;
    
    public $name = 'py';
    public $fullname = 'Payeer';
    public $url = 'https://payeer.com';
    public $currs = 'RUB';
    public $format = '%.2f';
    public $min_insert = 1;
    public $max_insert = 10000;
    public $min_payment = 1;
    public $max_payment = 10000;
    public $regex = '^P[0-9]{7,13}$';
    
    public $fields = [
        'sci_id' => [
            'regex' => '/^[0-9]+$/',
            'type' => 'text',
        ],
        'sci_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
        'api_account' => [
            'regex' => '/^P[0-9]{7,13}$/',
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
        $m_shop = $this->payconfig['sci_id'];
        $m_orderid = $insert_row['id'];
        $m_amount = number_format($insert_row['sum'], 2, ".", "");
        $m_curr = "RUB";
        $m_desc = base64_encode(HOST);
        $m_key = $this->payconfig['sci_secret'];

        $arHash = array(
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc,
            $m_key
        );

        $sign = strtoupper(hash('sha256', implode(":", $arHash)));

        $params = array(
            'location' => 'https://payeer.com/api/merchant/m.php',
            'method' => 'get',
            'fields' => array(
                'm_shop' => $m_shop,
                'm_orderid' => $m_orderid,
                'm_amount' => $m_amount,
                'm_curr' => $m_curr,
                'm_desc' => $m_desc,
                'm_sign' => $sign,
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
        if ($arBalance["auth_error"] != 0) {
            return false;
        }

        $balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
        if (($balance) < ($amount)) {
            return false;
        }

        $arTransfer = $payeer->transfer(array(
            'curIn' => 'RUB',
            'sum' => $amount,
            'curOut' => 'RUB',
            'to' => $purse,
            'comment' => $comment,
            'anonim' => 'Y',
        ));

        if ($arTransfer["historyId"] > 0) {
            return $arTransfer["historyId"];
        }
        return false;
    }
    
    public function handler($post) {
        if (!isset($post["m_operation_id"]) || !isset($post["m_sign"])) {
            return false;
        }
        
        $m_key = $this->payconfig['sci_secret'];
        $arHash = [
            $post['m_operation_id'],
            $post['m_operation_ps'],
            $post['m_operation_date'],
            $post['m_operation_pay_date'],
            $post['m_shop'],
            $post['m_orderid'],
            $post['m_amount'],
            $post['m_curr'],
            $post['m_desc'],
            $post['m_status'],
            $m_key
        ];
        
        $sign_hash = strtoupper(hash('sha256', implode(":", $arHash)));
        if ($post["m_sign"] == $sign_hash && $post['m_status'] == "success") {
            $insid = intval($post['m_orderid']);
            $operid = intval($post['m_operation_id']);
            $amount = floatval($post['m_amount']);
            $currency = strtoupper($post['m_curr']);
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
