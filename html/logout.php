<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
	unset($_COOKIE['loginCredentials']);
	if(!(isset($_COOKIE['loginCredentials']) && !empty(isset($_COOKIE['loginCredentials'])))){
		setcookie("loginCredentials", "", (time() - (60*60)), "/");
  }
  header("Location: login");
  die();
?>
