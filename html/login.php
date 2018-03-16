<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
	// Run this section of code if the form was submitted
	if(!empty($_POST)){
		// Get the keys of the form that is submitted
		$keys  = array_keys($_POST);
		// Connect to the database
		$mysqli = new mysqli(SERVER, MYSQL_MANAGER_USER, MYSQL_MANAGER_PASS, DB);
		// Die if you cant connect to database
		if ($mysqli->connect_errno) {
			die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
		}
		$query = '';
		// Generate query for login or register form
		if(in_array("login-form", $keys)){
			$email = $_POST["email-field-l"];
			$pswd = $_POST["password-field"];
			$query = "SELECT email, salt, pswd".
							 " FROM " . TBL_USERS . ";";
							 // " WHERE" .
							 // "   email = '" . $email . "';";
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
			$query = "INSERT INTO " . TBL_USERS .
							 " SET" .
							 "   email = '" . $email . "'," .
							 "   dob = '" . $dob . "'," .
							 "   salt = '" . $salt . "'," .
							 "   pswd = '" . $hash . "'";
			if($name != ''){
				$query = $query . ", name = '" . $name . "';";
			}else{
				$query = $query . " ;";
			}
		}
		// Check if the query errors
		if (!$result = $mysqli->query($query)) {
			// Check if the entry is a duplicate so the same email cant register twice
	    if($mysqli->errno == 1062){
				die ("<html><script language='JavaScript'>alert('The email address already exists! Please try a different one.'),history.go(-1)</script></html>");
			}else{
				die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
			}
		}
		// Run if the login form to validate password
		if(in_array("login-form", $keys)){
			// If there are 0 rows exit
			if($result->num_rows === 0){
				die ("<html><script language='JavaScript'>alert('You do not have an account yet! Please create one.'),history.go(-1)</script></html>");
			}
			// Get the row
			$userInformation = $result->fetch_assoc();
			// Check the hash value with the salt and itterations
			if (password_verify($pswd, $userInformation['pswd'])) {
				echo 'Password is valid!';
			} else {
				die ("<html><script language='JavaScript'>alert('Password is invalid ! Please try again.'),history.go(-1)</script></html>");
			}
		}

		// Free up results
		$result->free();
		// Close MYSQL connection
		$mysqli->close();
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
			 searchForm();
			?>
    </header>

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
