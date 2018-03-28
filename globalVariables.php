<?php
	// Import the user and passrod config file
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $config = $homePath . "/../config.php";
  $s3Path = $homePath . "/../S3.php";
	include_once($config);
	include_once($s3Path);

	//define('', '');
	// Database Information
	define('DSN', 'mysql:dbname=phinder;host=127.0.0.1');
	define('SERVER', '127.0.0.1');
	define('DB', 'phinder');
	define('TBL_USERS', 'Users');
	define('TBL_ITEMS', 'Items');
	define('TBL_ITEMREVIEW', 'ItemReview');

	// GOOGLE API URL
	define('GOOGLE_MAPS_BASE_URL', 'https://maps.googleapis.com/maps/api/');

	// S3 URL
	define('S3_URL', 'https://s3.us-east-2.amazonaws.com/');
	// S3 BUCKET NAME
  define('S3_BKTNAME', 'phinder2.0');

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

	$s3 = new S3(S3_KEY, S3_SECRET);

?>
