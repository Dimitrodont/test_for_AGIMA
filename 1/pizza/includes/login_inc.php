<?php
	// проверяем, что пользователь попал сюда нажав на кнопку
	if(isset($_POST["submit"])){	// если в массиве существует submit
		$login = $_POST["login"];
		$password = $_POST["password"];

		require_once "dbh_inc.php";			// запрос моего файла с подключением к БД
		require_once "function_inc.php";	// запрос моего файла с функциями

		loginUser($conn, $login, $password);
		
	}else{
		header("location: ../login.php");
	}
// все кто просто PHP можно не закрывать!