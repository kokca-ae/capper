<?php

namespace app\modules\paysystems;

class Pm extends \app\modules\Paysystems {

    public $payconfig = [];
    public $installed = true;
    
    public $name = 'pm';
    public $fullname = 'PerfectMoney';
    public $url = 'https://perfectmoney.is';
    public $currs = 'USD';
    public $format = '%.2f';
    public $min_insert = 1;
    public $max_insert = 10000;
    public $min_payment = 1;
    public $max_payment = 10000;
    public $regex = '^U[0-9]{7,8}$';
    
    public $fields = [
        'sci_account' => [
            'regex' => '/^U[0-9]{7,8}$/',
            'type' => 'text',
        ],
        'sci_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
        'api_account' => [
            'regex' => '/^U[0-9]{7,8}$/',
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
        $params = array(
            'location' => 'https://perfectmoney.is/api/step1.asp',
            'method' => 'post',
            'fields' => array(
                'PAYEE_ACCOUNT' => $this->payconfig['sci_account'],
                'PAYEE_NAME' => HOST,
                'PAYMENT_UNITS' => 'USD',
                'STATUS_URL' => PROTOCOL . '://' . HOST . '/handler/pm',
                'PAYMENT_URL' => PROTOCOL . '://' . HOST . '/success',
                'NOPAYMENT_URL' => PROTOCOL . '://' . HOST . '/fail',
                'PAYMENT_ID' => $insert_row['id'],
                'PAYMENT_AMOUNT' => $insert_row['sum'],
            ),
        );

        return $params;
    }

    public function doPayment($user_data, $amount, $purse) {
        if (!$this->installed) {
            return false;
        }
        $comment = parent::comment($user_data['user']);
        $f = fopen("https://perfectmoney.is/acct/confirm.asp?AccountID=" . $this->payconfig['api_id'] . "&PassPhrase=" . $this->payconfig['api_secret'] . "&Payer_Account=" . $this->payconfig['api_account'] . "&Payee_Account=" . $purse . "&Amount=" . $amount . "&PAY_IN=" . $amount . "&PAYMENT_ID=" . $time, "rb");
        $out = '';

        while (!feof($f)) {
            $out .= fgets($f);
        }
        fclose($f);

        if (!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)) {
            return false;
        }

        $ar = [];
        foreach ($result as $item) {
            $key = $item[1];
            $ar[$key] = $item[2];
        }

        if ($f === false || isset($ar['ERROR'])) {
            return false;
        } else {
            return $ar['PAYMENT_BATCH_NUM'];
        }
    }
    
    public function handler($post) {
        if (!isset($post["PAYMENT_ID"]) || !isset($post["V2_HASH"])) {
            return false;
        }
        
        $m_key = $this->payconfig['sci_secret'];
        $secret = strtoupper(md5($m_key));
        $hash = $post['PAYMENT_ID'] . ':' .
                $post['PAYEE_ACCOUNT'] . ':' .
                $post['PAYMENT_AMOUNT'] . ':' .
                $post['PAYMENT_UNITS'] . ':' .
                $post['PAYMENT_BATCH_NUM'] . ':' .
                $post['PAYER_ACCOUNT'] . ':' .
                $secret . ':' .
                $post['TIMESTAMPGMT'];
        $hash = strtoupper(md5($hash));
        
        if ($hash == $post['V2_HASH']) {
            $insid = intval($post['PAYMENT_ID']);
            $operid = strval($post['PAYMENT_BATCH_NUM']);
            $amount = floatval($post['PAYMENT_AMOUNT']);
            $currency = strtoupper($post['PAYMENT_UNITS']);
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
