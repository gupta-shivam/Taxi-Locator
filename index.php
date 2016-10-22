<?php
	session_start();
	require_once('connectdatabase.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		IIT-G E-Rickshaw Locator
	</title>
</head>

<body>
	<?php
		if(isset($_POST['avail']))
		{
			$id = $_SESSION["username"];
			echo $id;
			$query = "UPDATE driver SET avail = false WHERE id = '$id';";
			$conn->query($query);
			session_unset();
			session_destroy();
		}

	?>
	<fieldset>
		<div id="heading">
			<h1>IIT-G E-Rickshaw Locator </h1>
			<h2>kindly login as per the role</h2>
		</div>

		<div id="user">
			<a href="user.php"><button id="user_bt">User</button></a>
		</div><br>

		<div id="driver">
			<a href="driverLogin.php"><button id="driver_bt">Driver</button></a>
		</div><br>

		<div id="register">
			<a href="register.php"><button id="register_bt">Register as a Driver</button></a>
		</div>
	</fieldset>		
</body>
</html>