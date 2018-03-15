<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Phinder | Pixel 2</title>
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
			 searchForm();
			?>
    </header>

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
							5
						</div>
					</div>
	        <!-- Button to navigate to view more information on the item -->
					<div class="selected-item-button">
	        	<a>Pixel2</a>
					</div>
	        <!-- Title of the item -->
		      <!-- <a> -->
	        	<!-- <h2 class="top-item-name"></h2> -->
						<!-- <img src="../img/items/pixel2.png" alt="Pixel2" class="selected-item-name" height="100" width="100"></img> -->
					<!-- </a> -->
	        <!-- Small Discription of item -->

				</div>
      </div>

      <div class="overall-rating">
        Overall Average Rating:
        <span class="fa fa-star checked-star"></span>
        <span class="fa fa-star checked-star"></span>
        <span class="fa fa-star checked-star"></span>
        <span class="fa fa-star checked-star"></span>
        <span class="fa fa-star checked-star"></span>
      </div>

      <div class="selected-item-more-info">
        <div class="selected-item-discription">
          <h4>General Information:</h4>
          <ul>
            <li><b>Developer:</b> Google</li>
            <li><b>Manufacturer:</b> HTC Pixel 2</li>
            <li><b>Series:</b> Pixel</li>
            <li><b>Type Pixel 2:</b> Smartphone</li>
            <li><b>OS:</b>	Android 8.0 "Oreo"</li>
            <li><b>Memory:</b> 4 GB LPDDR4X RAM</li>
            <li><b>Storage:</b> 64 or 128 GB</li>
            <li><b>Battery:</b> 2,700 mAh</li>
            <li><b>Display:</b> 5 in (130 mm) FHD AMOLED, 1920 × 1080 (441 ppi)</li>
          </ul>
        </div>
        <div class="selected-item-discription">
          <h4>Dimensions:</h4>
          <ul>
            <li><b>Height:</b> 145.7 mm (5.74 in)</li>
            <li><b>Width:</b> 69.7 mm (2.74 in)</li>
            <li><b>Depth:</b> 7.8 mm (0.31 in)</li>
            <li><b>Weight:</b> 143 g (5.04 oz)</li>
          </ul>
        </div>
        <div class="selected-item-discription">
          <h4>Rear camera:</h4>
          <ul>
            <li>12.2 MP</li>
            <li>1.4 µm pixel size</li>
            <li>f/1.8 aperture</li>
            <li>Phase-detection autofocus and laser autofocus</li>
            <li>HDR+ processing</li>
            <li>Dual pixel</li>
            <li>HD 720p (up to 240 FPS)</li>
            <li>FHD 1080p video (up to 120 FPS)</li>
            <li>4K 2160p video (up to 30 FPS)</li>
          </ul>
        </div>
        <div class="selected-item-discription">
          <h4>Front camera:</h4>
          <ul>
            <li>8 MP</li>
            <li>Sony Exmor IMX179</li>
            <li>1.4 µm pixel size</li>
            <li>f/2.4 aperture</li>
          </ul>
        </div>
        <iframe class="item-map" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDt46L43IvHUUR-evkjSpjL22i_H-Zda2c&q=14+Martindale+Crescent+Unit+1,+Ancaster,+ON+L9K+1J9" allowfullscreen></iframe>

        <div class="user-review">
          <h3>
            User Name
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            Date
          </h3>
          <p>
            This is a paragraph by a user who reviewed the Google Pixel2.
          </p>
        </div>

        <div class="user-review">
          <h3>
            User Name
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            Date
          </h3>
          <p>
            This is a paragraph by a user who reviewed the Google Pixel2.
          </p>
        </div>

        <div class="user-review">
          <h3>
            User Name
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            <span class="fa fa-star checked-star"></span>
            Date
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