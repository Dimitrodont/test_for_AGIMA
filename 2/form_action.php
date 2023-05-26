<?php
	// проверяем, что пользователь попал сюда нажав на кнопку
	if(isset($_POST["submit"])){	// если в массиве существует submit
		unset($_POST["submit"]);	// убираем submit
		$file_name = "comment.json";
		// записываем массив как json объект
		file_put_contents($file_name, json_encode($_POST, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE));
		echo "Данные сохранены в файл " . $file_name;
	}else{
		header("location: /form.php");
	}
// все кто просто PHP можно не закрывать!