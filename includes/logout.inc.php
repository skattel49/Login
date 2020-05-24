<?php

	if(isset($_POST['Logout'])){
		session_start();
		session_unset();
		session_destroy();
		header("Location:../index.php");
	}