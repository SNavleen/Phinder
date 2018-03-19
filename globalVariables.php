<?php
	// Import the user and passrod config file
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $config = $homePath . "/../config.php";
	include_once($config);

	//define('', '');
	// Database Information
	define('SERVER', '127.0.0.1');
	define('DB', 'phinder');
	define('TBL_USERS', 'Users');
	define('TBL_ITEMS', 'Items');
	define('TBL_ITEMREVIEW', 'ItemReview');

	define('GOOGLE_MAPS_BASE_URL', 'https://maps.googleapis.com/maps/api/');

	//ARRAY'S
	$userPages = array(
				"index" => "Home",
				"allPhones" => "Phones",
				"login" => "Login"
	);
	$userPagesLoggedin = array(
				"index" => "Home",
				"allPhones" => "Phones",
				"newPhone" => "New Phone",
				"account" => "Account",
				"logout" => "Log Out"
	);

?>
