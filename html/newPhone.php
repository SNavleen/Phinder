<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);

	// Run this section of code if the form was submitted
	if(!empty($_POST)){
		// Connect to the database
		$mysqli = new mysqli(SERVER, MYSQL_GENERAL_USER, MYSQL_GENERAL_PASS, DB);
		// Die if you cant connect to database
		if ($mysqli->connect_errno) {
			die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
		}

		$query = '';
		$name = $_POST["phone-name-field"];
		$address = $_POST["location-field"];
 		$details = $_POST["details"];
		$query = "INSERT INTO " . TBL_ITEMS .
						 " SET" .
						 "   name = '" . $name . "'," .
						 "   details = '" . $details . "'," .
						 "   address = '" . $address . "';";
		// echo "items: ". $query;

		if (!$result = $mysqli->query($query)) {
			// Check if the entry is a duplicate so the same email cant register twice
			if($mysqli->errno == 1062){
				die ("<html><script language='JavaScript'>alert('The phone already exists! Please use a different name.'),history.go(-1)</script></html>");
			}else{
				die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
			}
		}

		// Close MYSQL connection
		$mysqli->close();

		// Get image information
		$img = pathinfo(basename($_FILES["img-of-item"]["name"]));
		$targetDir = "img/items/";
		$targetFile = $targetDir . $name . "." . $img["extension"];

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			// Check if user uploaded an image
	    $check = getimagesize($_FILES["img-of-item"]["tmp_name"]);
	    if($check == false) {
				die ("<html><script language='JavaScript'>alert('Unable to upload image! Please upload an image.'),history.go(-1)</script></html>");
	    }
			// Check file size
			if ($_FILES["img-of-item"]["size"] > 5000000) {
				die ("<html><script language='JavaScript'>alert('Unable to upload image, beacuse size is to big! Please try again later.'),history.go(-1)</script></html>");
			}
			// Upload image
			if (move_uploaded_file($_FILES["img-of-item"]["tmp_name"], $targetFile)) {
				// File is uploaded
	    } else {
	    	die ("<html><script language='JavaScript'>alert('Unable to upload image! Please try again later.'),history.go(-1)</script></html>");
	    }
		}
		// TODO: reditrect the user to the review page
 		// $rating = $_POST["rating"];
		// $review = $_POST["review"];
		// $subQuerey = "SELECT itemId" .
		// 						" FROM " . TBL_ITEMS .
		// 						" WHERE " .
		// 						"   name = '" . $name . "'";
		// $query = "INSERT INTO " . TBL_ITEMREVIEW .
		// 				 " SET" .
		// 				 "   itemId = (" . $subQuerey . ")," .
		// 				 "   userId = '" . $_COOKIE['loginCredentials'] . "'," .
		// 				 "   rating = '" . $rating . "'," .
		// 				 "   review = '" . $review . "';";
		// 	 		echo "review: ". $query;
	 	// 	// Check if the query errors
	 	// 	if (!$result = $mysqli->query($query)) {
	 	// 		// die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	 	// 	}

	}
?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Phinder | New Review</title>
		<?php
			cssImport();
			javascriptImport();
			metaData();
		?>
	</head>
	<body>
    <!-- Title, logo, ocial media links, and  quick search bar-->
    <header class="container">
			<?php
			 socialMedia();
			 logo();
			?>
    </header>
		<div class="container search-bar">
			<?php
				searchForm();
			?>
		</div>

		<?php
			navigation('New Review');
		?>

    <!-- Main content of the home page -->
    <main class="container">
      <div class="new-phone">
        <form method="post" class="new-phone-form" action="#" enctype="multipart/form-data">
					<h4 class="name-title">New Phone Information</h4>
					<!-- <select name="rating" id="rating" class="rating">
						<option value="1star">1 Star</option>
						<option value="2star">2 Star</option>
						<option value="3star">3 Star</option>
						<option value="4star">4 Star</option>
						<option value="5star" selected>5 Star</option>
					</select> -->
          <input type="text" class="location-field" placeholder="Enter a new Address..." value="" id="location-field" name="location-field" pattern="^[#.0-9a-zA-Z\s,-]+$" required/>
					<input type="file" name="img-of-item" id="img-of-item" class="img-of-item" accept="file_extension|image/*" single required/>
          <input type="text" class="phone-name-field" placeholder="Enter a new Phone..." value="" name="phone-name-field" required/>
					<textarea class="details" name="details" required></textarea>
					<input type="submit" name="submit" class="new-phone-submit" value="Submit" onclick="send('newPhone')">
					<!-- I will be adding a new way to select star ratings -->
					<!-- <div class="rating">
						<span>&#9734;</span>
						<span>&#9734;</span>
						<span>&#9734;</span>
						<span>&#9734;</span>
						<span>&#9734;</span>
					</div> -->
        </form>
      </div>

			<div class="item-map" id="map"></div>
			<?php googleAPI('', 'js', 'callback=newLocation'); ?>
    </main>

    <?php
			footer();
		?>
	</body>
</html>
