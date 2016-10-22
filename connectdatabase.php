<?php
	$database = "rickshaw";
	$username = "root";
	$server = "localhost";
	$password = '';

	$conn = new mysqli($server , $username , $password , $database);
	
	if(!$conn)
		echo "<script>
				alert('Connection to database can't be made');
			</script>";
?>