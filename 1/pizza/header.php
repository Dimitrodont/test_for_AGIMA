<?php 
	require_once "includes/basket_inc.php";	// с начала подключение
	session_start();						// потом сессия иначе все сломается!!!
	if(!isset($_SESSION["basket"])){
		$basket = new Basket();
		$_SESSION["basket"] = $basket;
	}
?>

<header>
	<div class="hat">
		<a class="home any_button" href="index.php">
			<img src="img/pizza_logo.png">
			<span>TOMATO</span>
		</a>
		<a class="basket any_button" href="basket.php">
			<img src="img/basket_mini.png">
			<span>Корзина</span>
			<span class="basket_size"> <?php echo $_SESSION["basket"]->getSize(); ?> </span>
		</a>
	</div>
	<div class="nav">
		<a class="any_button" href="index.php">МЕНЮ</a>
		<a class="any_button" href="delivery.php">ДОСТАВКА И ОПЛАТА</a>
		<a class="any_button" href="all_about_us.php">О НАС</a>
		<a class="any_button" href="reviews.php">ОТЗЫВЫ</a>
		<a class="any_button" href="contacts.php">КОНТАКТЫ</a>
	</div>
</header>