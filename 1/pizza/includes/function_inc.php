<?php
	function loginAlreadyExist($conn, $login){	// проверяет занято имя пользователя или нет
		$str = "SELECT * FROM users WHERE users_login = ?;";	// рекомендуют писать ? во избежание sql инъекций
		$stmt = mysqli_stmt_init($conn);	// подготовка к запросу

		if(!mysqli_stmt_prepare($stmt, $str)){	// проверка корректности запроса
			header("location: ../registration.php?error=dbError");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $login);	// теперь можно склеить запрос к бд заменив ? на переменную
		mysqli_stmt_execute($stmt);	// исполнение запроса
		$result = mysqli_stmt_get_result($stmt);	// запишем ответ в переменную

		if(mysqli_fetch_assoc($result)){ // попытаемся превратить ответ в ассоциативный массив
			return true;	// если получилось, значит пользователь уже существует
		}
		mysqli_stmt_close($stmt);	// закрыть подготовленный запрос
		return false;	// если не получилось, пользователь не существует
	}

	function emailAlreadyExist($conn, $email){	// проверяет занята ли почта пользователя или нет
		$str = "SELECT * FROM users WHERE users_email = ?;";	// рекомендуют писать ? во избежание sql инъекций
		$stmt = mysqli_stmt_init($conn);	// подготовка к запросу

		if(!mysqli_stmt_prepare($stmt, $str)){	// проверка корректности запроса
			header("location: ../registration.php?error=dbError");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $email);	// теперь можно склеить запрос к бд заменив ? на переменную
		mysqli_stmt_execute($stmt);	// исполнение запроса
		$result = mysqli_stmt_get_result($stmt);	// запишем ответ в переменную

		if(mysqli_fetch_assoc($result)){ // попытаемся превратить ответ в ассоциативный массив
			return true;	// если получилось, значит пользователь уже существует
		}
		mysqli_stmt_close($stmt);	// закрыть подготовленный запрос
		return false;	// если не получилось, пользователь не существует
	}

	function createUser($conn, $login, $email, $password){	// создает нового пользователя
		$str = "INSERT INTO users (users_login, users_email, users_password) VALUES (?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $str)){
			header("location: ../registration.php?error=dbError");
			exit();
		}

		$hashPassword = password_hash($password, PASSWORD_DEFAULT);	// лучше хранить хеш пароля чем сам пароль

		mysqli_stmt_bind_param($stmt, "sss", $login, $email, $hashPassword);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		header("location: ../registration.php?error=none");	// вернем пользователя назад, указав что ошибок нет
		exit();
	}

	function loginUser($conn, $login, $password){	// авторизация пользователя
		$str = "SELECT * FROM users WHERE users_email = ? OR users_login = ?;";	// поиск пользователя
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $str)){
			header("location: ../login.php?error=dbError");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "ss", $login, $login);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);	// запишем ответ в переменную
		$row = mysqli_fetch_assoc($result);	// попытаемся превратить ответ в ассоциативный массив

		if(is_null($row)){ // проверка
			header("location: ../login.php?error=invalidLogin");
			exit();
		}else if(password_verify($password, $row["users_password"])){	// используй password_verify
			session_start();	// если пароли совпали, начать новую сессию
			$_SESSION["users_ID"] = $row["users_ID"];	// создаем переменные сеанса
			$_SESSION["users_login"] = $row["users_login"];
			$_SESSION["users_email"] = $row["users_email"];
			header("location: ../profile.php");
			exit();
		}else{
			header("location: ../login.php?error=invalidPassword");
		}

		mysqli_stmt_close($stmt);	// закрыть подготовленный запрос
	}

	function arrToString($arr){
		$str = "";
		foreach ($arr as $i){
			$str .= $i . ", ";
		}
		return substr($str, 0, -2);;
	}

	function createOrder($conn, $orders_date, $orders_status, $orders_name, $orders_tel, $orders_street, $orders_house, $orders_cell, $orders_comments, $users_ID){	// создает нового заказа
		$str = "INSERT INTO orders (orders_date, orders_status, orders_name, orders_tel, orders_street, orders_house, orders_cell, orders_comments, users_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
		
		mysqli_begin_transaction($conn);	// НАЧАЛО ТРАНЗАКЦИИ
		try{
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $str)){
				throw new Exception("dbError");
			}
			mysqli_stmt_bind_param($stmt, "ssssssisi", $orders_date, $orders_status, $orders_name, $orders_tel, $orders_street, $orders_house, $orders_cell, $orders_comments, $users_ID);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			$id = mysqli_insert_id($conn);	// получаем id только что вставленной строки

			session_start();
			$arr = $_SESSION["basket"]->getArr();
			foreach ($arr as $key => $value){
				$stmt = mysqli_stmt_init($conn);
				$str = "INSERT INTO sales (orders_track_number, items_ID, sales_count) VALUES (?, ?, ?);";
				if(!mysqli_stmt_prepare($stmt, $str)){
					throw new Exception("dbError");
				}
				mysqli_stmt_bind_param($stmt, "iii", $id, $key, $value);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}

			/* Если код достигает этой точки без ошибок, фиксируем данные в базе данных. */
    		mysqli_commit($conn);
    		$_SESSION["basket"]->clear();
		}catch (mysqli_sql_exception $exception){
    		mysqli_rollback($conn);
    		header("location: ../place_order.php?error=dbError");	// вернем пользователя назад с ошибкой
			exit();
		}
		
		header("location: ../place_order.php?orders_track_number=" . $id);	// вернем пользователя назад, указав трек номер
		exit();
	}
	
	function checkUser($conn, $orders_track_number){
		session_start();
		$users_ID = $_SESSION["users_ID"];

		$str = "SELECT * FROM orders WHERE orders_track_number = ? AND users_ID = ?;";	// рекомендуют писать ? во избежание sql инъекций
		$stmt = mysqli_stmt_init($conn);	// подготовка к запросу

		if(!mysqli_stmt_prepare($stmt, $str)){	// проверка корректности запроса
			return false;
		}

		mysqli_stmt_bind_param($stmt, "ii", $orders_track_number, $users_ID);	// теперь можно склеить запрос к бд заменив ? на переменную
		mysqli_stmt_execute($stmt);	// исполнение запроса
		$result = mysqli_stmt_get_result($stmt);	// запишем ответ в переменную

		if(mysqli_fetch_assoc($result)){ // попытаемся превратить ответ в ассоциативный массив
			return true;	// если получилось, значит у этого id есть такой трек номер
		}
		return false;

		mysqli_stmt_close($stmt);	// закрыть подготовленный запрос
	}

	function addComment($conn, $comment){
		session_start();
		$str = "INSERT INTO reviews (users_ID, reviews_date, reviews_content ) VALUES (?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);	// подготовка к запросу

		if(!mysqli_stmt_prepare($stmt, $str)){
			header("location: ../reviews.php?error=dbError");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "iss", $_SESSION["users_ID"], date("Y-m-d H:i:s"), $comment);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

	function remComment($conn, $reviews_ID){
		session_start();
		$str = "DELETE FROM reviews WHERE reviews_ID = ? AND users_ID = ?;";
		$stmt = mysqli_stmt_init($conn);	// подготовка к запросу

		if(!mysqli_stmt_prepare($stmt, $str)){
			header("location: ../reviews.php?error=dbError");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "ii", $reviews_ID, $_SESSION["users_ID"]);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

// все кто просто PHP можно не закрывать!