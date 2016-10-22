<?php
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
			<h2>Driver Registeration</h2>
		</div>

		<form method="post" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>'>
			Username : &ensp; <input type="text" name="username" required autocomplete="false"><br><br>
			Password : &ensp; <input type="Password" name="password" required autocomplete="false"><br><br>
			<input type="submit" name="Register">
			&ensp;
			<a href='index.php'><input type="button" value="Go Back"></a>
		</form>
	</fieldset>
	<?php
		$username = "";
		$password = "";
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$username = testInput($_POST['username']);
			$query_un = "SELECT * FROM driverlogin WHERE username = '$username';";
			// echo $query_un;
			$res = mysqli_query($conn , $query_un);
			$resRows = mysqli_num_rows($res);
			if ($resRows == 0) {
				$password= testInput($_POST['password']);
				$password = sha1($password);
				$query = "INSERT INTO driverlogin (username, password) VALUES ('$username' , '$password');";
				$conn->query($query);
				$driverreg = "INSERT into driver(id , longitude , latitude ,avail) VALUES('$username' , 0.0 , 0.0 , false);";
				$conn->query($driverreg);
				echo "<script> alert('Registration Successful'); </script>";
			} else {
				echo "<script> alert('This username already exists!');</script>";
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