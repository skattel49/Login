<?php 
	require "header.php";
?>

<main>
	<?php
		if(isset($_SESSION['user'])){
			echo '<h2>You are logged in</h2>';
			echo '<form action="includes/logout.inc.php" method="post">
					<input type="submit" name="Logout" value="Logout">
				</form>';
		}
	?>
	
</main>

<?php  
	require "footer.php";
?>