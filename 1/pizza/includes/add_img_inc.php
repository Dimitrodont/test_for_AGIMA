<?php
	if(isset($_POST["submit"])){	// если в массиве существует submit
		session_start();
		if(!move_uploaded_file($_FILES["filename"]["tmp_name"], __DIR__ . "\\..\\img\\profile_img\\" . $_SESSION["users_ID"] . ".png")){	// двигаем файл с сервера в нашу папку
			header("location: ../profile.php?error=addImgError");
			exit();
		}
	}
	header("location: ../profile.php");
	
// все кто просто PHP можно не закрывать!