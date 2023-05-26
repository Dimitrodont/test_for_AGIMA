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
				<div class="login">
					<h1>ВХОД</h1>
					<form method="POST" action="includes/login_inc.php">	<!-- данные с формы отправятся в action -->
						<input class="any_button any_textline" type="text" name="login" placeholder="Ваш логин или почта" required><br>
						<input class="any_button any_textline" type="password" name="password" placeholder="Ваш пароль" required><br>
						<button class="any_button any_textline" type="submit" name="submit">Войти</button>
					</form>
					<?php
						if(isset($_GET["error"])){
							?> <div class="error_msg"> <?php
							if($_GET["error"] == "dbError"){
								echo "Неожиданная ошибка базы данных, повторите попытку позднее.";
							}else if($_GET["error"] == "invalidLogin"){
								echo "Неверно указан логин или почта.";
							}else if($_GET["error"] == "invalidPassword"){
								echo "Неверно указан пароль.";
							}else{
								echo "Неизвестная ошибка, повторите попытку позднее.";
							}
							?> </div> <?php
						}
					?>
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