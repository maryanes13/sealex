<?php
//кому один получатель
$mailto = 'info@moguchij-han.ru';

//от кого письмо
$mailfrom = 'soroka.sonya@yandex.ua';

$subject = 'Заявка с сайта fuzhunbao.su';


$eol = "\r\n";
$message = '';

$header  = 'From: '.$mailfrom.$eol;
$header .= 'Reply-To: '.$mailfrom.$eol;
$header .= 'MIME-Version: 1.0'.$eol;
$header .= 'Content-type: text/plain; charset=utf-8';


$message = 'Имя: '.$_REQUEST['name'].$eol;
$message .= 'Телефон: '.$_REQUEST['phone'].$eol;
$message .= 'Страна: '.$_REQUEST['country'].$eol;
$message .= 'email: '.$_REQUEST['email'].$eol;
$message .= 'Отправлено с сайта: fuzhunbao.su'.$eol;


$message.="IP: ".$_SERVER['REMOTE_ADDR'];

include 'retail.php';
if ($sendMail) {
	mail($mailto, $subject, $message, $header);
}
header( 'Location: success.php', true, 307 );
?>