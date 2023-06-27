<?php

define("DEFINE_MY_ACCESS", true);
define("DEFINE_DHRU_FILE", true);
include 'comm.php';
require 'includes/fun.inc.php';
include 'includes/gateway.fun.php';
include 'includes/invoice.fun.php';


//if(!isset($_SERVER['HTTP_AUTHORIZATION']) || empty($_SERVER['HTTP_AUTHORIZATION']))exit();


$GATEWAY = loadGatewayModule('payerurl');

$res = file_get_contents('php://input');
$text = $res;
$text .= "\r\n\r\n";
$log_file_name = "dhu_resps_log.log";
date_default_timezone_set('Asia/Dhaka');
$timestamp = date('Y-m-d H:i:s');
$log_msg = $timestamp. "log message:" ."\n";



if(!isset($_SERVER['HTTP_AUTHORIZATION']) || empty($_SERVER['HTTP_AUTHORIZATION']))
{
    $log_msg .= "Inside if block: get authStr from _POST\n";
    file_put_contents($log_file_name, $log_msg,FILE_APPEND);
    $authStr_post = base64_decode($_POST['authStr']);
    $auth = explode(':', $authStr_post);

}else
{
    $log_msg .= "Inside else block: get authStr from _SERVER\n";
    file_put_contents($log_file_name, $log_msg,FILE_APPEND);
    $authStr = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
    $authStr = base64_decode($authStr);
    $auth = explode(':', $authStr);


}

//if($GATEWAY['payerurl_public_key'] != $auth[0])exit();

$GETDATA = [
    'order_id' => $_POST['order_id'],
    'ext_transaction_id' => isset($_POST['ext_transaction_id']) ? $_POST['ext_transaction_id'] : '',
    'transaction_id' => $_POST['transaction_id'],
    'status_code' => isset($_POST['status_code']) ? (int)$_POST['status_code'] : '',
    'note' => isset($_POST['note']) ? $_POST['note'] : '',
    'confirm_rcv_amnt' => isset($_POST['confirm_rcv_amnt']) ? (float)$_POST['confirm_rcv_amnt'] : 0,
    'confirm_rcv_amnt_curr' => isset($_POST['confirm_rcv_amnt_curr']) ? $_POST['confirm_rcv_amnt_curr'] : '', 
    'coin_rcv_amnt' => isset($_POST['coin_rcv_amnt']) ? (float)$_POST['coin_rcv_amnt'] : 0, 
    'coin_rcv_amnt_curr' => isset($_POST['coin_rcv_amnt_curr']) ? $_POST['coin_rcv_amnt_curr'] : '', 
    'txn_time' => isset($_POST['txn_time']) ? $_POST['txn_time'] : '' 
];

$log_msg .= "GETDATA".print_r($GETDATA,true)."\n";
$log_msg .= "GATEWAY['payerurl_public_key']".$GATEWAY['payerurl_public_key']."\n";
$log_msg .= "auth[0]".$auth[0]."\n";
$log_msg .= "auth[1]".$auth[1]."\n";


if($GATEWAY['payerurl_public_key'] != $auth[0])
{
        $data = [ 
        'message' => "Credentials no match",
        'status' => '2030'
        ];

    file_put_contents($log_file_name, $log_msg,FILE_APPEND);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);

    exit();
}




if ($GETDATA['status_code'] != 200 )
{
    logTransaction('payerurl', $GETDATA , 'Pending');
    $log_msg .= "GETDATA['status_code'] != 200". "\n";
    file_put_contents($log_file_name, $log_msg,FILE_APPEND);
    $data = [ 
        'message' => "Order Cancelled",
        'status' => '20000'
        ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);


    exit();
}

if (!isset($_POST['order_id']) || empty($_POST['order_id'])) {
    logTransaction('payerurl', $GETDATA , 'Pending');
    $log_msg .= "Order ID not found". "\n";
    file_put_contents($log_file_name, $log_msg,FILE_APPEND);
    $data = [ 
        'message' => "Order ID not found",
        'status' => '2050'
        ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);

    exit();
}

if (!isset($_POST['transaction_id']) || empty($_POST['transaction_id'])){
    $log_msg .= "_POST['transaction_id']". "\n";
    file_put_contents($log_file_name, $log_msg,FILE_APPEND);
    logTransaction('payerurl', $GETDATA , 'Pending');

    $data = [ 
        'message' => "Transaction ID not found",
        'status' => '2050'
        ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);

    exit();
}





ksort($GETDATA);
$args = http_build_query($GETDATA);
$signature = hash_hmac('sha256', $GETDATA, $GATEWAY['payerurl_secret_key']);
$authStr = base64_encode(sprintf('%s:%s', $GATEWAY['payerurl_public_key'], $signature));
// if($signature != $auth[1]) {
//     logTransaction('payerurl', $GETDATA , 'Pending');
//     header('Content-Type: application/json; charset=utf-8');
//     echo json_encode($signature);
//     exit();
// }

$GETDATA['FEE'] = 0;

//$GETDATA['confirm_rcv_amnt'] = $GETDATA['confirm_rcv_amnt'] +  (2 / 100) * $GETDATA['confirm_rcv_amnt'];  // tolerance amount 1%:     $amount + 1% of amount

$text .= "confirm_rcv_amnt: ".$GETDATA['confirm_rcv_amnt'];
$text .= "\r\n\r\n";
// fwrite($fh, $text);
// fclose($fh);



if (isset($GETDATA['order_id']))
{   
    $log_msg .= "Inside Add payment". "\n"; 
    file_put_contents($log_file_name, $log_msg,FILE_APPEND);
    


    // Add payment 
    
    addPayment($GETDATA['order_id'], $GETDATA['transaction_id'], $GETDATA['confirm_rcv_amnt'], $GETDATA['FEE'], 'USDT,BTC,ETH, Binance Pay');
    
    logTransaction('USDT,BTC,ETH, Binance Pay', $_POST , 'Successful');


    
    $data = [ 
        'message' => "Order updated successfully",
        'status' => '2040'
        ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    
    exit();
}


file_put_contents($log_file_name, $log_msg,FILE_APPEND);

?>