<?php
	require_once "includes/basket_inc.php";	// с начала подключение
	session_start();						// потом сессия иначе все сломается!!!

	if(isset($_POST["id"])){
		/*
		echo "<pre>";
		echo print_r($_POST);
		echo "</pre>";
		*/
		if($_POST["char"] == "+"){
			$_SESSION["basket"]->add($_POST["id"]);
		}else if($_POST["char"] == "-"){
			$_SESSION["basket"]->rem($_POST["id"]);
		}else if($_POST["char"] == "X"){
			$_SESSION["basket"]->del($_POST["id"]);
		}
	}

	$totalPrice = 0;
	$arr = $_SESSION["basket"]->getArr();
	/*
	echo "<pre>";
	echo print_r($arr);
	echo "</pre>";
	*/
	if(count($arr) == 0){
		echo "<h1>Корзина пуста, вы можете заполнить ее в <a class='underlined' href='index.php'>меню</a></h1>";
	}else{
		require_once "includes/dbh_inc.php";
		require_once "includes/function_inc.php";

		$result = mysqli_query($conn, "SELECT * FROM items WHERE items_ID IN (" . arrToString(array_keys($arr)) . ");");
		$row = mysqli_fetch_assoc($result);

		echo "<div><h2>Корзина</h2></div><br>";
		echo "<div class='tbl'><table class='basket_table'><tr><th>Название</th><th>Цена</th><th>Количество</th><th>Удалить</th></tr>";
		while(!is_null($row)){
			$totalPrice += $row["items_prise"] * $arr[$row["items_ID"]];
			echo "<tr class='row'>";
				echo "<td><a href='any_item.php?item=" . $row["items_ID"] . "'>" . $row["items_name"] . "</a></td>";
				echo "<td>" . $row["items_prise"] . "</td>";
				echo "<td class='center_cell'><input type='button' class='any_button manager' value='-' id='" . $row["items_ID"] . "'> ";
				echo "<span class='counter'>" . $arr[$row["items_ID"]] . "</span>";
				echo " <input type='button' class='any_button manager' value='+' id='" . $row["items_ID"] . "'></td>";
				echo "<td class='center_cell'><input type='button' class='any_button manager' value='X' id='" . $row["items_ID"] . "'></td>";
			echo "</tr>";
			$row = mysqli_fetch_assoc($result);
		}
		echo "</table></div><br/><br/>";
		echo "<div>Сумма: $totalPrice руб. <a class='main_button' href='place_order.php'>Оформить заказ</a></div>";
	}
	echo "<script src='js/jquery-3.6.1.js'></script>";
	echo "<script src='js/basket.js'></script>";
