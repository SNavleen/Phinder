<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
  // TODO: allow the user to update there information
  // TODO: fix the filed inputs
  // TODO: fix the javascript for account update information
  // unset($_COOKIE['loginCredentials']);
	// if(!(isset($_COOKIE['loginCredentials']) && !empty(isset($_COOKIE['loginCredentials'])))){
	// 	setcookie("loginCredentials", "", (time() - (60*60)), "/");
	// }
	// // print_r($_COOKIE);
	// // Run this section of code if the form was submitted
	// if(!empty($_POST)){
	// 	// Get the keys of the form that is submitted
	// 	$keys  = array_keys($_POST);
	// 	// Connect to the database
	// 	$dbh = mysqlConnect(DSN, MYSQL_MANAGER_USER, MYSQL_MANAGER_PASS);
	// 	$tbl = TBL_USERS;
	// 	$query = '';
	// 	// Generate query for login or register form
	// 	if(in_array("login-form", $keys)){
	// 		$email = $_POST["email-field-l"];
	// 		$pswd = $_POST["password-field"];
	// 		$query = "SELECT userId, email, salt, pswd
	// 							FROM $tbl
	// 							WHERE
	// 							  email = :email";
	// 		$stmt = $dbh->prepare($query);
	// 		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	// 	}
  //
	// 	try {
	// 		$stmt->execute();
  //   } catch (PDOException $exception) {
	// 		// Check if the query errors
	// 		// Check if the entry is a duplicate so the same email cant register twice
	// 		if($exception->errorInfo[1] == 1062){
	// 			die ("<html><script language='JavaScript'>alert('The email address already exists! Please try a different one.'),history.go(-1)</script></html>");
	// 		}else{
	// 			die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	// 		}
	// 	}
  //
	// 	// Run if the login form to validate password
	// 	if(in_array("login-form", $keys)){
	// 		$count = $stmt->rowCount();
	// 		// If there are 0 rows exit
	// 		if($count === 0){
	// 			die ("<html><script language='JavaScript'>alert('You do not have an account yet! Please create one.'),history.go(-1)</script></html>");
	// 		}
	// 		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// 		// Check the hash value with the salt and itterations
	// 		if (password_verify($pswd, $results[0]['pswd'])) {
	// 			// Password was verifyed
	// 		} else {
	// 			die ("<html><script language='JavaScript'>alert('Password is invalid ! Please try again.'),history.go(-1)</script></html>");
	// 		}
	// 	}
	// }
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
