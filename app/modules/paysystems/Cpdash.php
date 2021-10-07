<?php

namespace app\modules\paysystems;

class Cpdash extends \app\modules\Paysystems {

    public $payconfig = [];
    public $installed = true;
    public $name = 'cpdash';
    public $fullname = 'Dash';
    public $url = 'https://www.coinpayments.net';
    public $currs = 'DASH';
    public $format = '%.8f';
    public $min_insert = 0.001;
    public $max_insert = 2;
    public $min_payment = 0.001;
    public $max_payment = 2;
    public $regex = '^[a-zA-Z0-9]{27,34}$';
    public $fields = [
        'sci_id' => [
            'regex' => '/.*/',
            'type' => 'text',
        ],
        'sci_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
        'api_public' => [
            'regex' => '/.*/',
            'type' => 'text',
        ],
        'api_private' => [
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
        return [
            'location' => 'https://www.coinpayments.net/index.php',
            'method' => 'post',
            'fields' => [
                "cmd" => "_pay_simple",
                "reset" => "1",
                "merchant" => $this->payconfig['sci_id'],
                "currency" => 'DASH',
                'allow_currencies' => 'DASH',
                "amountf" => $insert_row['sum'],
                "item_name" => NAME,
                "invoice" => $insert_row['id'],
                "want_shipping" => "0",
                "success_url" => PROTOCOL . '://' . HOST . '/success',
                "cancel_url" => PROTOCOL . '://' . HOST . '/fail',
                "ipn_url" => PROTOCOL . '://' . HOST . '/handler/' . $this->name,
            ],
        ];
    }

    public function doPayment($user_data, $amount, $purse) {
        if (!$this->installed) {
            return false;
        }
        $comment = parent::comment($user_data['user']);
        $cps = new \vendor\CoinPaymentsAPI();
        $cps->Setup($this->payconfig['api_private'], $this->payconfig['api_public']);
        $result = $cps->CreateWithdrawal($amount, 'DASH', $purse, true);
        
        if ($result['error'] == 'ok') {
            return $result['result']['id'];
	} else {
            return false;
	}

    }

    public function handler($post) {
        if (!isset($post['ipn_mode']) || $post['ipn_mode'] != 'hmac') {
            return false;
        }
        if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
            return false;
        }
        $request = file_get_contents('php://input');
        if ($request === FALSE || empty($request)) {
            return false;
        }
        if (!isset($post['merchant']) || $post['merchant'] != trim($this->payconfig['sci_id'])) {
            return false;
        }
        $hmac = hash_hmac("sha512", $request, trim($this->payconfig['sci_secret']));
//        if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
        if ($hmac != $_SERVER['HTTP_HMAC']) {
            return false;
        }

        $txn_id = $post['txn_id'];
        $inovice = intval($post['invoice']);
        $amount1 = floatval($post['amount1']);
        $currency1 = $post['currency1'];
        $status = intval($post['status']);
        
        if ($status >= 100 || $status == 2) {
            return [
                'insid' => $inovice,
                'operid' => $txn_id,
                'amount' => $amount1,
                'currency' => $currency1,
            ];
        } else if ($status < 0) {
            return false;
        } else {
            return false;
        }
    }

}
