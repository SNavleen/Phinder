<?php
	$homePath = $_SERVER['DOCUMENT_ROOT'];
  $generalPath = $homePath . "/../generalPageSetup.php";
	include_once($generalPath);
?>
<!doctype html>
<html lang="en-US">
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
            <input type="email" class="email-field" placeholder="Enter email address..." value="" id="email-field-l" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
            <input type="password" class="password-field" placeholder="Enter password..." value="" id="password-field" required/>
  					<input type="submit" class="login-submit" value="Submit" onclick="send('login')">
          </form>
        </div>

        <div class="register">
          <label class="register-title"> Register </label>
          <form method="post" class="register-form" action="#">
            <input type="text" class="name-field" placeholder="Enter full name..." value="" id="name-field"/>
						<input type="date" class="date-field" value="" id="date-field" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required/>
            <input type="email" class="email-field" placeholder="Enter email address..." value="" id="email-field-r" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
            <input type="password" class="password-field" placeholder="Enter password..." value="" id="password-field" required/>
  					<input type="submit" class="register-submit" value="Submit" onclick="send('register')">
          </form>
        </div>
      </div>
    </main>

    <?php
			footer();
		?>
	</body>
</html>
