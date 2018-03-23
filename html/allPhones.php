<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);

	// Get the keys of the form that is submitted
	$keys  = array_keys($_POST);
	// Connect to the database
	$mysqli = new mysqli(SERVER, MYSQL_GENERAL_USER, MYSQL_GENERAL_PASS, DB);
	$dbh = mysqlConnect(DSN, MYSQL_GENERAL_USER, MYSQL_GENERAL_PASS);
	$tbl = TBL_ITEMS;

	$query = '';
	// Generate query for search form
	$rating = $_POST["rating"];
	$searchInput = $_POST["search-input"];
	$location = $_POST["location"];
	//TODO: fix the rating search
	//TODO: fix the location search (radius around users current location)
	if($rating == ''){
		$rating = 5;
	}
	$query = "SELECT itemId, name, address, details, avgRating
					  FROM $tbl
					  WHERE
					    address LIKE :location
					    AND name LIKE :searchInput
							-- AND avgRating = :rating";

	$stmt = $dbh->prepare($query);
	$locationBindParam = "%".$location."%";
	$searchInputBindParam = "%".$searchInput."%";
	$stmt->bindParam(':location', $locationBindParam, PDO::PARAM_STR);
	$stmt->bindParam(':searchInput', $searchInputBindParam, PDO::PARAM_STR);
	// $stmt->bindParam(':rating', $rating);

	try {
		$stmt->execute();
	} catch (PDOException $exception) {
		// Check if the query errors
		die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	}


	$count = $stmt->rowCount();
	// If there are 0 rows exit
	if($count === 0){
		die ("<html><script language='JavaScript'>alert('There are no search results! Please try again.'),history.go(-1)</script></html>");
	}
	$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$itemsJSON = json_encode($items, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Phinder | Search Results</title>
		<script type="text/javascript">
		    var itemsJSON = JSON.parse('<?php echo $itemsJSON; ?>');
		</script>
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
			navigation('Phones');
		?>

    <!-- Main content of the home page -->
    <main class="container">
      <!-- Most popular phones -->
			<div class="all-item">
				<!-- Title of the div -->
				<div class="all-title">
					<h2>Search Results</h2>
				</div>
				<!-- Show the search filter -->
				<div class="search-filter">
					<h4><b>Type:</b> <?php echo $searchInput?></h4>
					<h4><b>Stars:</b> <?php echo $rating?></h4>
					<h4><b>Location:</b> <?php echo $location?></h4>
				</div>
				<div class="item-map" id="map"></div>
				<?php googleAPI('', 'js', 'callback=initMap'); ?>
				<table class="all-item-info">

	        <!-- Table headers -->
	        <tr class="table-headers">
						<th>Rating</th>
						<th>Name</th>
						<th>Picture</th>
						<th>Discription</th>
	        </tr>
					<?php
						foreach ($items as $key => $item){
							$itemId = $item["itemId"];
							$name = $item["name"];
							$discription = $item["details"];
							$avgRating = $item["avgRating"];
							if($avgRating <= $rating){
								if($avgRating == ''){
									$avgRating = 'NULL';
								}
								$phoneUrl = "phone?itemId=" . $itemId;
								$imgPath = "img/items/" . $name . ".png";
					?>
								<!-- Rating number as a small image -->
								<tr class="all-item">
									<td class="all-rating-border">
										<div class="all-item-rating">
											<?php echo $avgRating;?>
										</div>
									</td>
									<!-- Button to navigate to view more information on the item -->
									<td class="all-item-button">
										<a href="<?php echo $phoneUrl;?>"><?php echo $name;?></a>
									</td>
									<!-- Title of the item -->
									<td>
										<!-- <h2 class="top-item-name"></h2> -->
										<img src="<?php echo $imgPath;?>" alt="iPhone7Plus" class="all-item-name" height="100" width="100"></img>
									</td>
									<!-- Small Discription of item -->
									<td class="all-item-mini-discription">
										<p>
											<?php echo $discription;?>
										</p>
									</td>
								</tr>
						<?php
								}
							}
						?>
				</table>
			</div>

    </main>

    <?php
			footer();
		?>
	</body>
</html>
