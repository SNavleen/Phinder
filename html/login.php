<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
	unset($_COOKIE['loginCredentials']);
	if(!(isset($_COOKIE['loginCredentials']) && !empty(isset($_COOKIE['loginCredentials'])))){
		setcookie("loginCredentials", "", (time() - (60*60)), "/");
	}
	// print_r($_COOKIE);
	// Run this section of code if the form was submitted
	if(!empty($_POST)){
		// Get the keys of the form that is submitted
		$keys  = array_keys($_POST);
		// Connect to the database
		$dbh = mysqlConnect(DSN, MYSQL_MANAGER_USER, MYSQL_MANAGER_PASS);
		$tbl = TBL_USERS;
		$query = '';
		// Generate query for login or register form
		if(in_array("login-form", $keys)){
			$email = $_POST["email-field-l"];
			$pswd = $_POST["password-field"];
			$query = "SELECT userId, email, salt, pswd
								FROM $tbl
								WHERE
								  email = :email";
			$stmt = $dbh->prepare($query);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		}else if(in_array("register-form", $keys)){
			$name = $_POST["name-field"];
			$dob = $_POST["date-field"];
			$email = $_POST["email-field-r"];
			$pswd = $_POST["password-field"];
			// Get a salt
			$salt = bin2hex(random_bytes(32));
			// Setup options for the encryption alogrithm
			$options = [
    		'rounds' => 1000,
    		'salt' => $salt,
			];
			// Hash the value with the salt and number of itterations (1000)
			$hash = password_hash($pswd, CRYPT_SHA512, $options);

			$query = "INSERT INTO $tbl
							  SET
							    email = :email,
									dob = :dob,
									salt = :salt,
									pswd = :hash";
			if($name != ''){
				$query = $query . ", name = :name";
			}
			$stmt = $dbh->prepare($query);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
			$stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
			$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
			if($name != ''){
				$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			}
		}

		try {
			$stmt->execute();
    } catch (PDOException $exception) {
			// Check if the query errors
			// Check if the entry is a duplicate so the same email cant register twice
			if($exception->errorInfo[1] == 1062){
				die ("<html><script language='JavaScript'>alert('The email address already exists! Please try a different one.'),history.go(-1)</script></html>");
			}else{
				die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
			}
		}

		// Run if the login form to validate password
		if(in_array("login-form", $keys)){
			$count = $stmt->rowCount();
			// If there are 0 rows exit
			if($count === 0){
				die ("<html><script language='JavaScript'>alert('You do not have an account yet! Please create one.'),history.go(-1)</script></html>");
			}
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Check the hash value with the salt and itterations
			if (password_verify($pswd, $results[0]['pswd'])) {
				// Password was verifyed
			} else {
				die ("<html><script language='JavaScript'>alert('Password is invalid ! Please try again.'),history.go(-1)</script></html>");
			}

			// Set cookie for 2 hours
			setcookie("loginCredentials", $results[0]['userId'], (time() + (60*60*2)), "/");
			// Redirect to accounts page once the user is loged in
			header("Location: account");
			die();
		}

		$email = $_POST["email-field-r"];
		$query = "SELECT userId
							FROM $tbl
							WHERE
								email = :email";
		$stmt = $dbh->prepare($query);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);

		try {
			$stmt->execute();
    } catch (PDOException $exception) {
			die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
		}
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// Set cookie for 2 hours
		setcookie("loginCredentials", $results[0]['userId'], (time() + (60*60*2)), "/");
		// Redirect to accounts page once the user is loged in
		header("Location: account");
		die();
	}
?>
<!doctype html>
	<head>
		<title>Phinder | Login</title>
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
			navigation('Login');
		?>

    <!-- Main content of the home page -->
    <main class="container">
      <div class="users">
        <div class="login">
          <label class="login-title"> Login </label>
          <form method="post" class="login-form" action="#">
            <input type="email" class="email-field" placeholder="Enter email address..." value="" name="email-field-l" id="email-field-l" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
            <input type="password" class="password-field" placeholder="Enter password..." value="" name="password-field" id="password-field" required/>
  					<input type="submit" class="login-submit" value="Submit" onclick="send('login')" name="login-form">
          </form>
        </div>

        <div class="register">
          <label class="register-title"> Register </label>
          <form method="post" class="register-form" action="#">
            <input type="text" class="name-field" placeholder="Enter full name..." value="" name="name-field" id="name-field"/>
						<input type="date" class="date-field" placeholder="YYYY-MM-DD" value="" name="date-field" id="date-field" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required/>
            <input type="email" class="email-field" placeholder="Enter email address..." value="" name="email-field-r" id="email-field-r" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
            <input type="password" class="password-field" placeholder="Enter password..." value="" name="password-field" id="password-field" required/>
  					<input type="submit" class="register-submit" value="Submit" onclick="send('register')" name="register-form">
          </form>
        </div>
      </div>
    </main>

    <?php
			footer();
		?>
	</body>
</html>
