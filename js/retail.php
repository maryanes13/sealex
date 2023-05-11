<?php

//$_SERVER['REMOTE_ADDR'] = '1.1.1.1';

define('SPAM_PAUSE', 600);	// in seconds

$spam = Array();
$spam1 = Array();

$fOff = FALSE;

if (!file_exists('spamcontrol.txt')) {
	touch('spamcontrol.txt');
}
$spam1 = file('spamcontrol.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// kill old records
foreach($spam1 as $v) {
	$i = explode(' ', $v);
	if ($i[1] + SPAM_PAUSE > time()) {
		array_push($spam, $v);
	}
}
unset($spam1);

// search IP in record
$ip = $_SERVER['REMOTE_ADDR'];
$n = FALSE;
foreach($spam as $k => $v) {
	if (substr($v, 0, strpos($v, ' ')) == $ip) {
		$n = $k;
		break;
	}
}
$visitCount = 0;
if ($n !== FALSE) {
	$lastVisit = explode(' ', $spam[$n]);
	$visitCount = $lastVisit[2];
	$lastVisit[1] = time();
	if ($lastVisit[2]++ >= 2) {	// get away
		$fOff = TRUE;
	}
	$spam[$n] = implode(' ', $lastVisit);
} else {
	array_push($spam, $ip . ' ' . time() . ' 1'); // first visit
}
file_put_contents('spamcontrol.txt', implode("\r\n", $spam));

$sendMail = FALSE;
if ($fOff) return;
if ($visitCount < 2) {
	$sendMail = TRUE;
}
if ($visitCount == 0) register();

function register() {
	$_POST['lastname'] = isset($_POST['lastname']) ? $_POST['lastname'] : '';
	$_POST['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
	$_POST['email'] = isset($_POST['email']) ? $_POST['email'] : '';
	$_POST['comment'] = isset($_POST['comment']) ? $_POST['comment'] : '';
	
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = @$_SERVER['REMOTE_ADDR'];
$result  = array('country'=>'', 'city'=>'');
if(filter_var($client, FILTER_VALIDATE_IP)){
    $ip = $client;
}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
    $ip = $forward;
}else{
    $ip = $remote;
}
$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
if($ip_data && $ip_data->geoplugin_countryName != null){
    $result['country'] = $ip_data->geoplugin_request;
    $result['city'] = $ip_data->geoplugin_city;
}


	$p = Array(
		'apiKey' => 'lUx1ybnEf4iJhMYYLZTnUU3n1JQVJalb',
		'site' => 'sealex.su',
		'order' => json_encode(Array(
			'firstName' => $_POST['name'],
			'lastName' => $_POST['lastname'],
			'phone' => $_POST['phone'],
			'email' => $_POST['email'],
			'customerComment' => $_POST['comment'],
			'orderType' => 'eshop-individual',
			'status' => 'new',
			'source' => Array(
				'source' => urldecode($_POST['utm_source']),
				'medium' => urldecode($_POST['utm_medium']),
				'campaign' => urldecode($_POST['utm_campaign']),
				'keyword' => urldecode($_POST['utm_term']),
				'content' => urldecode($_POST['utm_content'])
			),
			'items' => Array(
				Array(
					'productName' => 'Сеалекс',
					'initialPrice' => 2000,
					'quantity' => 1,
					'offer' => array(
                        'externalId' => 4600376211206
            )
				)
			),
			'orderMethod' => 'landing-page',
			'customFields' => array(
			'roistat' => array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : "неизвестно",
				  'ip' =>$result['country'],
				'useragent' => $_SERVER['HTTP_USER_AGENT'],
				'referer' => $_SERVER['HTTP_REFERER'],
				'gorod' =>$result['city'],
				'utmterm' => urldecode($_POST['utm_term']),
                'utmsource' => urldecode($_POST['utm_source']),
                'utmmedium' => urldecode($_POST['utm_medium']),
                'utmcampaign' => urldecode($_POST['utm_campaign']),
                'tovar' => 'Сеалекс'												                                
		     )
		))
	);

	$s = curl1('https://sila-monarha.retailcrm.ru/api/v5/orders/create', $p);

	if ($s === FALSE) {
		echo 'FALSE';
		file_put_contents('retail.log', $s);
	}
}

function curl1($url, $p = Array()) {
	$curl=curl_init();
	curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl,CURLOPT_URL, $url);
	if (isset($p) && count($p) > 0) {
		curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($p));
	} else {
		curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'GET');
	}
	curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
	curl_setopt($curl,CURLOPT_HEADER, false);
	curl_setopt($curl,CURLOPT_COOKIEFILE, dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
	curl_setopt($curl,CURLOPT_COOKIEJAR, dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 0);
	$out = curl_exec($curl);
	$code = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	if ($code == 200 || $code == 201) {
		return $out;
	} else {
		return FALSE;
	}
}
?>