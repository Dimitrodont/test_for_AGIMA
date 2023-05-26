<?php
	require_once "includes/dbh_inc.php";
	$result = mysqli_query($conn, "SELECT * FROM items INNER JOIN category USING(category_ID) ORDER BY items.category_ID;");
	$row = mysqli_fetch_assoc($result);
	$currCategory = -1;

	while(!is_null($row)){
		if($currCategory != $row["category_ID"]){	// если новая категория то проверить
			if($currCategory != -1){ echo "</div>"; }	// если это не первая категория (по счету)
			$currCategory = $row["category_ID"];
			echo "<div class='rod'>";
				echo $row["category_name"];	// и вставить разделитель
			echo "</div>";
			echo "<div class='category'>";
		}
		echo "<div class='item'>";
			echo "<a href='any_item.php?item=" . $row["items_ID"] . "'><div class='title'>" . $row["items_name"] . "</div>";
			echo "<img src='img/items/" . $row["items_imgName"] . "'>";
			echo "<div class='description'>" . $row["items_description"] . "</div></a>";
			echo "<div class='item_footer'>";
				echo "<span>" . $row["items_prise"] . " RUB </span>";
				echo "<input type='button' class='any_button add_button' value='Добавить' id='" . $row["items_ID"] . "'>";
			echo "</div>";
		echo "</div>";
		$row = mysqli_fetch_assoc($result);
	}
	echo "</div>";	// div для последней категории
?>