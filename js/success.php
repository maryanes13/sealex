<?php
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
$message = 'email: '.$_REQUEST['email'].$eol;
$message .= 'Страна: '.$_REQUEST['country'].$eol;

//header( 'Location: success.php', true, 307 );

$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
?>


<!DOCTYPE html>
<html lang="ru">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<title>Заявка принята</title>
	<style>
		body {
			height: 100%;
			min-height: 600px;
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
		}

		.wrapper {
			top: 50%;
			position: relative;
			-webkit-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
			-o-transform: translateY(-50%);
			transform: translateY(-50%);
			min-height: 600px;
		}

		.r {
			font-family: 'Roboto', sans-serif;
		}

		html,
		body {
			margin: 0;
			padding: 0;
			background: #e9f4fb;
		}

		html {
			box-sizing: border-box;
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
		}

		*,
		*:before,
		*:after {
			box-sizing: inherit;
			-moz-box-sizing: inherit;
			-webkit-box-sizing: inherit;
		}

		.clearfix:before,
		.clearfix:after {
			content: " ";
			display: table
		}

		.clearfix:after {
			clear: both
		}

		.wrapper {
			width: 1024px;
			margin: 0 auto;
			position: relative;
		}

		.wrapper .top {
			width: 100%;
			left: 0;
			background: #d0956a;
			position: absolute;
			height: 90px;
			z-index: 0;
			top: 20px;
		}

		.wrapper .left {
			z-index: 2;
			position: relative;
			width: 520px;
			float: left;
			padding: 70px 35px 50px;
			background: #fbfbfb no-repeat top center;
			background-size: 100% auto;
		}

		.wrapper .left .title {
			font-family: 'Roboto', sans-serif;
			font-weight: 900;
			color: #003873;
			font-size: 35px;
			line-height: 64px;
			text-transform: uppercase;
		}

		.wrapper .left .info {
			font-family: 'Roboto', sans-serif;
			font-weight: 500;
			color: #003873;
			font-size: 25px;
			line-height: 1.2;
			margin-bottom: 20px;
		}

		.wrapper .left .note {
			font-size: 16px;
			font-family: 'Roboto', sans-serif;
			color: #003873;
		}

		.wrapper .left .note a {
			color: #003873;
		}

		.wrapper .right {
			z-index: 2;
			position: relative;
			padding-top: 20px;
			float: left;
			width: 500px;
		}

		.wrapper .right .picture {
			padding-left: 20px;
		}

		.wrapper .right .picture img {
			max-width: 100%;
		}

		.wrapper .right .list ul {
			margin: 0;
			padding-left: 0px;
			list-style: none;
		}

		.wrapper .right .list ul li {
			display: block;
			width: 100%;
			position: relative;
			padding-left: 40px;
			font-family: 'Roboto', sans-serif;
			font-size: 16px;
			line-height: 20px;
			color: #003873;
			margin-bottom: 5px;
		}

		.wrapper .right .list ul li:before {
			position: absolute;
			width: 4px;
			height: 4px;
			content: "";
			top: 8px;
			left: 30px;
			background: #fbfbfb no-repeat top center;
		}

		.wrapper .bottom {
			background: #fbbb03;
			width: 100%;
			float: left;
			padding: 30px 25px 30px;
			position: relative;
			z-index: 1;
			margin-top: 0;
			margin-bottom: 20px;
		}

		.wrapper .bottom .bot-title {
			font-family: 'Roboto', sans-serif;
			font-weight: 900;
			font-size: 38px;
			line-height: 38px;
			color: #003873;
			text-transform: uppercase;
			margin-bottom: 30px;
		}

		.wrapper .form {
			display: block;
			float: left;
		}

		.wrapper .bottom .form-box {
			width: 100%;
		}

		.wrapper .bottom .form-box input {
			float: left;
			width: 270px;
			height: 50px;
			border: none;
			font-family: 'Roboto', sans-serif;
			font-size: 16px;
			padding: 0 15px;
			box-shadow: 0 0px 10px rgba(0, 0, 0, 0.3);
			color: #003873;
			margin-right: 10px;
		}

		.wrapper .bottom .form-box input::-webkit-input-placeholder {
			color: #003873;
		}

		.wrapper .bottom .form-box input:-moz-placeholder {
			color: #003873;
		}

		.wrapper .bottom .form-box input::-moz-placeholder {
			color: #003873;
		}

		.wrapper .bottom .form-box input:-ms-input-placeholder {
			color: #003873;
		}

		.wrapper .bottom .form-box button {
			color: #fff;
			font-size: 16px;
			font-family: 'Roboto', sans-serif;
			border: none;
			background: #f23f4e;
			text-align: center;
			display: inline-block;
			line-height: 16px;
			width: 188px;
			box-shadow: 0 0px 10px rgba(0, 0, 0, 0.3);
			padding: 17px 0;
			margin-right: 25px;
			float: left;
			cursor: pointer;
			transition: all .3s ease;
		}

		.wrapper .bottom .form-box button:hover {
			background: #f45764;
		}

		.wrapper .bottom .form-box button:active {
			background: #f02738;
			outline: none;
			box-shadow: inset 0 0px 5px rgba(0, 0, 0, 0.3);
		}

		.wrapper .bottom .form-box button:focus {
			outline: none;
			box-shadow: inset 0 0px 5px rgba(0, 0, 0, 0.3);
		}

		.wrapper .bottom .form-box .form-desc {
			float: right;
			width: 370px;
			font-family: 'Roboto', sans-serif;
			font-size: 22px;
			line-height: 1.1;
			color: #003873;
		}

		.wrapper .bottom .bot-note {
			width: 100%;
			float: left;
			margin-top: 20px;
			font-size: 13px;
			line-height: 1.2;
			font-family: 'Roboto', sans-serif;
			color: #003873;
		}

		.wrapper .link {
			text-align: center;
			width: 100%;
			float: left;
			font-family: 'Roboto', sans-serif;
			font-size: 16px;
		}

		.wrapper .link a {
			text-decoration: none;
			color: #003873;
		}

		.wrapper .link a:hover {
			text-decoration: underline;
		}

		@media screen and (max-width: 1025px) {
			body {
				min-height: 550px;
			}

			.wrapper {
				width: 768px;
				min-height: 550px;
			}

			.wrapper .left {
				width: 55%;
				background-size: 100% 120%;
				padding: 56px 35px 45px;
			}

			.wrapper .left .info {
				font-size: 24px;
			}

			.wrapper .right {
				z-index: 2;
				width: 45%;
				padding-top: 0;
			}

			.wrapper .right .list ul li {
				font-size: 14px;
				padding-left: 20px;
			}

			.wrapper .right .list ul li:before {
				left: 8px;
			}

			.wrapper .bottom .bot-title {
				margin-bottom: 20px;
				font-size: 28px;
				text-align: center;
			}

			.wrapper .bottom .form-box input {
				width: 230px;
			}

			.wrapper .bottom .form-box button {
				width: 125px;
			}

			.wrapper .bottom .form-box .form-desc {
				width: auto;
				font-size: 20px;
			}
		}

		@media screen and (max-width: 767px) {
			.wrapper {
				width: 100%;
				min-width: 481;
				max-width: 767;
				padding-top: 0;
				transform: none;
				top: inherit;
			}

			.wrapper .right {
				width: 100%;
				float: none;
			}

			.wrapper .left {
				width: 100%;
				max-width: 500px;
				margin: 0 auto;
				float: none;
				background-size: 100% 115%;
				padding: 35px 35px 25px;
			}

			.wrapper .left .info {
				font-size: 18px;
			}

			.wrapper .left .note {
				font-size: 15px;
			}

			.wrapper .right .picture {
				padding-left: 0;
				text-align: center;
				padding-top: 10px;
			}

			.wrapper .bottom {
				padding: 15px 15px 15px;
			}

			.wrapper .bottom .bot-title {
				font-size: 24px;
				line-height: 28px;
				margin-bottom: 10px;
			}

			.wrapper .form {
				float: none;
			}

			.wrapper .bottom .form-box input {
				width: 400px;
				float: none;
				display: block;
				margin: 0 auto;
			}

			.wrapper .bottom .form-box button {
				float: none;
				display: block;
				margin: 0 auto;
				margin-top: 15px;
			}

			.wrapper .bottom .form-box .form-desc {
				float: none;
				font-size: 18px;
				text-align: center;
				margin-bottom: 15px;
			}

			.wrapper .link {
				padding-bottom: 20px;
			}

			.wrapper .bottom .form-box button {
				width: 200px;
			}

			.wrapper .list {
				width: 450px;
				margin: 0 auto;
			}

			.wrapper .bottom .bot-note {
				max-width: 500px;
				margin: 0 auto;
				float: none;
				margin-top: 20px;
			}
		}

		@media screen and (max-width: 481px) {
			body {
				min-width: 320px;
			}

			.wrapper {
				width: 100%;
				min-width: 320px;
				max-width: 480px;
				padding-top: 0;
				transform: none;
				top: inherit;
			}

			.wrapper .right {
				width: 100%;
				float: none;
			}

			.wrapper .left {
				width: 100%;
				float: none;
				background-size: 100% 115%;
				padding: 35px 25px 25px;
			}

			.wrapper .left .info {
				font-size: 18px;
			}

			.wrapper .left .note {
				font-size: 15px;
			}

			.wrapper .right .picture {
				padding-left: 0;
				text-align: center;
				padding-top: 10px;
			}

			.wrapper .bottom {
				padding: 15px 15px 15px;
			}

			.wrapper .bottom .bot-title {
				font-size: 24px;
				line-height: 28px;
				margin-bottom: 10px;
			}

			.wrapper .form {
				float: none;
			}

			.wrapper .bottom .form-box input {
				width: 100%;
				float: none;
			}

			.wrapper .bottom .form-box button {
				float: none;
				display: block;
				margin: 0 auto;
				margin-top: 15px;
			}

			.wrapper .bottom .form-box .form-desc {
				float: none;
				font-size: 18px;
				text-align: center;
				margin-bottom: 15px;
			}

			.wrapper .link {
				padding-bottom: 20px;
			}

			.wrapper .bottom .form-box button {
				width: 150px;
			}

			.wrapper .list {
				width: auto;
			}
		}
	</style>
