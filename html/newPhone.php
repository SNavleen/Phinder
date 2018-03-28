<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
	global $s3;

	// Run this section of code if the form was submitted
	if(!empty($_POST)){
		// Connect to the database
		$dbh = mysqlConnect(DSN, MYSQL_GENERAL_USER, MYSQL_GENERAL_PASS);
		$tbl = TBL_ITEMS;

		$query = '';
		$name = $_POST["phone-name-field"];
		$address = $_POST["location-field"];
 		$details = $_POST["details"];
		$query = "INSERT INTO $tbl
							SET
							  name = :name,
								details = :details,
						    address = :address";
 						 // "   avgRating = 0," .
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':address', $address, PDO::PARAM_STR);
		$stmt->bindParam(':details', $details, PDO::PARAM_STR);

		// Get image information
		// $img = pathinfo(basename($_FILES["img-of-item"]["name"]));
		$targetFile = $name . ".png";// . $img["extension"];

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			// Check if user uploaded an image
	    $check = getimagesize($_FILES["img-of-item"]["tmp_name"]);
	    if($check == false) {
				die ("<html><script language='JavaScript'>alert('Unable to upload image! Please try another image.'),history.go(-1)</script></html>");
	    }
			// Check file size
			if ($_FILES["img-of-item"]["size"] > 5000000) {
				die ("<html><script language='JavaScript'>alert('Unable to upload image, beacuse size is to big! Please try again later.'),history.go(-1)</script></html>");
			}
			// Upload image
			if ($s3->putObjectFile($_FILES["img-of-item"]["tmp_name"], S3_BKTNAME, $targetFile, S3::ACL_PUBLIC_READ)) {
				// Run the query only if the file is uploaded
				try {
					$stmt->execute();
		    } catch (PDOException $exception) {
					// Check if the query errors
					// Check if the entry is a duplicate so the same phone(item) cant be created twice
					if($mysqli->errno == 1062){
						die ("<html><script language='JavaScript'>alert('The phone already exists! Please use a different name.'),history.go(-1)</script></html>");
					}else{
						die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
					}
				}
	    } else {
	    	die ("<html><script language='JavaScript'>alert('Unable to upload image! Please try again later.'),history.go(-1)</script></html>");
	    }
		}

		// Redirect to accounts page once the user is loged in
		header("Location: phone?name=$name");
		die();
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
