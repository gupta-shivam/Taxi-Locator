function myMap() 
{
	var a =5;
	if(navigator.geolocation)
	{
			var optn = 
			{
				enableHighAccuracy:true,
				timeout:Infinity,
				maximumAge:0
			};
			navigator.geolocation.getCurrentPosition(success  );
	
	}
	else
	{
		alert("geolocation Not enabled");
	}
    

	function success(position)
	{
		
		var userLoc = new google.maps.LatLng( position.coords.latitude , position.coords.longitude);
			
			var mapOptions =
					  		{
						    	center: userLoc,
						    	zoom: 12,
						    	//draggable:false,
						    	// scrollwheel : false,
						    	mapTypeId : google.maps.MapTypeId.ROADMAP
					  		};


			var mapCanvas = document.getElementById("map");
			
			var map = new google.maps.Map(mapCanvas, mapOptions);

			var UsrImg = {
						url: 'images/rick-loc.png',
						scaledSize: new google.maps.Size(70, 70)
					};

			var UserMark = new google.maps.Marker({position:userLoc , icon:UsrImg});
			
			UserMark.setMap(map);
			
			var UserInfo = new google.maps.InfoWindow({
				content:"YOUR LOCATION:"+position.coords.latitude+","+position.coords.longitude
			});

	
			google.maps.event.addListener(UserMark , "click" , function(){map.panTo(userLoc);map.setZoom(16);UserInfo.open(Map , UserMark)});

			$.post("driver.php",{ lat:position.coords.latitude , lon : position.coords.longitude},function(){});
	}
			setTimeout(myMap, 10000);
}
