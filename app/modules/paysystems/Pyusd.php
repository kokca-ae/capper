<?php

namespace app\modules\paysystems;

class Pyusd extends Py {

    public $name = 'pyusd';
    public $fullname = 'PayeerUSD';
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
        $m_shop = $this->payconfig['sci_id'];
        $m_orderid = $insert_row['id'];
        $m_amount = number_format($insert_row['sum'], 2, ".", "");
        $m_curr = "USD";
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

        $balance = $arBalance["balance"]["USD"]["DOSTUPNO"];
        if ($balance < $amount) {
            return false;
        }

        $arTransfer = $payeer->transfer(array(
            'curIn' => 'USD',
            'sum' => $amount,
            'curOut' => 'USD',
            'to' => $purse,
            'comment' => $comment,
            'anonim' => 'Y',
        ));

        if ($arTransfer["historyId"] > 0) {
            return $arTransfer["historyId"];
        }
        return false;
    }

}
