<?php

//ini_set('error_reporting', E_ALL);
//ini_set('display_startup_errors', 1);
//ini_set('display_errors', 1);

require 'vendor/autoload.php';

	// лог-функция
	function logFile($domen_crm=null, $string) {
		if (is_null($domen_crm)) { $log_file_name = "logs/logs.txt"; }  // имя общего лог-файла
		else {
		$crm=explode('.', $domen_crm); //извлекаем название аккаунта из адреса полного адреса crm
		$log_file_name = "logs/orderedit.txt"; }
		$now = date("[Y-m-d H:i:s]");
		file_put_contents($log_file_name, $now." ".$string, FILE_APPEND); //запись лога в файл
	} 

// функция поска последнего заказа по номеру телефона и определение его статуса
	function order_to_phone($phone,$domen_crm,$apikey_crm) {
		global $code_magazine_tek;		
		$url = 'https://'.$domen_crm.'/api/v5/orders?filter[customer]='.$phone.'&apiKey='.$apikey_crm;   
		$result = json_decode(file_get_contents($url), true);
		if ($result['pagination']['totalCount']>0) {
		$order_number = $result['orders'][0]['id'];
		$order_status = $result['orders'][0]['status'];
		$code_magazine_tek = $result['orders'][0]['site'];
		if (isset($order_number)) {  return $order_number; } else { return false; }
		} else { 
		return false;
		}
	}
	
// функция проверки, указан ли в заказе email 
function check_email($order_id,$code_magazine) {
		$url = 'https://sila-monarha.retailcrm.ru/api/v5/orders/'.$order_id.'?by=id&site='.$code_magazine.'&apiKey=lUx1ybnEf4iJhMYYLZTnUU3n1JQVJalb';
//echo $url.'<br/>';	
		$result = json_decode(file_get_contents($url), true);

			//if (isset($result['order']['email'])) { echo 'да'; }
			if (isset($result['order']['email']) and strlen($result['order']['email'])>0) { return true; } else { return false; }
}

function RetailEditOrder($domen_crm,$apikey_crm,$code_magazine,$num_order,$email) {

// настройки API
$client = new \RetailCrm\ApiClient(
    'https://'.$domen_crm.'/', // 'https://muravdom.retailcrm.ru/',
    $apikey_crm, // '80UM63iZsH6KyP7OQK4ZLB9QsNbpXtRL',
    \RetailCrm\ApiClient::V5,
	$code_magazine // символьный код магазина
);

try {
    $response = $client->request->ordersEdit( [
                'id' => $num_order,
				'email' => $email,
				'customFields' => ['polzovatel_vvyol_email_v_obmen_na_podarok' => 'true'], // установка чекбокса				
            ],
            'id'
);
} catch (\RetailCrm\Exception\CurlException $e) {
    echo "<br/>Connection error: " . $e->getMessage();
	logFile($domen_crm,"Connection error: " . $e->getMessage().PHP_EOL);
}

if ($response->isSuccessful() && 200 === $response->getStatusCode()) {
    echo 'Поле email заказе '.$response->id.' изменено!<br/>';
	logFile($domen_crm,'Поле email в заказе '.$response->id.' изменено.'.PHP_EOL);
        // or $response['id'];
        // or $response->getId();
} else {
    echo sprintf(
        "Ошибка изменения поля: [HTTP-code %s] %s",
        $response->getStatusCode(),null
        // $response->getErrorMsg()
    );
	logFile($domen_crm,sprintf("Заказ №".$num_order." / Error: [HTTP-code %s] %s",$response->getStatusCode(),null).PHP_EOL);

}
}

if(isset($_POST['phone']) and isset($_POST['email'])) {

$apikey_crm = 'lUx1ybnEf4iJhMYYLZTnUU3n1JQVJalb';
$domen_crm = 'sila-monarha.retailcrm.ru';
$order_id = order_to_phone($_POST['phone'], $domen_crm, $apikey_crm);

	if ($order_id != false) {
		//проверяем наличие email в заказе, если нет, то добавляем его в заказ
		if (!check_email($order_id,$code_magazine_tek)) {
			RetailEditOrder($domen_crm,$apikey_crm,$code_magazine_tek, $order_id, $_POST['email']); 
		} else {
			logFile($domen_crm, 'В заказе №'.$order_id.': email уже заполнен!'.PHP_EOL);
		}
	} else {
		logFile($domen_crm, 'Заказ по телефону: '.$_POST['phone'].' не найден!'.PHP_EOL);
	}		
} else logFile ("Не переданы все нужные GET параметры!");

header( 'Location: ../index.html');



//echo '<br/>ok'; 

?>