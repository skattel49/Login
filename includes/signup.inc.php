<?php

	if(isset($_POST['Signup'])){
		require "dbh.inc.php";
		//if the user comes from the homepage
		$username = $_POST['uid'];
		$email = $_POST['email'];
		$password = $_POST['pwd'];
		$passwordRepeat = $_POST['repwd'];

		//check for errors in the form
		if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
		 	header("Location: ../index.php?error=emptyfields");
		 	exit();
		 }
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
		 	header("Location: ../index.php?error=invaliduidemail");
		 	exit();
		 }
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 	header("Location: ../index.php?error=invalidemail&uid=".$username);
		 	exit();
		 }
		elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
		 	header("Location: ../index.php?error=invaliduid&email=".$email);
		 	exit();
		 }
		elseif ($password !== $passwordRepeat){
		 	header("Location: ../index.php?error=passwordcheck&email=".$email."&uid=".$username);
		 	exit();
		 }
		else{
			$query = "SELECT * FROM users WHERE uid=?";
			//initializing db for our query
			$stmt = mysqli_stmt_init($conn);
			//executing the query with place holders
			if(!mysqli_stmt_prepare($stmt, $query)){
				header("Location: ../index.php?error=sqlerror");
				exit();
			}
			else{
				//bind the username to the placeholder
				mysqli_stmt_bind_param($stmt, "s", $username);
				//execute the sql query
				mysqli_stmt_execute($stmt);
				//store the result as an associative array
				mysqli_stmt_store_result($stmt);
				$rows = mysqli_stmt_num_rows($stmt);

				if($rows>0){
					header("Location: ../index.php?error=usertaken");
					exit();
				}
				else{
					$query = "INSERT INTO users(uid, email, pwd) VALUES (?, ?, ?)";
					if(!mysqli_stmt_prepare($stmt, $query)){
						header("Location: ../index.php?error=sqlerror");
						exit();
					}
					else{
						$hashedpwd = password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedpwd);
						mysqli_stmt_execute($stmt);
						header("Location: ../index.php?signup=success");
					}
				}
			}
		 }
		 mysqli_stmt_close($stmt);
		 mysqli_close($conn);
	}
	else{
		header("Location: ../index.php");
		exit();
	}