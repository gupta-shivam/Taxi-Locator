<?php
	require_once('connectdatabase.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>IIT-G E-Rickshaw Locator-User</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<div id="map">IITG_MAP</div>
	<script>
		function myMap()
		{
			if(navigator.geolocation)
	  		{
	  			var optn = 
	  			{
	  				enableHighAccuracy:true,
	  				timeout:Infinity,
	  				maximumAge:0
	  			};
	  			// navigator.geolocation.getCurrentPosition(success , fail , optn);
	  			navigator.geolocation.getCurrentPosition(success);
	  			// alert("Found");
	  		}
	  		else
	  		{
	  			alert("geolocation Not enabled");
	  		}

	  		function success(position)
	  		{
	  			var Usrimg = {
		    			url: 'images/user-loc.png',
						scaledSize: new google.maps.Size(70, 70)
						};
				var RickImg = {
							url: 'images/rick-loc.png',
							scaledSize: new google.maps.Size(70, 70)
						};

	  			var userLoc = new google.maps.LatLng( position.coords.latitude , position.coords.longitude);
	  			var UserMark = new google.maps.Marker({position:userLoc , icon:Usrimg});
	  		
	  			var mapOptions =
		  		{
			    	center: userLoc,
			    	zoom: 12,
			    	mapTypeId : google.maps.MapTypeId.ROADMAP
		  		};
	  			var mapCanvas = document.getElementById("map");
	  			var map = new google.maps.Map(mapCanvas, mapOptions);

	  			UserMark.setMap(map);
	  			// rickshaw locatoin
	  			var xmlhttp = new XMLHttpRequest();
				var url = "jsondriver.php";
				xmlhttp.onreadystatechange=function()
				{
			    	if (this.readyState == 4 && this.status == 200) 
			    	{
			        	myFunction(this.responseText);
			    	}
				}
				xmlhttp.open("GET", url, false);
				xmlhttp.send();

				function myFunction(response) 
				{

			    	var arr = JSON.parse(response);
			    	var count = Object.keys(arr).length;
			    	for(i=0; i<count; i++)
			    	{
						var Rlat = arr[i]['latitude'] , Rlon = arr[i]['longitude'];
		  				// document.write(Rlat + " " + Rlon + " " + i);
		  				var Rickshaw = new google.maps.LatLng(Rlat,Rlon);
						var RMark = new google.maps.Marker({position:Rickshaw , icon:RickImg});
	  					RMark.setMap(map);
					}
				}

	  			var UserInfo = new google.maps.InfoWindow({
	  				content:"YOUR LOCATION:"+position.coords.latitude+","+position.coords.longitude
	  			});

	  			google.maps.event.addListener(UserMark , "click" , function(){map.panTo(userLoc);map.setZoom(16);UserInfo.open(Map , UserMark)});
	  			setInterval(myMap , 10000);
	  		}
	  	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxR4LhyTXahsKnMUdr39fcTEhvW6zigVU&callback=myMap"></script>
</body>
</html>