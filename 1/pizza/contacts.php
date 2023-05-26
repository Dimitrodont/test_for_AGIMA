<!DOCTYPE html> <!-- Объявление формата документа -->
<html>
	<head> <!-- Техническая информация о документе -->
		<meta charset="UTF-8"> <!-- Определяем кодировку символов документа -->
		<meta http-equiv="Content-language" content="ru-RU">	<!-- Язык страницы -->
		<meta http-equiv="description" content="Данный сайт предназначен для выбора и зказа пиццы и других блюд в городе Обнинске от ресторана Tomato.">	<!-- описание, его учитывают поисковые роботы -->
		<meta http-equiv="keywords" content="пицца,ресторан,заказать еду, доставка еды">	<!-- ключевые слова, их тоже учитывают поисковые роботы -->
		<meta http-equiv="author" content="Хавеев Д.С.">	<!-- информация об авторе -->
		<title>Tomato</title> <!-- Задаем заголовок документа -->
		<link rel="stylesheet" type="text/css" href="css/style.css"> <!-- Подключаем внешнюю таблицу стилей -->
		<link rel="icon" href="img/logo_mini.png" type="image/x-icon">	<!-- мини лого на вкладке -->
	</head>
	<body> <!-- Основная часть документа -->
		<?php
			include_once "header.php";
		?>
		<div class="content">
			<?php
				include_once "left_sidebar.php";
			?>
			<div class="central_bar">
				<div class="contacts">
					<div class="midl_font">Контакты</div>
					<div class="contacts_body">
						Вы хотите заказать банкет или карпаратив, устроить деньрожденье для ребенка или просто заранее забронировать столик? Может быть вас интересует работа в нашем ресторвне или вы хотите стать нашим партнером по бизнесу? 
						<br><br>
						Свяжитесь с нами любым удобным способом:
						<br>
						По телефону: +7(484)392-02-02;
						<br>
						Напишите нам на почту: tomato@mail.ru;
						<br>
						Или в социальных сетях:
						<br>
						- <a class="underlined" href="https://vk.com/">ВКонтакте</a>
						<br>
						- <a class="underlined" href="https://instagram.com/">Instagram</a>
						<br>
						- <a class="underlined" href="https://twitter.com/">Twitter</a>
						<br>
						- <a class="underlined" href="https://facebook.com/">Facebook</a>
					</div>
				</div>
			</div>
			<?php
				include_once "right_sidebar.php";
			?>
		</div>
		<?php
			include_once "footer.php";
		?>
	</body>
</html>