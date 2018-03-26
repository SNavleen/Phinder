<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
	// Connect to the database
	$dbh = mysqlConnect(DSN, MYSQL_GENERAL_USER, MYSQL_GENERAL_PASS);
	$tblItems = TBL_ITEMS;
	$tblReviews = TBL_ITEMREVIEW;

	$query = '';
	$query = "SELECT itemId, name, address, details, avgRating
					  FROM $tblItems
						WHERE avgRating = (
							SELECT MAX(avgRating) AS avgRating
							FROM $tblItems
						)";

	$stmt = $dbh->prepare($query);

	// Run the query only if the file is uploaded
	try {
		$stmt->execute();
	} catch (PDOException $exception) {
		echo $exception;
		// Check if the query errors
		// die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	}
	$topItem = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Phinder | Home</title>
		<?php
			$img = str_replace(' ', '%20', $topItem["name"]);
			echo "<style>
							@media screen and (min-width:0px) and (max-width:500px){

							  .item-rating-border{
							    background-image: url(img/items/".$img.".png);
							  }
							}

							@media screen and (min-width:500px){
							  .top-item {
							    background-image: url(img/items/".$img.".png);
							  }
							}
						</style>";
			cssImport();
			javascriptImport();
			googleAPI('', 'js', '');
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
			navigation('Home');
		?>

    <!-- Main content of the home page -->
    <main class="container">
      <!-- Top phone of the day -->
      <div class="top-item">
				<div class="item-info">
					<!-- <img src="img/items/pixel2.png" alt="Pixel2" class="top-item-img"></img> -->
          <!-- Rating number as a small image -->
          <div class="item-rating-border">
						<div class="item-rating">
							<?php echo $topItem[0]['avgRating'];?>
						</div>
					</div>
	        <!-- Button to navigate to view more information on the item -->
					<div class="item-button">
	        	<a href="phone?itemId=<?php echo $topItem[0]['itemId'];?>"><?php echo $topItem[0]['name'];?></a>
					</div>
	        <!-- Title of the item -->
		      <!-- <a href="phone/pixel2.html"> -->
	        	<!-- <h2 class="top-item-name"></h2> -->
						<!-- <img src="img/items/pixel2.png" alt="Pixel2" class="top-item-img"></img> -->
					<!-- </a> -->
	        <!-- Small Discription of item -->
	        <div class="top-item-mini-discription">
	          <p>
							<?php echo $topItem[0]['details'];?>
	          </p>
	        </div>
				</div>
      </div>
    </main>

    <?php
			footer();
		?>
	</body>
</html>
