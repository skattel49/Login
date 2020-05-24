<?php
	$servername = "localhost";
	$dbName = "Resume";
	$dbUser = "root";
	$dbPwd = "";

	//establish connection with the database
	$conn = mysqli_connect($servername, $dbUser, $dbPwd, $dbName);

	if(!$conn){
		die("Connection to the database failed ".mysqli_connect_error());
	}