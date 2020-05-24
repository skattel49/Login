<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<title>Clone.com</title>
	</head>

	<body>
		<?php 
			if(!isset($_SESSION['user'])){
				echo '<h2>Login</h2>
					<form action="includes/login.inc.php" method="post">
						<label for="usr">Username:</label>
						<input type="text" id="usr" name="usr">
						<label for="pwd">Password:</label>
						<input type="password" id="pwd" name="pwd">
						<input type="submit" value="Login" name="Login">
					</form>

					<div class="container-md p-3 my-3 bg-dark text-white">
						<h2>Signup</h2>
						<form action="includes/signup.inc.php" method="post">
							<input type="text" name="uid" placeholder="User Name">
							<input type="text" name="email" placeholder="Email">
							<br>
							<input type="password" name="pwd" placeholder="New Password">
							<input type="password" name="repwd" placeholder="Repeat Password">
							<br>
							<input type="submit" name="Signup" value="Signup">
						</form>
					</div>';
			}
		?>
		