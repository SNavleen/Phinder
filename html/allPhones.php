<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);

	// Get the keys of the form that is submitted
	$keys  = array_keys($_POST);
	// Connect to the database
	$mysqli = new mysqli(SERVER, MYSQL_GENERAL_USER, MYSQL_GENERAL_PASS, DB);
	// Die if you cant connect to database
	if ($mysqli->connect_errno) {
		die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	}
	$query = '';
	// Generate query for search form
	$rating = $_POST["rating"];
	$searchInput = $_POST["search-input"];
	$location = $_POST["location"];
	if($rating == ''){
		$rating = 5;
	}
	$query = "SELECT itemId, name, address, details, avgRating".
					 " FROM " . TBL_ITEMS .
					 " WHERE" .
					 "   address LIKE '%" . $location . "%'" .
					 "   AND name LIKE '%" . $searchInput . "%';";

	// Check if the query errors
	if (!$result = $mysqli->query($query)) {
		die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	}

	// If there are 0 rows exit
	if($result->num_rows === 0){
		die ("<html><script language='JavaScript'>alert('There are no search results! Please try again.'),history.go(-1)</script></html>");
	}
?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Phinder | Search Results</title>
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
						while ($item = $result->fetch_assoc()){
							print_r($item);
							$itemId = $item["itemId"];
							$name = $item["name"];
							$discription = $item["details"];
							$avgRating = $item["avgRating"];
							if($avgRating <= $rating){
								if($avgRating == ''){
									$avgRating = 'NULL';
								}
								$phoneUrl = "phone?id=" . $itemId;
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

<?php
// Free up results
$result->free();

// Close MYSQL connection
$mysqli->close();
?>
