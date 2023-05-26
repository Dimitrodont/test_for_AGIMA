<?php
	require_once "dbh_inc.php";
	require_once "basket_inc.php";
	session_start();
	
	if(isset($_POST["id"])){
		$_SESSION["basket"]->add($_POST["id"]);
	}

	echo $_SESSION["basket"]->getSize();
