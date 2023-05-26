<?php
	require_once "includes/basket_inc.php";	// с начала подключение
	session_start();						// потом сессия иначе все сломается!!!
?>

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
				<?php
					if(!isset($_GET["item"])){
						header("location: /index.php");
						exit();
					}
					require_once "includes/dbh_inc.php";
					$str = "SELECT * FROM items WHERE items_ID = ?;";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $str)){	// проверка корректности запроса
						header("location: /index.php");
						exit();
					}
					mysqli_stmt_bind_param($stmt, "i", $_GET["item"]);
					mysqli_stmt_execute($stmt);	// исполнение запроса
					$result = mysqli_stmt_get_result($stmt);
					$row = mysqli_fetch_assoc($result);
					if(is_null($row)){ // проверка
						header("location: /index.php");
						exit();
					}
					echo "<div class='any_item'>";
						echo "<img class='any_item_img' src='img/items/" . $row["items_imgName"] . "'>";
						echo "<div class='any_item_info'>";
							echo "<div class='big_font'>" . $row["items_name"] . "</div><br>";
							echo "<div>" . $row["items_description"] . "</div><br>";
							echo "<div> Масса: " . $row["items_weight"] . " г.</div><br>";
							echo "<div> Данные приведены на 100 г. продукта:</div>";
							echo "<div> - Энергетическая ценность: " . $row["items_caloric"] . " кКалл;</div>";
							echo "<div> - Белки: " . $row["items_proteins"] . " г;</div>";
							echo "<div> - Жиры: " . $row["items_fats"] . " г;</div>";
							echo "<div> - Углеводы: " . $row["items_carbohydrates"] . " г.</div>";
						echo "</div>";
						echo "<div class='button_wrapper'><button class='any_button any_textline add_button' id='" . $row["items_ID"] . "'>Добавить в корзину</button></div>";
					echo "</div>";
				?>				
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
<script src="js/any_item.js"></script>