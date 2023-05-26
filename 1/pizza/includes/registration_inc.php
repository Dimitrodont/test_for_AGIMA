<?php
	/* проверяем как пользователь попал сюда, 
	 * если он нажал на кнопку регистрации (как надо)
	 * тогда выполнить код, иначе вернуть на страницу регистриции */
	if(isset($_POST["submit"])){	// если в массиве существует submit
		$login = $_POST["login"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$password_rep = $_POST["password_rep"];

		require_once "dbh_inc.php";			// запрос моего файла с подключением к БД
		require_once "function_inc.php";	// запрос моего файла с функциями

		if(loginAlreadyExist($conn, $login) === true){
			/* так можно передать ошибку обратно на страницу */
			header("location: ../registration.php?error=loginAlreadyExist");
			exit();
		}
		if(emailAlreadyExist($conn, $email) === true){
			header("location: ../registration.php?error=emailAlreadyExist");
			exit();
		}

		createUser($conn, $login, $email, $password);

	}else{
		header("location: ../registration.php");
	}

	
// все кто просто PHP можно не закрывать!