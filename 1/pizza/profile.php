<!DOCTYPE html> <!-- Объявление формата документа -->
<html>
	<head> <!-- Техническая информация о документе -->
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" /> <!-- Не кешировать -->
		<meta http-equiv="Pragma" content="no-cache" /> <!-- Не кешировать -->
		<meta http-equiv="Expires" content="0" /> <!-- Не кешировать -->
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
				<div class="profile">
				<?php
					if(!isset($_SESSION["users_ID"])){
						echo "<h1>Вы не авторизованы на нашем сайте. Вы можете <a href='login.php'>войти</a> в свой аккаунт или <a href='registration.php'>зарегистрировать</a> новый.</h1>";
					}else{
						echo "<div class='user'>";
							$profile_img = $_SESSION["users_ID"] . ".png";
							if(!file_exists(__DIR__ . "\\img\\profile_img\\" . $profile_img)){
								$profile_img = "Default.png";
							}
							echo "<div class='user_img'><img src='img/profile_img/" . $profile_img . "'></div>";

							echo "<div class='user_info'>";
								echo "<div>Ваш логин: " . $_SESSION["users_login"] . "</div><br>";
								echo "<div>Ваша почта: " . $_SESSION["users_email"] . "</div><br>";
								echo "<form id='form' accept='image/*' method='POST' enctype='multipart/form-data' action='includes/add_img_inc.php'>";
									echo "<input id='file' type='file' name='filename'><br>";
									echo "<button type='submit' name='submit' class='any_button any_textline'>Изменить фото</button><br>";
								echo "</form>";
							echo "</div>";

						echo "</div>";
						echo "<div class='history'>";
							echo "<br><div><h1>История заказов<h1></div><br>";
							echo "<div>";
								require_once "includes/dbh_inc.php";
								$result = mysqli_query($conn, "SELECT * FROM orders WHERE " . $_SESSION["users_ID"] ." = users_ID ORDER BY orders_date DESC;");
								$row = mysqli_fetch_assoc($result);
								echo "<table class='basket_table'>";
									echo "<tr class=head_row>";
										echo "<th>Трек номер</th>";
										echo "<th>Дата  и время</th>";
										echo "<th>Статус</th>";
										echo "<th>Имя</th>";
										echo "<th>Телефон</th>";
										echo "<th>Адрес</th>";
										echo "<th colspan='2'>Комментарий</th>";
									echo "</tr>";
									echo "<tr><td colspan='7'></td></tr>";
								while(!is_null($row)){
									echo "<tr class='row'>";
										echo "<td>" . $row["orders_track_number"] . "</td>";
										echo "<td>" . $row["orders_date"] . "</td>";
										echo "<td>" . $row["orders_status"] . "</td>";
										echo "<td>" . $row["orders_name"] . "</td>";
										echo "<td>" . $row["orders_tel"] . "</td>";
										echo "<td>ул. " . $row["orders_street"] . ", д. " . $row["orders_house"] . ", кв. " . $row["orders_cell"] . "</td>";
										echo "<td>" . $row["orders_comments"] . "</td>";
										echo "<td><input type='button' class='any_button manager more_info' value='+' id='" . $row["orders_track_number"] . "'></td>";
									echo "</tr>";
									echo "<tr><td class='loader' id='" . $row["orders_track_number"] . "_loader' colspan='7'></td></tr>";
									$row = mysqli_fetch_assoc($result);
								}
								echo "</table>";
							echo "</div>";
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
<script src="js/jquery-3.6.1.js"></script>
<script src="js/profile.js"></script> <!-- Подключаем сценарии -->