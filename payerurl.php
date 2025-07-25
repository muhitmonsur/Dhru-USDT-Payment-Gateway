<?php
defined("DEFINE_MY_ACCESS") or die ('<h1 style="color: #C00; text-align: center;"><strong>Restricted Access</strong></h1>'); 

function payerurl_config() {
    $configarray = array(						
        'name' => array('Type' => 'System','Value' => 'USDT, ETH, BTC, Binance Pay(Payerurl)'),
        'payerurl_public_key' => array('Name'=>'Payerurl Public Key', 'Type' => 'text','Value' => '','Size' => '40','Description' => '<a href="https://dash.payerurl.com/" target="_blank" style="color:blue;">Get API Public and Secret key</a>'),
        'payerurl_secret_key' => array('Name'=>'Payerurl Secret Key', 'Type' => 'text','Value' => '','Size' => '40'),
		'trc20_network_fee' => array('Name'=>'TRC20 Network Fee', 'Type' => 'text','Value' => '1','Size' => '10'),
        'email' => array('Name' => 'Payerurl Email','Type' => 'text','Size' => '40','Description' => 'Login Mail.'),
        'SendBox' => array('Name' => 'Demo Mode SendBox ','Type' => 'yesno'),
        'info' => array('Name' => 'Other Information','Type' => 'textarea','Cols' => '5','Rows' => '10')
    );
    return $configarray;
}

function payerurl_link($PARAMS) {
    global $lng_languag;
    $code = '';
    $invoiceid = $PARAMS['invoiceid'];
    $invoiceWithoutFee = $PARAMS['amount'];
    $invoicetotal = $PARAMS['amount'];
	$trc20_network_fee = $PARAMS['trc20_network_fee'];
	$trc20_network_fee = formatCurrency2($trc20_network_fee);
    $invoicetotal = formatCurrency2($invoicetotal);
	
$invoicetotal = $invoicetotal + $trc20_network_fee;
   
    //$feeCalc =  $invoicetotal/100;
    $PARAMS['description'] = "Invoice Amount: $invoiceWithoutFee <br>"."TRC20 fee: $trc20_network_fee USDT<br>Item qty: ";
    
    $items = array(  'name' => empty($PARAMS['description']) ? "":trim($PARAMS['description']),
                      'qty' => 1,
                     'price' => $invoicetotal,
                );
    
    	$args = [
        'order_id' => $invoiceid,
        'amount' => $invoicetotal,
        'currency' => empty($PARAMS['currency'])? "usdt" : strtolower($PARAMS['currency']),
        'items' => [0 => $items ],
        'billing_fname' => empty($PARAMS['clientdetails']['firstname']) ? "undefine":trim($PARAMS['clientdetails']['firstname']),
        'billing_lname' => empty($PARAMS['clientdetails']['lastname']) ? "undefine":trim($PARAMS['clientdetails']['lastname']),
        'billing_email' => empty($PARAMS['clientdetails']['email']) ? "undefine@gmail.com" : trim($PARAMS['clientdetails']['email']),
        'redirect_to' => $PARAMS['systemurl'] . 'settings/statement',
        'cancel_url' => substr_replace($PARAMS['systemurl'],"",-1).$_SERVER['REQUEST_URI'] . '',  // replace last '/' from systemurl
        'notify_url' => $PARAMS['systemurl'] . 'payerurl_res.php',  // PayerURL will send a callback to this URL once the payment is successfully completed.
        'type' => 'dhru',
    ];
    
    ksort($args);
    $args = http_build_query($args);
    $signature = hash_hmac('sha256', $args, trim($PARAMS['payerurl_secret_key']));
    $authStr = base64_encode(sprintf('%s:%s', trim($PARAMS['payerurl_public_key']), $signature));
    // var_dump($authStr);
    // exit(0);
    
    
    

    
    
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api-v2.payerurl.com/api/payment');
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type:application/x-www-form-urlencoded;charset=UTF-8',
        'Authorization:' . sprintf('Bearer %s', $authStr),
    ]);
    $response = curl_exec($ch);
    $response_log_str = $response;
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $response = json_decode($response);

$res = "args: ".$args;
$res .= "\r\n";
$res .= "authStr: ".$authStr;
$res .= "\r\n";
$res .= "response: $response_log_str";
$res .= "\r\n\r\n";
//echo "$res";
$filename = "dhu_req_log.log";
$fh = fopen($filename, "a");  // log file will be generate in the root folder
fwrite($fh, $res);
fclose($fh);


    if($httpCode === 200 && isset($response->redirectTO) && !empty($response->redirectTO)){
        $code = '<a class="btn btn-primary pt-3 pb-3" href="'.$response->redirectTO.'">'.$lng_languag["invoicespaynow"].'</a>';
    } else {
        $code = '<p style="color:red;">An error occurred</p>';
    }
    return $code;
}
?>
