<?php 
	session_start();	// всегда запускай сессию если будешь работать с глобальным массивом $_SESSION
	session_unset();	// удаляем все записи из массива сессии
	session_destroy();	// закрываем сессию
	header("location: ../index.php");
?>