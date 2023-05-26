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
				<div class="place_order">
					<?php 
						if(isset($_GET["orders_track_number"])){
							echo "<h1>Заказ успешно оформлен, номер заказа: " . $_GET["orders_track_number"] . "</h1>";
							echo "<br>В ближайшее время, по указанному вами номеру, с вами свяжется наш сотрудник для подтверждения заказа. Спасибо, что выбрали нас!";
						}else if($_SESSION["basket"]->getSize() == 0){
							header("location: ../basket.php");
							exit();
						}else{
					?>
						<h1>Оформление заказа</h1>
						<form method="POST" action="includes/order_inc.php">
							<input class="any_button any_textline" type="text" name="name" placeholder="Ваше имя" required><br>
							<input class="any_button any_textline" type="tel" name="phone" placeholder="Ваш номер телефона" required><br>
							<input class="any_button any_textline" type="text" name="street" placeholder="Ваша улица" required><br>
							<input class="any_button any_textline" type="text" name="house" placeholder="Номер вашего дома" required><br>
							<input class="any_button any_textline" type="number" min="0" step="1" name="cell" placeholder="Номер вашей квартиры" required><br>
							<textarea class="any_button any_textline" name="comments" placeholder="Комментарий к заказу"></textarea><br>
							<button class="any_button any_textline" type="submit" name="submit">Подтвердить</button>
						</form>
					<?php
						}
						if(isset($_GET["error"])){
							echo "<div class='error_msg'>";
							if($_GET["error"] == "dbError"){
								echo "Неожиданная ошибка базы данных, повторите попытку позднее.";
							}else{
								echo "Неизвестная ошибка, повторите попытку позднее.";
							}
							echo "</div>";
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