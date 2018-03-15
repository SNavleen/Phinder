<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
	if(!empty($_POST)){
		$keys  = array_keys($_POST);
		$mysqli = new mysqli('localhost', MYSQL_MANAGER_USER, MYSQL_MANAGER_PASS 'sakila');
		$query = '';
		if(in_array("login-form", $keys)){
			$email = $_POST["email-field-l"];
			$pswd = $_POST["password-field"];
		}else if(in_array("register-form", $keys)){
			$name = $_POST["name-field"];
			$dob = $_POST["date-field"];
			$email = $_POST["email-field-r"];
			$pswd = $_POST["password-field"];
		}
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
						<input type="date" class="date-field" value="" name="date-field" id="date-field" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required/>
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
