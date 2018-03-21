<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
	// Connect to the database
	$dbh = mysqlConnect(DSN, MYSQL_GENERAL_USER, MYSQL_GENERAL_PASS);
	$tblItems = TBL_ITEMS;
	$tblReviews = TBL_ITEMREVIEW;

	$itemId = $_GET["itemId"];
	$name = $_GET["name"];
	print_r($_GET);
	$query = '';
	$query = "SELECT itemId, name, address, details, avgRating
					  FROM $tblItems
					  WHERE";
	if($itemId != ''){
		$query = $query . " itemId = :itemId";
	}else if($name != ''){
		$query = $query . " name = :name";
	}
	$stmt = $dbh->prepare($query);
	if($itemId != ''){
		$stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
	}else if($name != ''){
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	}

	// Run the query only if the file is uploaded
	try {
		$stmt->execute();
	} catch (PDOException $exception) {
		// Check if the query errors
		die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	}
	$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$item = $items[0];

	// $query = "SELECT itemId, name, address, details, avgRating
	// 					FROM $tbl
	// 					WHERE";
	// if($itemId != ''){
	// 	$query = $query . " itemId = :itemId";
	// }else if($name != ''){
	// 	$query = $query . " name = :name";
	// }
	// $stmt = $dbh->prepare($query);
	// if($itemId != ''){
	// 	$stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
	// }else if($name != ''){
	// 	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	// }

	// // Run the query only if the file is uploaded
	// try {
	// 	$stmt->execute();
	// } catch (PDOException $exception) {
	// 	// Check if the query errors
	// 	die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	// }
	// $item = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Phinder | Pixel 2</title>
		<?php
			$img = str_replace(' ', '%20', $item["name"]);
			echo "<style>
							.selected-item{
								background-image: url(img/items/".$img.".png);
							}
						</style>";
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
			navigation('Phones');
		?>

    <!-- Main content of the home page -->
    <main class="container">
      <!-- Single item -->
      <div class="selected-item">
				<div class="selected-item-info">
          <!-- Rating number as a small image -->
          <div class="selected-item-rating-border">
						<div class="selected-item-rating">
							<?php echo ($item["avgRating"] == '' ? "N/A" : $item["avgRating"]); ?>
						</div>
					</div>
	        <!-- Button to navigate to view more information on the item -->
					<div class="selected-item-button">
	        	<a><?php echo $item["name"]; ?></a>
					</div>
				</div>
      </div>

      <div class="overall-rating">
        Overall Average Rating:
				<span class="score s<?php echo ($item['avgRating'])*2;?>"></span>
      </div>

      <div class="selected-item-more-info">
        <p class="selected-item-discription">
					<?php echo $item["details"]; ?>
        </p>
        <iframe class="item-map" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&q=<?php echo $item["address"]; ?>" allowfullscreen></iframe>

        <div class="user-review">
          <h3>
            User Name
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star-half checked-star"></span>
          </h3>
          <p>
            This is a paragraph by a user who reviewed the Google Pixel2.
          </p>
        </div>

        <div class="new-review">
          <form class="new-review-form" action="#" method="post">
            <h4 class="title">Overall Rating:</h4>
						<select name="rating" id="rating" class="rating">
							<option value="1star">1 Star</option>
							<option value="2star">2 Star</option>
							<option value="3star">3 Star</option>
							<option value="4star">4 Star</option>
							<option value="5star" selected>5 Star</option>
						</select>
            <!-- <img src="../img/4.9-rating.png" alt="Pixel2" class="rating-image" height="100" width="100"></img> -->
            <h4 class="title">Select for anonymous:</h4>
						<input type="checkBox" class="anonymous-checkBox" checked name="anonymous-checkBox"/>
            <h4 class="title">Comments:</h4>
            <textarea class="comments" name="comments"></textarea>
            <input type="submit" class="submit-review" name="submit-review"/>
          </form>
        </div>
      </div>
    </main>

    <?php
			footer();
		?>
	</body>
</html>
