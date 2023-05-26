<?php

	if(!isset($_POST["id"])){
		header("location: ../profile.php");
		exit();
	}
	require_once "dbh_inc.php";
	require_once "function_inc.php";

	if(!checkUser($conn, $_POST["id"])){
		header("location: ../profile.php");
		exit(); 
	}

	$str = "SELECT * FROM items INNER JOIN sales USING(items_ID) WHERE orders_track_number = " . $_POST["id"] . ";";
	$result = mysqli_query($conn, $str);
	$row = mysqli_fetch_assoc($result);

		echo "<div class='mini_table_shell'><table class='mini_table'><tr><th>Название</th><th>Количество</th></tr>";
		while(!is_null($row)){
			echo "<tr class='row'>";
				echo "<td><a href='any_item.php?item=" . $row["items_ID"] . "'>" . $row["items_name"] . "</a></td>";
				echo "<td>" . $row["sales_count"] . "</td>"; 
			echo "</tr>";
			$row = mysqli_fetch_assoc($result);
		}
		echo "<div></table>";