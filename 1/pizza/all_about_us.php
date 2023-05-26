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
				<div class="all_about_us">
					<div class="midl_font">О нас</div>
					<div class="all_about_us_body">
						Ресторан под брендом ТОМАТО работает в городе Обнинск с 2011 года.
						<br><br>
						Открывая ресторан ТОМАТО, мы хотели создать уютный городской ресторан для семейного отдыха. Наша концепция объединяет современный дизайн, оригинальную и в то же время знакомую и любимую итальянскую кухню, справедливые и доступные цены.
						<br><br>
						Пицца ТОМАТО настолько понравилась гостям, что теперь ее можно попробовать не только в ресторане, но и заказать доставку.
						<br><br>
						Наш ресторан находится по адресу г.Обнинск, ул.Кутузова, дом 4, вход с торца здания.
						<br><br>
						Мы открыты:
						<br>
						ПН-ПТ 9:00-20:00
						<br>
						СБ-ВС 9:00-19:00
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