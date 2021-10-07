<?php

namespace app\modules\paysystems;

class Ym extends \app\modules\Paysystems {

    public $payconfig = [];
    public $installed = true;
    
    public $name = 'ym';
    public $fullname = 'YandexMoney';
    public $url = 'https://money.yandex.ru';
    public $currs = 'RUB';
    public $format = '%.2f';
    public $min_insert = 1;
    public $max_insert = 1000;
    public $min_payment = 1;
    public $max_payment = 1000;
    public $regex = '^[0-9]{13,16}$';
    
    public $fields = [
        'sci_account' => [
            'regex' => '/^[0-9]{13,16}$/',
            'type' => 'text',
        ],
        'sci_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
        'api_id' => [
            'regex' => '/.*/',
            'type' => 'text',
        ],
        'api_secret' => [
            'regex' => '/.*/',
            'type' => 'password',
        ],
        'api_token' => [
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
            'location' => 'https://money.yandex.ru/quickpay/confirm.xml',
            'method' => 'post',
            'fields' => array(
                'receiver' => $this->payconfig['sci_account'],
                'sum' => $insert_row['sum'] * 1.01,
                'writable-sum' => 'false',
                'formcomment' => '',
                'short-dest' => '',
                'targets' => $insert_row['id'],
                'writable-targets' => 'false',
                'label' => $insert_row['id'],
                'quickpay-form' => 'shop',
                'paymentType' => 'PC',
                'comment-needed' => 'true',
                'comment' => $insert_row['id'],
                'fio' => 0,
                'mail' => 0,
                'phone' => 0,
                'address' => 0
            ),
        );

        return $params;
    }

    public function doPayment($user_data, $amount, $purse) {
        if (!$this->installed) {
            return false;
        }
        $comment = parent::comment($user_data['user']);
        if (!$this->payconfig['api_token']) {
            return false;
        }
        require_once(ROOT . "/vendor/YandexMoney/api.php");
        $api = new \YandexMoney\API($this->payconfig['api_token']);

        $request_payment = $api->requestPayment(array(
            "pattern_id" => "p2p",
            "to" => $purse,
            "amount" => $amount,
            "comment" => $comment,
            "message" => $comment
        ));

        $process_payment = $api->processPayment(array(
            "request_id" => $request_payment->request_id,
        ));

        if ($process_payment->status == 'success') {
            return $process_payment->payment_id;
        }
        return false;
    }
    
    public function handler($post) {
        if (!isset($post["sha1_hash"])) {
            return false;
        }
        
        $secret = $this->payconfig['sci_secret'];
        $sign_hash = sha1(
                $post['notification_type'] . "&" .
                $post['operation_id'] . "&" .
                $post['amount'] . "&" .
                $post['currency'] . "&" .
                $post['datetime'] . "&" .
                $post['sender'] . "&" .
                $post['codepro'] . "&" .
                $secret . "&" .
                $post['label']);
        
        if ($post["sha1_hash"] == $sign_hash) {
            $insid = intval($post['label']);
            $operid = strval($post['operation_id']);
            $amount = floatval($post['amount']);
            $currency = strtoupper($post['currency']);
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
