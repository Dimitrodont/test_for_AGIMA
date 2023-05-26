<?php session_start(); // всегда открывай сессию в начале документа! ?>

<div class="right_sidebar">
	<?php 
		if(isset($_SESSION["users_ID"])){
			$profile_img = $_SESSION["users_ID"] . ".png";
			if(!file_exists(__DIR__ . "\\img\\profile_img\\" . $profile_img)){
				$profile_img = "Default.png";
			}
			?>
				<a class="any_button" href="profile.php">
					<div>Профиль</div><br><div><img class="mini_profile_img" src="img/profile_img/<?php echo $profile_img; ?>"></div>
					<?php echo "<br><div>" . $_SESSION["users_login"] . "</div><div>" . $_SESSION["users_email"] . "</div><br>"; ?>
				</a>
				<a class="any_button" href="includes/logout_inc.php">
					<img src="">Выход
				</a>
			<?php
		}else{
			?>
				<a class="any_button" href="login.php">
					<img src="">Вход
				</a>
				<a class="any_button" href="registration.php">
					<img src="">Регистрация
				</a>
			<?php
		}
	?>
</div>