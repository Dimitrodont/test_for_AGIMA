<?php
	session_start();
	require_once "dbh_inc.php";
	require_once "function_inc.php";

	if(isset($_POST["comment"])){
		addComment($conn, $_POST["comment"]);
	}
	if(isset($_POST["rem"])){
		remComment($conn, $_POST["rem"]);
	}
	$limit = 4;
	if(isset($_POST["limit"])){
		$limit = $_POST["limit"];
	}
	
	$str = "SELECT * FROM reviews INNER JOIN users USING(users_ID) ORDER BY reviews.reviews_date DESC LIMIT ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $str)){	// проверка корректности запроса
		header("location: ..reviews.php");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "i", $limit);
	mysqli_stmt_execute($stmt);
	$reviews = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($reviews);
	while(!is_null($row)){
		$profile_img = $row["users_ID"] . ".png";
		if(!file_exists(__DIR__ . "\\..\\img\\profile_img\\" . $profile_img)){
			$profile_img = "Default.png";
		}
		echo "<div class='reviews_loader_row'>";
			echo "<div class='reviews_loader_row_user'>";
				echo "<div><img class='mini_profile_img' src='../img/profile_img/" . $profile_img . "'><br><h2>" . $row["users_login"] . "</h2></div>";
				echo "<div>" . $row["reviews_date"] . "</div>";
			echo "</div>";
			echo "<div class='reviews_loader_row_comment'>" . $row["reviews_content"] . "</div>";
			if($_SESSION["users_ID"] == $row["users_ID"]){
				echo "<input type='button' class='any_button rem_comm' id=" . $row["reviews_ID"] . " value='X'>";
			}
		echo "</div>";
		$row = mysqli_fetch_assoc($reviews);
	}

	if(mysqli_num_rows($reviews) < $limit){
		echo "<h2>Записей больше нет.</h2>";
	}
