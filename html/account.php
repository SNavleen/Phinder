<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
  // TODO: allow the user to update there information
  // TODO: fix the filed inputs
  // TODO: fix the javascript for account update information
?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Phinder | Account</title>
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
			navigation('Account');
		?>

    <!-- Main content of the home page -->
    <main class="container">
      <div class="update">
        <label class="update-title"> Update Account </label>
        <form method="post" class="update-account" action="#">
          <input type="text" class="update-name-field" placeholder="Enter full name..." value="<?php echo $name;?>" name="name-field" id="name-field"/>
          <input type="date" class="update-date-field" placeholder="YYYY-MM-DD" value="<?php echo $dob;?>" name="date-field" id="date-field" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"/>
          <input type="email" class="update-email-field" placeholder="Enter email address..." value="<?php echo $email;?>" name="email-field-r" id="email-field-r" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/>
          <input type="password" class="update-password-field" placeholder="Enter old password..." value="" name="old-password-field" id="old-password-field"/>
          <input type="password" class="update-password-field" placeholder="Enter new password..." value="" name="new-password-field" id="new-password-field"/>
          <input type="password" class="update-password-field" placeholder="Enter new password again..." value="" name="retype-new-password-field" id="password-field"/>
          <input type="submit" class="update-submit" value="Submit" onclick="send('update-account')" name="update-account">
        </form>
      </div>
      <!-- <form method="post" class="loginout-form" action="login">
        <input class="submit" type="button" value="Log out"/>
      </form> -->
    </main>

    <?php
			footer();
		?>
	</body>
</html>
