<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
  // Connect to the database
  $dbh = mysqlConnect(DSN, MYSQL_MANAGER_USER, MYSQL_MANAGER_PASS);
  $tbl = TBL_USERS;
  $userId = $_COOKIE["loginCredentials"];
  $query = "SELECT email, dob, name, pswd, salt
            FROM $tbl
            WHERE
              userId = :userId";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);

  try {
    $stmt->execute();
  } catch (PDOException $exception) {
    die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
  }
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $user = $users[0];
  $name = $user["name"];
  $email = $user["email"];
  $dob = $user["dob"];
  $pswd = $user["pswd"];
  $salt = $user["salt"];

  if(!empty($_POST)){
    // Get the keys of the form that is submitted
    $keys  = array_keys($_POST);
    $query = '';
    // Generate query for login or register form
    $newName = $_POST["name-field"];
    $newDob = $_POST["date-field"];
    $newEmail = $_POST["email-field"];
    $oldPswd = $_POST["old-password-field"];

		// Check if user entered the correct old password
		if(!password_verify($oldPswd, $pswd)){
			echo "<script>alert('Old password is incorrect! Please try again.');window.location.href='account';</script>";
			die();
		}

		$newPswd = $_POST["new-password-field"];
		$newPswd2 = $_POST["retype-new-password-field"];
		// Get a salt
		$newSalt = bin2hex(random_bytes(32));
		// Setup options for the encryption alogrithm
		$options = [
			'rounds' => 1000,
			'salt' => $newSalt,
		];

		// Hash the value with the salt and number of itterations (1000)
		$newHash = password_hash($newPswd, CRYPT_SHA512, $options);
		if(!password_verify($newPswd2, $newHash)){
			die ("<html><script language='JavaScript'>alert('The new passwords don\'t match! Please try again.'),history.go(-1)</script></html>");
		}
		$newHash2 = password_hash($newPswd2, CRYPT_SHA512, $options);
		if(!password_verify($newPswd, $newHash2)){
			die ("<html><script language='JavaScript'>alert('The new passwords don\'t match! Please try again.'),history.go(-1)</script></html>");
		}

	  $query = "UPDATE $tbl
              SET
                name = :name,
	              email = :email,
                dob = :dob,
                salt = :salt,
                pswd = :hash
							WHERE
							  userId = :userId";

	  $stmt = $dbh->prepare($query);
		$stmt->bindParam(':name', $newName, PDO::PARAM_STR);
	  $stmt->bindParam(':email', $newEmail, PDO::PARAM_STR);
	  $stmt->bindParam(':dob', $newDob, PDO::PARAM_STR);
	  $stmt->bindParam(':hash', $newHash, PDO::PARAM_STR);
	  $stmt->bindParam(':salt', $newSalt, PDO::PARAM_STR);
	  $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
		// $stmt->debugDumpParams();

	  try {
	    $stmt->execute();
		  $name = $newName;
		  $email = $newEmail;
		  $dob = $newDob;
	  } catch (PDOException $exception) {
	    // Check if the query errors
			var_dump($exception->getMessage());
			// die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
	  }
  }
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
        <form method="post" class="update-account" class="update-account-form" action="#">
          <input type="text" class="update-name-field" placeholder="Enter full name..." value="<?php echo $name;?>" name="name-field" id="name-field"/>
          <input type="date" class="update-date-field" placeholder="YYYY-MM-DD" value="<?php echo $dob;?>" name="date-field" id="date-field" required pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"/>
          <input type="email" class="update-email-field" placeholder="Enter email address..." value="<?php echo $email;?>" name="email-field" id="email-field" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/>
          <input type="password" class="update-password-field" placeholder="Enter old password..." value="" name="old-password-field" id="old-password-field" required/>
          <input type="password" class="update-password-field" placeholder="Enter new password..." value="" name="new-password-field" id="new-password-field" required/>
          <input type="password" class="update-password-field" placeholder="Enter new password again..." value="" name="retype-new-password-field" id="retype-new-password-field" required/>
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
