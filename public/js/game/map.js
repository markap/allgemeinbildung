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
              	"http://labs.metacarta.com/wms-c/Basic.py?", 
				{layers: 'basic', format: 'image/png'});


 	map.addLayers([layer]);
  	map.setCenter(new OpenLayers.LonLat(9.8,51.3), 5);

   	map.addControl(new OpenLayers.Control.Click());

	function mapClicked(lonlat) {
		console.log(lonlat);

		var mucLat = 48.1391265;
		var mucLng = 11.5801863;

		var distance = distance(lonlat.lat, lonlat.lon, mucLat, mucLng, "K");
		if (distance <= 10) {
			alert('sehr gut. abweichung ' + distance);
		} else if (distance <= 50) {
			alert('gut. abweichung ' + distance);
		} else if (distance <= 100) {
			alert('passt. abweichung ' + distance);
		} else {
			alert('nicht gut. abweichung' + distance);
		}
	}

	
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

});
