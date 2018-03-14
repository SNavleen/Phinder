<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/generalPageSetup.php";
	include_once($generalPath);
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
			 searchForm();
			?>
    </header>

		<?php
			navigation('New Review');
		?>

    <!-- Main content of the home page -->
    <main class="container">
      <div class="new-phone">
        <form method="post" class="new-phone-form" action="#">
					<h4 class="name-title">New Phone Information</h4>
					<select name="rating" id="rating" class="rating">
						<option value="1star">1 Star</option>
						<option value="2star">2 Star</option>
						<option value="3star">3 Star</option>
						<option value="4star">4 Star</option>
						<option value="5star" selected>5 Star</option>
					</select>
          <input type="text" class="location-field" placeholder="Enter a new Address..." value="" id="location-field" pattern="^[#.0-9a-zA-Z\s,-]+$" required/>
					<input type="file" name="img-of-item" id="img-of-item" class="img-of-item"/>
          <input type="text" class="phone-name-field" placeholder="Enter a new Phone..." value="" name="phone-name-field" required/>
					<textarea class="details" name="details" required></textarea>
					<input type="submit" class="new-phone-submit" value="Submit" onclick="send(newPhone)">
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
			<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXz0SgsK0Sup3LUBtLo5AkiwWhBqgzJbg&callback=newLocation"></script>
    </main>

    <?php
			footer();
		?>
	</body>
</html>
