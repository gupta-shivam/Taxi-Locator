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
	<fieldset>
		<div id="heading">
			<h1>IIT-G E-Rickshaw Locator </h1>
			<h2>kindly login as DRIVER</h2>
		</div>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
			Username : &emsp; <input type="text" name="DriverUN" required autocomplete="false">
			<br><br>
			Password : &emsp; <input type="Password" name="DriverPW" required autocomplete="false">
			<br><br>
			<input type="submit" name="" value="Log In">
		</form>

	</fieldset>
	<?php 
		$username = "";
		$password = "";
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$username = testInput($_POST['DriverUN']);
			$password = testInput($_POST['DriverPW']);
			$pass = sha1($password);
			// echo $username. " ". $password. " ". $pass;
			$command = "SELECT * FROM driverlogin WHERE username = '$username' AND password = '$pass';";
			
			$res = mysqli_query($conn , $command);
			$res_Rows = mysqli_num_rows($res);
			if ($res_Rows == 1) {
				$_SESSION["username"]=$username;
				
				header('Location: driver.php');
			} else {
				echo "<script>
							alert('Wrong username and/or password');
						</script>";
			}
		}

		function testInput($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
</body>
</html>