</head>

<body>
	<div class="wrapper clearfix">
		<div class="top"></div>
		<div class="left">
			<div class="title"></div>
			<div class="info">Вас зовут: <?php echo $name;?> <span class="dop-color" id="leadprofit-name">&nbsp;</span>
				<br>Ваш телефон: <?php echo $phone;?>
				<span class="dop-color" id="leadprofit-phone">&nbsp;</span></div>
			<div class="note">Если Вы ошиблись при заполнении формы, пожалуйста, заполните заявку <a
					id="leadprofit-returnurl" href="#">еще раз</a></div>
		</div>
		<div class="right">
						<div class="list">
				<ul>
					<li>В ближайшее время Вам перезвонит менеджер для уточнения деталей.</li>
					<li>Доставка осуществляется почтой или курьером.</li>
					<li>Оплата при получении.</li>
				</ul>
			</div>
		</div>
		<div class="bottom">
			<div class="bot-title">Хотите получать уникальные предложения?</div>
			<div class="form-box clearfix">
				<div class="form-desc">Получите постоянную скидку 50% <br>на следующую покупку!</div>
				<form method="post" action="editorder.php" class="clearfix form">
                <input type="hidden" name="phone" value="<?php echo $phone;?>">
                <input type="email" name="email" required="required" placeholder="Введите E-mail">
                <button type="submit" class="btn-post">Отправить</button></form>
			</div>
			<div class="bot-note">Мы гарантируем полную сохранность введенных Вами данных и обязуемся не распространять
				их третьим лицам. Подтверждая желание получить инструкцию, вы соглашаетесь на получение рассылки об
				акциях, скидках и новостях.</div>
		</div>
	</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(51706361, "init", {
        id:51706361,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/51706361" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>



</html>