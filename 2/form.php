<!doctype html>
<html lang="ru">
	<head>
		<meta charset="utf-8" />
		<title>Form</title>
	</head>
	<body>
		<form method="POST" action="form_action.php">	<!-- данные с формы отправятся в action -->
			<label for="email">Электронная почта</label></br>
			<input type="email" name="email" id="email" placeholder="Ваша электронная почта" required></br>
			<label for="name">Имя</label></br>
			<input type="text" name="name" id="name" placeholder="Ваше имя" maxlength="20" required></br>
			<label for="score">Оценка</label></br>
			<input type="number" name="score" id="score" min="0" max="10" step="1" value="5"></br>
			<label for="comment">Комментарий</label></br>
			<textarea name="comment" id="comment" cols="40" rows="5" placeholder="Ваш комментарий" maxlength="500" required></textarea></br>
			<button class="" type="submit" name="submit">Отправить</button>
		</form>
	</body>
</html>