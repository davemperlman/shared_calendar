<?php 
require 'config.php';
$status = '';

// Authentication of User credentials
if ( isset($_POST['submit']) ) {
	$result = $conn->sign_in($_POST['username'], $_POST['password']);
	$result ? $_SESSION['id'] = $result['id']: $status = 'Invalid Login Credentials';
}

isset( $_SESSION['id'] ) ? header('location:home.php') : '';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dave's Shared Calendar</title>
</head>
<body>
	<form method="post">
		<fieldset>
			<legend>Log-In</legend>
			<ul>
				<p><?php echo $status; ?></p>
				<li>
					<label hidden="hidden" for="username">Username:</label>
					<input name="username" id="username" type="text" autofocus="autofocus" required="required" placeholder="Enter your Username">
				</li>
				<li>
					<label hidden="hidden" for="password">Password:</label>
					<input name="password" id="password" type="password" required="required" placeholder="Enter your password">
				</li>
				<li>
					<input type="submit" name="submit" value="Log In">
				</li>
			</ul>
		</fieldset>
	</form>
</body>
</html>