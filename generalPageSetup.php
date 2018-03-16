<?php
  session_start();
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $globalVariables = $homePath . "/../globalVariables.php";
	include_once($globalVariables);
  // date_default_timezone_set(LOCATION);

  function cssImport(){
?>
    <link rel="stylesheet" href="css/general.css" type="text/css">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <link rel="stylesheet" href="css/newPhone.css" type="text/css">
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <link rel="stylesheet" href="css/allPhones.css" type="text/css">
    <link rel="stylesheet" href="css/phone.css" type="text/css">
    <link rel="stylesheet" href="css/account.css" type="text/css">
<?php
  }
  function javascriptImport(){
?>
    <script src="js/general.js" type="text/javascript"></script>
    <script src="js/newPhone.js" type="text/javascript"></script>
    <script src="js/form.js" type="text/javascript"></script>
    <script src="js/allPhones.js" type="text/javascript"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXz0SgsK0Sup3LUBtLo5AkiwWhBqgzJbg"></script>
<?php
  }
  function metaData(){
?>
    <!-- <meta name="viewport" content="width-device-width, initial-scale=1, user-scalable=no"> -->
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
<?php
  }
  function socialMedia(){
?>
    <!-- Social media icons -->
    <div class="social-media">
      <ul class="social-media-icons">
        <li>
          <a href="https://www.facebook.com/Navleen1995" id="facebook" target="_blank">
            <i class="fa fa-facebook"></i>
          </a>
        </li>
        <li>
          <a href="http://linkedin.com/in/navleensingh" id="linkedin" target="_blank">
            <i class="fa fa-linkedin"></i>
          </a>
        </li>
        <li>
          <a href="https://github.com/SNavleen" id="github" target="_blank">
            <i class="fa fa-github"></i>
          </a>
        </li>
      </ul>
    </div>
<?php
  }
  function logo(){
?>
    <div class="logo-title-header">
      <!-- Logo -->
      <img src="img/radar.png" alt="Radar" class="radar-logo"></img>
      <!-- Title -->
      <h1 class="title-header">Phinder</h1>
    </div>
<?php
  }
  function searchForm(){
?>
    <!-- Quick search bar -->
    <div class="search-bar">
      <form method="get" class="search-form" action="allPhones.php">
        <label>
          <span class="screen-reader-text">Search for:</span>
          <input type="search" class="search-field" placeholder="Enter phone type to search..." value="" name="search-input"/>
    			<select name="rating" id="rating" class="rating-select">
    				<option value="1star">1 Star</option>
    				<option value="2star">2 Star</option>
    				<option value="3star">3 Star</option>
    				<option value="4star">4 Star</option>
    				<option value="5star" selected>5 Star</option>
    			</select>
    			<input type="text" class="location-select" placeholder="Enter a new Address..." value="" id="location" pattern="^[#.0-9a-zA-Z\s,-]+$"/>
        </label>
    		<input type="submit" class="search-submit" value="Submit">
    		<!-- This will be a pop up using javascript -->
    		<!-- <a href="#" id="advance-search" target="_blank">
    			<i class="advance-search-submit">Advance Search</i>
    		</a> -->
      </form>
    </div>
<?php
  }
  //Navigation bar for all the different pages
  function navigation($currentPage){
		global $userPagesLoggedin;
	  global $userPages;
		print_r($_COOKIE);
		if(isset($_COOKIE['loginCredentials']) && !empty(isset($_COOKIE['loginCredentials']))){
			$tabs = $userPagesLoggedin;
		}else{
			$tabs = $userPages;
		}
    // $callingFile = debug_backtrace()[0]['file'];
  	echo '<nav class="container menu">';
  	echo '<ul>';
  	//Put all the pages in a li tag with the current page having a highlited background
  	foreach($tabs as $file => $page){
  		if($page==$currentPage){
  			echo '<li><a href="'.$file.'" class="current-page"><span>'.$page.'</span></a></li>';
  		}else{
  			echo '<li><a href="'.$file.'"><span>'.$page.'</span></a></li>';
  		}
  	}
  	echo '</ul>';
  	echo '</nav>';
  }

  function footer(){
?>
    <!-- Footer for all the pages showing copyright information -->
    <footer class="container">
      <div class="copyright-text">
        <p>
          &copy; 2018 All Rights Reserved. Developed <b>Navleen Singh</b>
        </p>
        <ul>
          <li>Terms and conditions</li>
          <li>Advertise</li>
          <li>Contact</li>
        </ul>
      </div>
    </footer>
<?php
  }
?>
