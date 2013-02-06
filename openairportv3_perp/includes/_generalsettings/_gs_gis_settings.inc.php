<?php
// GIS Settings

// The purpose of this page is to store some information for use by the Map Reports and by the GIS Exporting Procedures.

	// Large Map is: 'part139_327_airportmap_new_mapit.png'
	//		x: 2000 pixels, 
	//		y: 2290 pixels
			$largemap_i 		= 'part139_327_airportmap_new_mapit.png';
			$largemap_x 		= 2000;
			$largemap_y 		= 2290;
	//	Array Element					0					1						2								
			$alargemap			= array($largemap_i			, $largemap_x			, $largemap_y );
	
	// Small Map is: 'part139_327_airportmap_new_color.png'
	//		x: 733 pixels
	//		y: 839 pixels
			$smallmap_i 		= 'part139_327_airportmap_new_color.png';
			$smallmap_x 		= 733;
			$smallmap_y 		= 839;
	//	Array Element					0					1						2			
			$asmallmap			= array($smallmap_i			, $smallmap_x			, $smallmap_y );
			
	// Small Map is: 'part139_327_airportmap_new_bw.png'
	//		x: 733 pixels
	//		y: 839 pixels
			$smallmap_i 		= 'part139_327_airportmap_new_bw.png';
			$smallmap_x 		= 733;
			$smallmap_y 		= 839;
	//	Array Element					0					1						2			
			$asmallbwmap		= array($smallmap_i			, $smallmap_x			, $smallmap_y );			
			
	// Report Overlay Map is: '139_327_overlaygrid_new.gif';
	//		x: 750 pixels
	//		y: 962 pixels
			$reportoverlaymap_i = '139_327_overlaygrid_new.png';
			$reportoverlaymap_x	= 750;
			$reportoverlaymap_y = 934;		
	//	Array Element					0					1						2	
			$areportoverlaymap	= array($reportoverlaymap_i	, $reportoverlaymap_x	, $reportoverlaymap_y );
			
	// Store all in an array, again
	//									0			1				2						3
			$maparray			= array($alargemap	, $asmallmap	, $areportoverlaymap	, $asmallbwmap);
	
	// All Cordinates in the Database are stored in "Large Scale" Postions. Large Scale positions are used to export to the KML file
	//		so no adjustment is needed there; however, all reports will need to convert database "Large Scale" locations into small
	//		scale locations.
	
	// EXPORT to Google Earth (Convert Large Scale Location Numbers into Lat/Long
	//		>>>>> Need to recalculate these numbers based on newest version of the map. <<<<<<<<<<

			// Large Map
			//$map_width		= 2960;
			//$map_height		= 3897;
			//$x1				= 0;
			//$long1			= 97.17839167;
			//$x2				= $map_width;
			//$long2			= 97.13770833;
			//$delta_x			= ($long2-$long1) / ($map_width - 0);
			$delta_x			= -0.000026870833333333600000000000;
			//$y1				= 0;
			//$lat1				= 44.93083056;
			//$y2				= $map_height;
			//$lat2				= 44.89451111;
			//$delta_y			= ($lat2-$lat1) / ($map_height - 0);
			$delta_y			= -0.000019069626394951900000000000;
			//$y4				= 0;
			//$lat4				= $lat1;
			//$lat0				= ($lat1 + $y1 * $delta_y);
			$lat0				= 44.933605555555600000000000000000;
			//$long0			= ($long1 - $x1 * $delta_x);
			$long0				= 97.188052777777800000000000000000;
			$lat4				= 44.890102777777800000000000000000;
			$long4				= 97.134275000000000000000000000000;
			// How to convert from X,Y to GPS
			// GPS_Lat_x 		= (location_x * delta_x + lat0);
			// GPS_Lng_y 		= (location_y * delta_y + long0);
			
			//function convert(lat, lon){
			// var y = ((-1 * lat) + 90) * (MAP_HEIGHT / 180);
			// var x = (lon + 180) * (MAP_WIDTH / 360);
			// return {x:x,y:y};
			//							0		,	1		,	2	,	3
			$convertarray		= array($delta_x, $delta_y	, $lat0	, $long0);

	
// FUNCTIONS TO CONVERT LARGE SCALE X,Y TO GPS LAT,LONG
//
	
	function convertfromlargescale_y_to_gps_lat($location_y,$convertarray) {
			
			$tmp_x	= 0;
			
			$tmp_x 	= ($convertarray[2] + $convertarray[1] * $location_y);

			return $tmp_x;
	
	}
	
	function convertfromlargescale_x_to_gps_long($location_x,$convertarray) {
			
			$tmp_y	= 0;

			$tmp_y 	= ($convertarray[3] + $convertarray[0] * $location_x);
			
			$tmp_y 	= $tmp_y * -1;

			return $tmp_y;													
		
	}			
		
		
// FUNCTIONS TO CONVERT LARGE SCALE X,Y INTO SMALL SCALE X,Y FOR REPORTS
//

	function convertfromlargescale_to_smallscale_x($location_x,$maparray) {
		
			// $maparray[1][1] is smallmap_x
			// $maparray[0][1] is largemap x
		
			$smallscale_x = ($maparray[1][1] / $maparray[0][1]) * $location_x;
	
			return $smallscale_x;
		
		}
		
	function convertfromlargescale_to_smallscale_y($location_y,$maparray) {
	
			$smallscale_y = ($maparray[1][2] / $maparray[0][2]) * $location_y;
	
			return $smallscale_y;
		
		}
	
?>