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

	$query = "SELECT reviewId, itemId, userId, rating, review
						FROM $tblReviews
						WHERE
							itemId = :itemId";

	$stmt = $dbh->prepare($query);
	$stmt->bindParam(':itemId', $item['itemId'], PDO::PARAM_INT);

	// Run the query only if the file is uploaded
	try {
		$stmt->execute();
	} catch (PDOException $exception) {
		// Check if the query errors
		die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	}
	$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
				<?php
					foreach ($reviews as $key => $review){
						$userName = 'Anonymous';
						if($review['userId'] != ''){
							$dbh = mysqlConnect(DSN, MYSQL_MANAGER_USER, MYSQL_MANAGER_PASS);
							$tblUsers = TBL_USERS;
							$query = "SELECT name
												FROM $tblUsers
												WHERE
													userId = :userId";

							$stmt = $dbh->prepare($query);
							$stmt->bindParam(':userId', $review['userId'], PDO::PARAM_INT);

							// Run the query only if the file is uploaded
							try {
								$stmt->execute();
							} catch (PDOException $exception) {
								// Check if the query errors
								die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
							}
							$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$user = $users[0];
							if($users['name'] != ''){
								$userName = $users['name'];
							}
						}
				?>
		        <div class="user-review">
		          <h3>
		            <?php echo $userName;?>
								<span class="score s<?php echo ($review['rating'])*2;?>"></span>
		          </h3>
		          <p>
		            <?php echo $review['review'];?>
		          </p>
		        </div>
				<?php
					}
				?>

        <div class="new-review">
          <label class="review-title"> New Review </label>
          <form class="new-review-form" action="#" method="post">
            <?php rating()?>
            <h4 class="title">Select for anonymous:</h4>
						<input type="checkBox" class="anonymous-checkBox" checked name="anonymous-checkBox"/>
            <!-- <h4 class="title">Comments:</h4> -->
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
