<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Phinder | Home</title>
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
							4.9
						</div>
					</div>
	        <!-- Button to navigate to view more information on the item -->
					<div class="item-button">
	        	<a href="phone/pixel2.php">Pixel2</a>
					</div>
	        <!-- Title of the item -->
		      <!-- <a href="phone/pixel2.html"> -->
	        	<!-- <h2 class="top-item-name"></h2> -->
						<!-- <img src="img/items/pixel2.png" alt="Pixel2" class="top-item-img"></img> -->
					<!-- </a> -->
	        <!-- Small Discription of item -->
	        <div class="top-item-mini-discription">
	          <p>
							Pixel 2 is an Android smartphones designed, developed and marketed by Google.
	          </p>
						<ul class="top-item-specs">
							<h4>Specs:</h4>
							<li>Height: 145.7 mm (5.74 in)</li>
							<li>Width: 69.7 mm (2.74 in)</li>
							<li>Depth: 7.8 mm (0.31 in)</li>
							<li>Weight: 143 g (5.04 oz)</li>
						</ul>
	        </div>
				</div>
      </div>

      <!-- Most popular phones -->
			<div class="most-popular-items">
				<div class="most-popular-item-info">
	        <!-- Title of the div -->
	        <div class="most-popular-title">
	          <h2>Most Popular</h2>
	        </div>

					<!-- Rating number as a small image -->
					<div class="most-popular-item">
						<div class="most-popular-rating-border">
							<div class="most-popular-item-rating fa fa-star">
								4.5
							</div>
						</div>
						<!-- Button to navigate to view more information on the item -->
						<div class="most-popular-item-button">
							<a href="#">iPhone7 Plus</a>
						</div>
						<!-- Title of the item -->
						<a>
							<!-- <h2 class="top-item-name"></h2> -->
							<img src="img/items/iPhone7Plus.png" alt="iPhone7Plus" class="most-popular-item-img"></img>
						</a>
						<!-- Small Discription of item -->
						<div class="most-popular-item-mini-discription">
							<p>
								iPhone 7 Plus is a smartphones designed, developed, and marketed by Apple Inc.
							</p>
						</div>
					</div>

					<!-- Rating number as a small image -->
					<div class="most-popular-item">
						<div class="most-popular-rating-border">
							<div class="most-popular-item-rating fa fa-star">
								4
							</div>
						</div>
						<!-- Button to navigate to view more information on the item -->
						<div class="most-popular-item-button">
							<a href="#">Nexus5X</a>
						</div>
						<!-- Title of the item -->
						<a>
							<!-- <h2 class="top-item-name"></h2> -->
							<img src="img/items/nexus5X.png" alt="Nexus5X" class="most-popular-item-img"></img>
						</a>
						<!-- Small Discription of item -->
						<div class="most-popular-item-mini-discription">
							<p>
								Nexus 5X (codenamed bullhead) is an Android smartphone manufactured by LG Electronics, co-developed with and marketed by Google Inc.
						</div>
					</div>

					<!-- Rating number as a small image -->
					<div class="most-popular-item">
						<div class="most-popular-rating-border">
							<div class="most-popular-item-rating fa fa-star">
								4.5
							</div>
						</div>
						<!-- Button to navigate to view more information on the item -->
						<div class="most-popular-item-button">
							<a href="#">SamsungS8</a>
						</div>
						<!-- Title of the item -->
						<a>
							<!-- <h2 class="top-item-name"></h2> -->
							<img src="img/items/samsungS8.png" alt="SamsungS8" class="most-popular-item-img"></img>
						</a>
						<!-- Small Discription of item -->
						<div class="most-popular-item-mini-discription">
							<p>
								The Samsung Galaxy S8 is an Android smartphones produced by Samsung Electronics as part of the Samsung Galaxy S series.
							</p>
						</div>
					</div>

				</div>
			</div>

			<!-- Editor's choice phones -->
			<div class="editors-choice-item">
				<div class="editors-item-info">
					<!-- Title of the div -->
					<div class="editors-choice-title">
						<h2>Editor's Choice</h2>
					</div>

					<!-- Rating number as a small image -->
					<div class="editors-item">
						<div class="editors-item-rating-border">
							<div class="editors-item-rating fa fa-star">
								4.5
							</div>
						</div>
						<!-- Button to navigate to view more information on the item -->
						<div class="editors-item-button">
							<a href="#">iPhone7 Plus</a>
						</div>
						<!-- Title of the item -->
						<a>
							<!-- <h2 class="top-item-name"></h2> -->
							<img src="img/items/iPhone7Plus.png" alt="iPhone7Plus" class="editors-item-img"></img>
						</a>
						<!-- Small Discription of item -->
						<div class="editors-item-mini-discription">
							<p>
								iPhone 7 Plus is a smartphones designed, developed, and marketed by Apple Inc.
							</p>
						</div>
					</div>

					<!-- Rating number as a small image -->
					<div class="editors-item">
						<div class="editors-item-rating-border">
							<div class="editors-item-rating fa fa-star">
								4
							</div>
						</div>
						<!-- Button to navigate to view more information on the item -->
						<div class="editors-item-button">
							<a href="#">Nexus5X</a>
						</div>
						<!-- Title of the item -->
						<a>
							<!-- <h2 class="top-item-name"></h2> -->
							<img src="img/items/nexus5X.png" alt="Nexus5X" class="editors-item-img"></img>
						</a>
						<!-- Small Discription of item -->
						<div class="editors-item-mini-discription">
							<p>
								Nexus 5X (codenamed bullhead) is an Android smartphone manufactured by LG Electronics, co-developed with and marketed by Google Inc.
						</div>
					</div>

					<!-- Rating number as a small image -->
					<div class="editors-item">
						<div class="editors-item-rating-border">
							<div class="editors-item-rating fa fa-star">
								4.5
							</div>
						</div>
						<!-- Button to navigate to view more information on the item -->
						<div class="editors-item-button">
							<a href="#">SamsungS8</a>
						</div>
						<!-- Title of the item -->
						<a>
							<!-- <h2 class="top-item-name"></h2> -->
							<img src="img/items/samsungS8.png" alt="SamsungS8" class="editors-item-img"></img>
						</a>
						<!-- Small Discription of item -->
						<div class="editors-item-mini-discription">
							<p>
								The Samsung Galaxy S8 is an Android smartphones produced by Samsung Electronics as part of the Samsung Galaxy S series.
							</p>
						</div>
					</div>

				</div>
			</div>

    </main>

    <?php
			footer();
		?>
	</body>
</html>
