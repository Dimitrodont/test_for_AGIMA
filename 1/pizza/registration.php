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
				<div class="registration">
					<h1>РЕГИСТРАЦИЯ</h1>
					<form id="form" method="POST" action="includes/registration_inc.php">
						<input id="login" class="any_button any_textline" type="text" name="login" placeholder="Ваш логин" required><br>
						<span id="login_span">Логин не должен содержать сомволы: /|><</span><br>
						<input id="email" class="any_button any_textline" type="email" name="email" placeholder="Ваша почта" required><br>
						<span id="email_span">Укажите почту к которой у вас есть доступ</span><br>
						<input id="password" class="any_button any_textline" type="password" name="password" placeholder="Ваш пароль" required><br>
						<span id="password_span">Пароль должен содержать более 5 символов</span><br>
						<input id="password_rep" class="any_button any_textline" type="password" name="password_rep" placeholder="Повторите пароль" required><br>
						<span id="password_rep_span">Пароли должны совпадать</span><br>
						<button class="any_button any_textline" type="submit" name="submit">Зарегистрироваться</button>
					</form>
					<?php
						if(isset($_GET["error"])){
							?> <div class="error_msg"> <?php
							if($_GET["error"] == "dbError"){
								echo "Неожиданная ошибка базы данных, повторите попытку позднее.";
							}else if($_GET["error"] == "loginAlreadyExist"){
								echo "Пользователь с таким логином уже существует, придумайте уникальный логин.";
							}else if($_GET["error"] == "emailAlreadyExist"){
								echo "Пользователь с такой почтой уже существует.";
							}else if($_GET["error"] == "none"){
								echo "Вы успешно зарегистрировались!";
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
<script src="js/registration.js"></script>