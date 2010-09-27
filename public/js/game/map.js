$(document).ready(function() {


	// map question
	//
	//
	//
	//
	//
	// OL onClick event
	OpenLayers.Control.Click = OpenLayers.Class(OpenLayers.Control, {                
		defaultHandlerOptions: {
			'single': true,
			'double': false,
			'pixelTolerance': 0,
			'stopSingle': false,
			'stopDouble': false
		},

		initialize: function(options) {
			this.handlerOptions = OpenLayers.Util.extend(
				{}, this.defaultHandlerOptions
			);
			OpenLayers.Control.prototype.initialize.apply(
				this, arguments
			); 
			this.handler = new OpenLayers.Handler.Click(
				this, {
					'click': this.trigger
				}, this.handlerOptions
			);
		}, 

		trigger: function(e) {
			var lonlat = map.getLonLatFromViewPortPx(e.xy);
			mapClicked(lonlat);
		}

	});


	// the map
	var map = new OpenLayers.Map('map', {'maxResolution': 1.40625/2});

  	var layer = new OpenLayers.Layer.WMS("World Map", 
              //	"http://labs.metacarta.com/wms-c/Basic.py?", 
				"http://vmap0.tiles.osgeo.org/wms/vmap0?LAYERS=basic",
				{layers: 'basic', format: 'image/png'});


 	map.addLayers([layer]);
	// center over germany
  	map.setCenter(new OpenLayers.LonLat(9.8,51.3), 4);

	var click = new OpenLayers.Control.Click();
	map.addControl(click);
	click.activate();

	function mapClicked(lonlat) {
		// distance between two geocoordinates
		function distance(lat1, lon1, lat2, lon2, unit) {
				var radlat1 = Math.PI * lat1/180
				var radlat2 = Math.PI * lat2/180
				var radlon1 = Math.PI * lon1/180
				var radlon2 = Math.PI * lon2/180
				var theta = lon1-lon2
				var radtheta = Math.PI * theta/180
				var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
				dist = Math.acos(dist)
				dist = dist * 180/Math.PI
				dist = dist * 60 * 1.1515
				if (unit=="K") { dist = dist * 1.609344 }
				if (unit=="N") { dist = dist * 0.8684 }
				return dist
			} 

		var lat = $('#lat').text(); 
		var lon = $('#lon').text();

		var distance = distance(lonlat.lat, lonlat.lon, lat, lon, "K");
		var isRight = "right";
		var title;
		var message;
		if (distance <= 10) {
			title = 'Sehr gut!';	
			message = 'Abweichung von '  + distance.toFixed(2);
		} else if (distance <= 50) {
			title = 'Gut!';	
			message = 'Abweichung von '  + distance.toFixed(2);
		} else if (distance <= 100) {
			title = 'Passt!';	
			message = 'Abweichung von '  + distance.toFixed(2);
		} else {
			title = 'Leider nicht gut genug!';	
			message = 'Abweichung von '  + distance.toFixed(2);
			isRight = "wrong";
		}
		message+= " km";

		$.post("/game/answerrequest/answer/" + isRight,
				function (response) {

				},"text");

 		var markers = new OpenLayers.Layer.Markers( "Markers" );
		map.addLayer(markers);

		var size = new OpenLayers.Size(21,25);
		var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
		var icon = new OpenLayers.Icon('/img/green_flag.png',size,offset);
		markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lon,lat),icon));
			
		var markers = new OpenLayers.Layer.Markers( "Markers" );
		map.addLayer(markers);

		var size = new OpenLayers.Size(21,25);
		var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
		var icon = new OpenLayers.Icon('/img/red_flag.png',size,offset);
		markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lonlat.lon,lonlat.lat),icon));

		click.deactivate();

		$("#dialog").html(message);
		$( "#dialog" ).dialog({ title: title,
							    buttons: [{ text: "Weiter",
								click: function() { 
									window.location.replace('/game');
									$(this).dialog("close"); }
								}]
		 });
		
	}

	

});
