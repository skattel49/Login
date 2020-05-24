<?php
	if(isset($_POST['Login'])){
		require "dbh.inc.php";
		$username = $_POST['usr'];
		$password = $_POST['pwd'];
		$query = "SELECT * FROM users WHERE uid = ?";
		$stmt = mysqli_stmt_init($conn);
		//sending the query with placeholders
		if(!mysqli_stmt_prepare($stmt, $query)){
			header("Location: ../index.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			if($row){
				$pwdCheck = password_verify($password, $row['pwd']);
				if($pwdCheck == false){
					header("Location: ../index.php?error=invalidpwd");
					exit();
				}
				else{
					session_start();
					$_SESSION['user'] = $username;
					$_SESSION['id'] = $row['id'];
					header("Location: ../index.php?login=success");
					exit();
				}
			}
			else{
				header("Location: ../index.php?error=invalidusernameorpassword");
				exit();
			}
		}
	}
	else{
		header("Location: ../index.php");
		exit();
	}