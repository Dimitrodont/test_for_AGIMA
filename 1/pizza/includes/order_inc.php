<?php
	require_once "basket_inc.php";	// с начала подключение
	require_once "function_inc.php";
	require_once "dbh_inc.php";
	session_start();				// потом сессия иначе все сломается!!!

	if(!isset($_POST["submit"]) || $_SESSION["basket"]->getSize() == 0){
		header("location: ../basket.php");
		exit();
	}

	$date = date("Y-m-d H:i:s");

	$users_ID = "";
	if(isset($_SESSION["users_ID"])){
		$users_ID = $_SESSION["users_ID"];
	}

	createOrder($conn, $date, "Не подтвержден", $_POST["name"], $_POST["phone"], $_POST["street"], $_POST["house"], $_POST["cell"], $_POST["comments"], $users_ID);