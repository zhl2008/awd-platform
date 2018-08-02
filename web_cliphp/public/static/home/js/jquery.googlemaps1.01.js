/*
 ### jQuery Google Maps Plugin v1.01 ###
 * Home: http://www.mayzes.org/googlemaps.jquery.html
 * Code: http://www.mayzes.org/js/jquery.googlemaps1.01.js
 * Date: 2010-01-14 (Thursday, 14 Jan 2010)
 * 
 * Dual licensed under the MIT and GPL licenses.
 *   http://www.gnu.org/licenses/gpl.html
 *   http://www.opensource.org/licenses/mit-license.php
 ###
*/
jQuery.fn.googleMaps = function(options) {

	if (!window.GBrowserIsCompatible || !GBrowserIsCompatible())  {
	   return this;
	}

	// Fill default values where not set by instantiation code
	var opts = $.extend({}, $.googleMaps.defaults, options);
	
	//$.fn.googleMaps.includeGoogle(opts.key, opts.sensor);
	return this.each(function() {
		// Create Map
		$.googleMaps.gMap = new GMap2(this, opts);
		$.googleMaps.mapsConfiguration(opts);
	});
};

$.googleMaps = {
	mapsConfiguration: function(opts) {
		// GEOCODE
		if ( opts.geocode ) {
			geocoder = new GClientGeocoder();
			geocoder.getLatLng(opts.geocode, function(center) {
				if (!center) {
					alert(address + " not found");
				}
				else {
    	      		$.googleMaps.gMap.setCenter(center, opts.depth);
					$.googleMaps.latitude = center.x;
					$.googleMaps.longitude = center.y;
				}
      		});
		}
		else {
			// Latitude & Longitude Center Point
			var center 	= $.googleMaps.mapLatLong(opts.latitude, opts.longitude);
			// Set the center of the Map with the new Center Point and Depth
			$.googleMaps.gMap.setCenter(center, opts.depth);
		}
		
		// POLYLINE
		if ( opts.polyline )
			// Draw a PolyLine on the Map
			$.googleMaps.gMap.addOverlay($.googleMaps.mapPolyLine(opts.polyline));
		// GEODESIC 
		if ( opts.geodesic ) {
			$.googleMaps.mapGeoDesic(opts.geodesic);
		}
		// PAN
		if ( opts.pan ) {
			// Set Default Options
			opts.pan = $.googleMaps.mapPanOptions(opts.pan);
			// Pan the Map
			window.setTimeout(function() {
				$.googleMaps.gMap.panTo($.googleMaps.mapLatLong(opts.pan.panLatitude, opts.pan.panLongitude));
			}, opts.pan.timeout);
		}
		
		// LAYER
		if ( opts.layer )
			// Set the Custom Layer
			$.googleMaps.gMap.addOverlay(new GLayer(opts.layer));
		
		// MARKERS
		if ( opts.markers )
			$.googleMaps.mapMarkers(center, opts.markers);

		// CONTROLS
		if ( opts.controls.type || opts.controls.zoom ||  opts.controls.mapType ) {
			$.googleMaps.mapControls(opts.controls);
		}
		else {
			if ( !opts.controls.hide ) 
				$.googleMaps.gMap.setUIToDefault();
		}
		
		// SCROLL
		if ( opts.scroll ) 
			$.googleMaps.gMap.enableScrollWheelZoom();
		else if ( !opts.scroll )
			$.googleMaps.gMap.disableScrollWheelZoom();
		
		// LOCAL SEARCH
		if ( opts.controls.localSearch )
			$.googleMaps.gMap.enableGoogleBar();
		else 
			$.googleMaps.gMap.disableGoogleBar();

		// FEED (RSS/KML)
		if ( opts.feed ) 
			$.googleMaps.gMap.addOverlay(new GGeoXml(opts.feed));
		
		// TRAFFIC INFO
		if ( opts.trafficInfo ) {
			var trafficOptions = {incidents:true};
			trafficInfo = new GTrafficOverlay(trafficOptions);
			$.googleMaps.gMap.addOverlay(trafficInfo);	
		}
		
		// DIRECTIONS
		if ( opts.directions ) {
			$.googleMaps.directions = new GDirections($.googleMaps.gMap, opts.directions.panel);
  			$.googleMaps.directions.load(opts.directions.route);
		}
		
		if ( opts.streetViewOverlay ) {
			svOverlay = new GStreetviewOverlay();
    		$.googleMaps.gMap.addOverlay(svOverlay);	
		}
	},
	mapGeoDesic: function(options) {
		// Default GeoDesic Options
		geoDesicDefaults = {
			startLatitude: 	37.4419,
			startLongitude: -122.1419,
			endLatitude:	37.4519,
			endLongitude:	-122.1519,
			color: 			'#ff0000',
			pixels: 		2,
			opacity: 		10
		}
		// Merge the User & Default Options
		options = $.extend({}, geoDesicDefaults, options);
		var polyOptions = {geodesic:true};
		var polyline = new GPolyline([ 
			new GLatLng(options.startLatitude, options.startLongitude),
			new GLatLng(options.endLatitude, options.endLongitude)], 
			options.color, options.pixels, options.opacity, polyOptions
		);
		$.googleMaps.gMap.addOverlay(polyline);
	},
	localSearchControl: function(options) {
		var controlLocation = $.googleMaps.mapControlsLocation(options.location);
		$.googleMaps.gMap.addControl(new $.googleMaps.gMap.LocalSearch(), new GControlPosition(controlLocation, new GSize(options.x,options.y)));
	},
	getLatitude: function() {
		return $.googleMaps.latitude;
	},
	getLongitude: function() {
		return $.googleMaps.longitude;
	},
	directions: {},
	latitude: '',
	longitude: '',
	latlong: {},
	maps: {},
	marker: {},
	gMap: {},
	defaults: {
	// Default Map Options
		latitude: 	37.4419,
		longitude: 	-122.1419,
		depth: 		13,
		scroll: 	true,
		trafficInfo: false,
		streetViewOverlay: false,
		controls: {
			hide: false,
			localSearch: false
		},
		layer:		null
	},
	mapPolyLine: function(options) {
		// Default PolyLine Options
		polylineDefaults = {
			startLatitude: 	37.4419,
			startLongitude: -122.1419,
			endLatitude:	37.4519,
			endLongitude:	-122.1519,
			color: 			'#ff0000',
			pixels: 		2
		}
		// Merge the User & Default Options
		options = $.extend({}, polylineDefaults, options);
		//Return the New Polyline
		return new GPolyline([
			$.googleMaps.mapLatLong(options.startLatitude, options.startLongitude),
			$.googleMaps.mapLatLong(options.endLatitude, options.endLongitude)], 
			options.color, 
			options.pixels
		);
	},
	mapLatLong: function(latitude, longitude) {
		// Returns Latitude & Longitude Center Point
		return new GLatLng(latitude, longitude);
	},
	mapPanOptions: function(options) {
		// Returns Panning Options
		var panDefaults = {
			panLatitude:	37.4569, 	
			panLongitude:	-122.1569,
			timeout: 		0
		}
		return options = $.extend({}, panDefaults, options);
	},
	mapMarkersOptions: function(icon) {
		//Define an icon
		var gIcon = new GIcon(G_DEFAULT_ICON);	
		if ( icon.image ) 
			// Define Icons Image
			gIcon.image = icon.image;
		if ( icon.shadow )
			// Define Icons Shadow
			gIcon.shadow = icon.shadow;
		if ( icon.iconSize )
			// Define Icons Size
			gIcon.iconSize = new GSize(icon.iconSize);
		if ( icon.shadowSize )
			// Define Icons Shadow Size
			gIcon.shadowSize = new GSize(icon.shadowSize);
		if ( icon.iconAnchor )
			// Define Icons Anchor
			gIcon.iconAnchor = new GPoint(icon.iconAnchor);
		if ( icon.infoWindowAnchor )
			// Define Icons Info Window Anchor
			gIcon.infoWindowAnchor = new GPoint(icon.infoWindowAnchor);
		if ( icon.dragCrossImage ) 
			// Define Drag Cross Icon Image
			gIcon.dragCrossImage = icon.dragCrossImage;
		if ( icon.dragCrossSize )
			// Define Drag Cross Icon Size
			gIcon.dragCrossSize = new GSize(icon.dragCrossSize);
		if ( icon.dragCrossAnchor )
			// Define Drag Cross Icon Anchor
			gIcon.dragCrossAnchor = new GPoint(icon.dragCrossAnchor);
		if ( icon.maxHeight )
			// Define Icons Max Height
			gIcon.maxHeight = icon.maxHeight;
		if ( icon.PrintImage )
			// Define Print Image
			gIcon.PrintImage = icon.PrintImage;
		if ( icon.mozPrintImage )
			// Define Moz Print Image
			gIcon.mozPrintImage = icon.mozPrintImage;
		if ( icon.PrintShadow )
			// Define Print Shadow
			gIcon.PrintShadow = icon.PrintShadow;
		if ( icon.transparent )
			// Define Transparent
			gIcon.transparent = icon.transparent;
		return gIcon;
	},
	mapMarkers: function(center, markers) {
        if ( typeof(markers.length) == 'undefined' )
        	// One marker only. Parse it into an array for consistency.
            markers = [markers];
		
		var j = 0;
		for ( i = 0; i<markers.length; i++) {
			var gIcon = null;
			if ( markers[i].icon ) {
				gIcon = $.googleMaps.mapMarkersOptions(markers[i].icon);
			}
			
			if ( markers[i].geocode ) {
				var geocoder = new GClientGeocoder();
				geocoder.getLatLng(markers[i].geocode, function(center) {										
					if (!center) 
						alert(address + " not found");
					else 
						$.googleMaps.marker[i] = new GMarker(center, {draggable: markers[i].draggable, icon: gIcon});
				});
			}
			else if ( markers[i].latitude && markers[i].longitude ) {
				// Latitude & Longitude Center Point
				center = $.googleMaps.mapLatLong(markers[i].latitude, markers[i].longitude);
				$.googleMaps.marker[i] = new GMarker(center, {draggable: markers[i].draggable, icon: gIcon});
			}
			$.googleMaps.gMap.addOverlay($.googleMaps.marker[i]);
			if ( markers[i].info ) {
				// Hide Div Layer With Info Window HTML
				$(markers[i].info.layer).hide();
				// Marker Div Layer Exists
				if ( markers[i].info.popup )
					// Map Marker Shows an Info Box on Load
					$.googleMaps.marker[i].openInfoWindowHtml($(markers[i].info.layer).html());
				else
					$.googleMaps.marker[i].bindInfoWindowHtml( $(markers[i].info.layer).html().toString() );
			}
		}
	},
	mapControlsLocation: function(location) {
		switch (location) {
			case 'G_ANCHOR_TOP_RIGHT' :
				return G_ANCHOR_TOP_RIGHT;
			break;
			case 'G_ANCHOR_BOTTOM_RIGHT' :
				return G_ANCHOR_BOTTOM_RIGHT;
			break;
			case 'G_ANCHOR_TOP_LEFT' :
				return G_ANCHOR_TOP_LEFT;
			break;
			case 'G_ANCHOR_BOTTOM_LEFT' :
				return G_ANCHOR_BOTTOM_LEFT;
			break;
		}
		return;
	},
	mapControl: function(control) {
		switch (control) {
			case 'GLargeMapControl3D' :
				return new GLargeMapControl3D();
			break;
			case 'GLargeMapControl' :
				return new GLargeMapControl();
			break;
			case 'GSmallMapControl' :
				return new GSmallMapControl();
			break;
			case 'GSmallZoomControl3D' :
				return new GSmallZoomControl3D();
			break;
			case 'GSmallZoomControl' :
				return new GSmallZoomControl();
			break;
			case 'GScaleControl' :
				return new GScaleControl();
			break;
			case 'GMapTypeControl' :
				return new GMapTypeControl();
			break;
			case 'GHierarchicalMapTypeControl' :
				return new GHierarchicalMapTypeControl();
			break;
			case 'GOverviewMapControl' :
				return new GOverviewMapControl();
			break;
			case 'GNavLabelControl' :
				return new GNavLabelControl();
			break;
		}
		return;
	},
	mapTypeControl: function(type) {
		switch ( type ) {
			case 'G_NORMAL_MAP' :
				return G_NORMAL_MAP;
			break;
			case 'G_SATELLITE_MAP' :
				return G_SATELLITE_MAP;
			break;
			case 'G_HYBRID_MAP' :
				return G_HYBRID_MAP;
			break;
		}
		return;
	},
	mapControls: function(options) {
		// Default Controls Options
		controlsDefaults = {
			type: {
				location: 'G_ANCHOR_TOP_RIGHT',
				x: 10,
				y: 10,
				control: 'GMapTypeControl'
			},
			zoom: {
				location: 'G_ANCHOR_TOP_LEFT',
				x: 10,
				y: 10,
				control: 'GLargeMapControl3D'
			}
		};
		// Merge the User & Default Options
		options = $.extend({}, controlsDefaults, options);
		options.type = $.extend({}, controlsDefaults.type, options.type);
		options.zoom = $.extend({}, controlsDefaults.zoom, options.zoom);
		
		if ( options.type ) {
			var controlLocation = $.googleMaps.mapControlsLocation(options.type.location);
			var controlPosition = new GControlPosition(controlLocation, new GSize(options.type.x, options.type.y));
			$.googleMaps.gMap.addControl($.googleMaps.mapControl(options.type.control), controlPosition);
		}
		if ( options.zoom ) {
			var controlLocation = $.googleMaps.mapControlsLocation(options.zoom.location);
			var controlPosition = new GControlPosition(controlLocation, new GSize(options.zoom.x, options.zoom.y))
			$.googleMaps.gMap.addControl($.googleMaps.mapControl(options.zoom.control), controlPosition);
		}
		if ( options.mapType ) {
			if ( options.mapType.length >= 1 ) {
				for ( i = 0; i<options.mapType.length; i++) {
					if ( options.mapType[i].remove )
						$.googleMaps.gMap.removeMapType($.googleMaps.mapTypeControl(options.mapType[i].remove));
					if ( options.mapType[i].add )
						$.googleMaps.gMap.addMapType($.googleMaps.mapTypeControl(options.mapType[i].add));
				}
			} 
			else {
				if ( options.mapType.add )
					$.googleMaps.gMap.addMapType($.googleMaps.mapTypeControl(options.mapType.add));
				if ( options.mapType.remove )
					$.googleMaps.gMap.removeMapType($.googleMaps.mapTypeControl(options.mapType.remove));
			}
		}
	},
	geoCode: function(options) {
		geocoder = new GClientGeocoder();
		
		geocoder.getLatLng(options.address, function(point) {
			if (!point)
				alert(address + " not found");
			else
          		$.googleMaps.gMap.setCenter(point, options.depth);
      	});
	}
};