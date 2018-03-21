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
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" async="async"></script>
    <script src="js/general.js" type="text/javascript"></script>
    <script src="js/newPhone.js" type="text/javascript"></script>
    <script src="js/form.js" type="text/javascript"></script>
    <script src="js/allPhones.js" type="text/javascript"></script>
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
	function rating(){
?>
		<fieldset class="rating">
	    <input type="radio" id="star5" name="rating" value="5" /><label class = "full fa fa-star-o" for="star5" title="Awesome - 5 stars"></label>
	    <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half fa fa-star-o" for="star4half" title="Pretty good - 4.5 stars"></label>
	    <input type="radio" id="star4" name="rating" value="4" /><label class = "full fa fa-star-o" for="star4" title="Pretty good - 4 stars"></label>
	    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half fa fa-star-o" for="star3half" title="Meh - 3.5 stars"></label>
	    <input type="radio" id="star3" name="rating" value="3" /><label class = "full fa fa-star-o" for="star3" title="Meh - 3 stars"></label>
	    <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half fa fa-star-o" for="star2half" title="Kinda bad - 2.5 stars"></label>
	    <input type="radio" id="star2" name="rating" value="2" /><label class = "full fa fa-star-o" for="star2" title="Kinda bad - 2 stars"></label>
	    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half fa fa-star-o" for="star1half" title="Meh - 1.5 stars"></label>
	    <input type="radio" id="star1" name="rating" value="1" /><label class = "full fa fa-star-o" for="star1" title="Sucks big time - 1 star"></label>
	    <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half fa fa-star-o" for="starhalf" title="Sucks big time - 0.5 stars"></label>
		</fieldset>
<?php
	}
  function searchForm(){
?>
    <!-- Quick search bar -->
    <div class="search-bar">
      <form method="post" class="search-form" action="allPhones.php">
        <label>
          <span class="screen-reader-text">Search for:</span>
					<?php rating(); ?>
          <input type="search" class="search-field" placeholder="Enter phone type to search..." value="" name="search-input"/>
    			<input type="text" class="location-select" placeholder="Enter a new Address..." value="" name="location" id="location" pattern="^[#.0-9a-zA-Z\s,-]+$"/>
        </label>
    		<input type="submit" class="search-submit" id="search-form" value="Submit">
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

  /*
    How to use the function googleAPI
	    googleAPI();
	    googleAPI('geocode/', 'json', 'address=157 whiteny ave hamilton on');
	    googleAPI('geocode/', 'json', 'latlng=43.239368,-79.959027');
  */
	function googleAPI($path, $outputFormat, $parameters){
		$key = 'key='.GOOGLE_MAPS_API_KEY;
		$src = GOOGLE_MAPS_BASE_URL.$path.$outputFormat.'?'.$key;
		if($parameters != ''){
			$src = $src.'&'.$parameters;
		}
    echo'<script async defer src="'.$src.'"></script>';
	}
  function mysqlConnect($dsn, $user, $pass){
  	try {
      $dbh = new PDO($dsn, $user, $pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	} catch (PDOException $e) {
  	  die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
  	}
    return $dbh;
  }

?>
