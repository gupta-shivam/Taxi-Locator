<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<?php
	require_once('connectdatabase.php');
?>
<head>
	<title>IIT-G E-Rickshaw Locator-Driver
	</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src='driverMap.js'></script> 
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxR4LhyTXahsKnMUdr39fcTEhvW6zigVU&callback=myMap"></script>
	<script>
		function logout()
		{
			$.post("index.php" , {avail: false} , function(){});
			window.location.replace("index.php");
		}
	</script>
</head>
</head>
<body>
	<div id="map">IITG_MAP</div>

	<?php 
		$id=$_SESSION["username"];
		echo $id; 
		if (isset($_POST['lat']) && isset($_POST['lon'])) 
		{	
			$lat = $_POST['lat'];
			$lon = $_POST['lon'];
	    	// echo $lat;
	    	// echo $lon;
	    	//echo not working but datais being sent
	    	$id=$_SESSION["username"];
	    	//editing sql command
	    	$query = "UPDATE driver SET longitude=$lon,latitude=$lat,avail=true WHERE id = '$id';";
	    	echo $query;
	    	$conn->query($query);
		}
		?> 

		<button type="button" id="logout" onclick='logout()'>log out</button>

		<!-- 
			here can call jquery function as in drivermap.js and $.post. and with avail =0 and 
/need to see to cal php function from jquery for that.. we just know $.post for post and not for general php function to delete session variable 
		-->
</body>
</html>