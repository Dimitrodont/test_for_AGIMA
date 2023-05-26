<?php
	/* для удобной работы с БД */
	$serverName = "localhost";
	$userName = "root";
	$dbPassword = "";
	$dbName = "tomato";

	/* mysqli_ более современный чем mysql_ */
	$conn = mysqli_connect($serverName, $userName, $dbPassword, $dbName);

	if(!$conn){	// проверяем подключение
		exit("Ошибка подключения к базе данных: " . mysqli_connect_error());
	}
// все кто просто PHP можно не закрывать!