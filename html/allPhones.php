<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
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
					<h4><b>Type:</b> Phone</h4>
					<h4><b>Stars:</b> 5</h4>
					<h4><b>Location:</b> Hamilton</h4>
				</div>
				<div class="item-map" id="map"></div>
				<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXz0SgsK0Sup3LUBtLo5AkiwWhBqgzJbg&callback=initMap"></script>
				<table class="all-item-info">

	        <!-- Table headers -->
	        <tr class="table-headers">
						<th>Rating</th>
						<th>Name</th>
						<th>Picture</th>
						<th>Discription</th>
	        </tr>

					<!-- Rating number as a small image -->
					<tr class="all-item">
						<td class="all-rating-border">
							<div class="all-item-rating">
								4.5
							</div>
						</td>
						<!-- Button to navigate to view more information on the item -->
						<td class="all-item-button">
							<a>iPhone7 Plus</a>
						</td>
						<!-- Title of the item -->
						<td>
							<!-- <h2 class="top-item-name"></h2> -->
							<img src="img/items/iPhone7Plus.png" alt="iPhone7Plus" class="all-item-name" height="100" width="100"></img>
						</td>
						<!-- Small Discription of item -->
						<td class="all-item-mini-discription">
							<p>
								iPhone 7 Plus is a smartphones designed, developed, and marketed by Apple Inc.
							</p>
						</td>
					</tr>

					<!-- Rating number as a small image -->
					<tr class="all-item">
						<td class="all-rating-border">
							<div class="all-item-rating">
								4
							</div>
						</td>
						<!-- Button to navigate to view more information on the item -->
						<td class="all-item-button">
							<a>Nexus5X</a>
						</td>
						<!-- Title of the item -->
						<td>
							<!-- <h2 class="top-item-name"></h2> -->
							<img src="img/items/nexus5X.png" alt="Nexus5X" class="all-item-name" height="100" width="100"></img>
						</td>
						<!-- Small Discription of item -->
						<td class="all-item-mini-discription">
							<p>
								Nexus 5X (codenamed bullhead) is an Android smartphone manufactured by LG Electronics, co-developed with and marketed by Google Inc.
						</td>
					</tr>

					<!-- Rating number as a small image -->
					<tr class="all-item">
						<td class="all-rating-border">
							<div class="all-item-rating">
								4.5
							</div>
						</td>
						<!-- Button to navigate to view more information on the item -->
						<td class="all-item-button">
							<a>SamsungS8</a>
						</td>
						<!-- Title of the item -->
						<td>
							<!-- <h2 class="top-item-name"></h2> -->
							<img src="img/items/samsungS8.png" alt="SamsungS8" class="all-item-name" height="100" width="100"></img>
						</td>
						<!-- Small Discription of item -->
						<td class="all-item-mini-discription">
							<p>
								The Samsung Galaxy S8 is an Android smartphones produced by Samsung Electronics as part of the Samsung Galaxy S series.
							</p>
						</td>
					</tr>

				</table>
			</div>

    </main>

    <?php
			footer();
		?>
	</body>
</html>
