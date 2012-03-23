<?php
//require('phpsqlajax_dbinfo.php');

// Load Includes
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		//include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/gs_config.php");
		
// Load Page Specific Includes
		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_generalsettings/_gs_gis_settings.inc.php");				
					
					
// Creates the Document.
$dom = new DOMDocument('1.0', 'UTF-8');

// Creates the root KML element and appends it to the root document.
$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
$parNode = $dom->appendChild($node);

// Creates a KML Document element and append it to the KML element.
$dnode = $dom->createElement('Document');
$docNode = $parNode->appendChild($dnode);

// Creates the two Style elements, one for restaurant and one for bar, and append the elements to the Document element.
$papiStyleNode = $dom->createElement('Style');
$papiStyleNode->setAttribute('id', 'style_papi');
$papiIconstyleNode = $dom->createElement('IconStyle');
$papiIconstyleNode->setAttribute('id', 'icon_papi');
$papiIconstyleNode->setAttribute('scale', '0.6');
$papiIconstyleNode->setAttribute('color', 'ff0000ff');
$papiIconNode = $dom->createElement('Icon');
$papiHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/square.png');
$papiIconNode->appendChild($papiHref);
$papiIconstyleNode->appendChild($papiIconNode);
$papiStyleNode->appendChild($papiIconstyleNode);
$docNode->appendChild($papiStyleNode);

$malsrStyleNode = $dom->createElement('Style');
$malsrStyleNode->setAttribute('id', 'style_malsr');
$malsrIconstyleNode = $dom->createElement('IconStyle');
$malsrIconstyleNode->setAttribute('id', 'icon_malsr');
$malsrIconstyleNode->setAttribute('scale', '0.6');
$malsrIconstyleNode->setAttribute('color', 'ffffffff');
$malsrIconNode = $dom->createElement('Icon');
$malsrHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/target.png');
$malsrIconNode->appendChild($malsrHref);
$malsrIconstyleNode->appendChild($malsrIconNode);
$malsrStyleNode->appendChild($malsrIconstyleNode);
$docNode->appendChild($malsrStyleNode);

$signStyleNode = $dom->createElement('Style');
$signStyleNode->setAttribute('id', 'style_sign');
$signIconstyleNode = $dom->createElement('IconStyle');
$signIconstyleNode->setAttribute('id', 'icon_sign');
$signIconstyleNode->setAttribute('scale', '0.6');
$signIconstyleNode->setAttribute('color', 'ff0000ff');
$signIconNode = $dom->createElement('Icon');
$signHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/triangle.png');
$signIconNode->appendChild($signHref);
$signIconstyleNode->appendChild($signIconNode);
$signStyleNode->appendChild($signIconstyleNode);
$docNode->appendChild($signStyleNode);

$twylightStyleNode = $dom->createElement('Style');
$twylightStyleNode->setAttribute('id', 'style_twylight');
$twylightIconstyleNode = $dom->createElement('IconStyle');
$twylightIconstyleNode->setAttribute('id', 'icon_twylight');
$twylightIconstyleNode->setAttribute('scale', '0.6');
$twylightIconstyleNode->setAttribute('color', 'ffff0000');
$twylightIconNode = $dom->createElement('Icon');
$twylightHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/placemark_circle.png');
$twylightIconNode->appendChild($twylightHref);
$twylightIconstyleNode->appendChild($twylightIconNode);
$twylightStyleNode->appendChild($twylightIconstyleNode);
$docNode->appendChild($twylightStyleNode);

$rwylightStyleNode = $dom->createElement('Style');
$rwylightStyleNode->setAttribute('id', 'style_rwylight');
$rwylightIconstyleNode = $dom->createElement('IconStyle');
$rwylightIconstyleNode->setAttribute('id', 'icon_rwylight');
$rwylightIconstyleNode->setAttribute('scale', '0.6');
$rwylightIconstyleNode->setAttribute('color', 'ffffffff');
$rwylightIconNode = $dom->createElement('Icon');
$rwylightHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/shaded_dot.png');
$rwylightIconNode->appendChild($rwylightHref);
$rwylightIconstyleNode->appendChild($rwylightIconNode);
$rwylightStyleNode->appendChild($rwylightIconstyleNode);
$docNode->appendChild($rwylightStyleNode);

$reilStyleNode = $dom->createElement('Style');
$reilStyleNode->setAttribute('id', 'style_reil');
$reilIconstyleNode = $dom->createElement('IconStyle');
$reilIconstyleNode->setAttribute('id', 'icon_reil');
$reilIconstyleNode->setAttribute('scale', '0.6');
$reilIconstyleNode->setAttribute('color', 'ff0000ff');
$reilIconNode = $dom->createElement('Icon');
$reilHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/donut.png');
$reilIconNode->appendChild($reilHref);
$reilIconstyleNode->appendChild($reilIconNode);
$reilStyleNode->appendChild($reilIconstyleNode);
$docNode->appendChild($reilStyleNode);

$clStyleNode = $dom->createElement('Style');
$clStyleNode->setAttribute('id', 'style_cl');
$clIconstyleNode = $dom->createElement('IconStyle');
$clIconstyleNode->setAttribute('id', 'icon_cl');
$clIconstyleNode->setAttribute('scale', '0.6');
$clIconstyleNode->setAttribute('color', 'ff0000ff');
$clIconNode = $dom->createElement('Icon');
$clHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/polygon.png');
$clIconNode->appendChild($clHref);
$clIconstyleNode->appendChild($clIconNode);
$clStyleNode->appendChild($clIconstyleNode);
$docNode->appendChild($clStyleNode);

$gpsStyleNode = $dom->createElement('Style');
$gpsStyleNode->setAttribute('id', 'style_gps');
$gpsIconstyleNode = $dom->createElement('IconStyle');
$gpsIconstyleNode->setAttribute('id', 'icon_gps');
$gpsIconstyleNode->setAttribute('scale', '0.6');
$gpsIconstyleNode->setAttribute('color', 'ff0000ff');
$gpsIconNode = $dom->createElement('Icon');
$gpsHref = $dom->createElement('href', 'http://maps.google.com/mapfiles/kml/shapes/cross-hairs.png');
$gpsIconNode->appendChild($gpsHref);
$gpsIconstyleNode->appendChild($gpsIconNode);
$gpsStyleNode->appendChild($gpsIconstyleNode);
$docNode->appendChild($gpsStyleNode);

// Loop through the connection
// Selects all the rows in the markers table.
		$sql 		= "SELECT * FROM tbl_139_339_sub_d 
		INNER JOIN tbl_systemusers 			ON tbl_systemusers.emp_record_id 		= tbl_139_339_sub_d.Discrepancy_by_cb_int 
		INNER JOIN tbl_139_339_main 		ON tbl_139_339_main.139339_main_id 		= tbl_139_339_sub_d.Discrepancy_inspection_id 
		INNER JOIN tbl_139_339_sub_c_c		ON tbl_139_339_sub_c_c.139339_cc_ficon_cb_int = tbl_139_339_main.139339_main_id 
		INNER JOIN tbl_139_339_sub_c 		ON tbl_139_339_sub_c.139339_c_id 		= tbl_139_339_sub_c_c.139339_cc_c_cb_int 
		INNER JOIN tbl_139_339_sub_c_f 		ON tbl_139_339_sub_c_f.139339_f_id 		= tbl_139_339_sub_c.139339_c_facility_cb_int  
		
		
		
		INNER JOIN tbl_139_339_sub_t 		ON tbl_139_339_sub_t.139339_type_id		= tbl_139_339_main.139339_type_cb_int 
		INNER JOIN tbl_general_conditions 	ON tbl_general_conditions.general_condition_id = tbl_139_339_sub_d.discrepancy_priority 
		
		ORDER BY 139339_main_id ";
		
		
		// Opens a connection to a MySQLi server.
	$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs = mysqli_query($mysqli, $sql);
						
			if ($objrs) {
					$number_of_rows = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	
					
							
					
							$displayrow					= 0;
							$displayrow_a				= 0;
							$displayrow_d				= 0;
							$locationx					= 0;
							$locationy 					= 0;
					
							$tmpdiscrepancyid			= $objarray['Discrepancy_id'];
							$tmpdiscrepancy_name		= $objarray['Discrepancy_name'];
							$tmpdiscrepancycondition	= $objarray['discrepancy_checklist_id'];	
							
							if($previous_id == $tmpdiscrepancyid) {
								
									// Same Discrepancy Skip it
							}
							else {
							
							
							//$displayrow_a				= preflights_tbl_139_327_main_sub_d_a_yn($tmpdiscrepancyid,0); // 0 will not return a row even if it is archieved.
							//$displayrow_d				= preflights_tbl_139_327_main_sub_d_d_yn($tmpdiscrepancyid,0); // 0 will not return a row even if it is duplicate.


							//echo "Display A ".$displayrow_a." / Display D ".$displayrow_d." <br>";
							
							
									$innerHTML 		= display_anomaly_summary($tmpdiscrepancyid,2,1);
									//echo $innerHTML;
									
									// Do location Point Work									
									$locationx		= $objarray['Discrepancy_location_x'];
									$locationy 		= $objarray['Discrepancy_location_y'];
									
									//$locationx		= convertfromlargescale_to_smallscale_x($objarray['Discrepancy_location_x'],$maparray);
									//$locationy 		= convertfromlargescale_to_smallscale_y($objarray['Discrepancy_location_y'],$maparray);
													
									
									//echo "Location X ".$locationx."<br>";
									//echo "Location Y ".$locationy."<br>";
									//$locationx		= settype($locationx,'int');
									//$locationy		= settype($locationy,'int');
									
									$record_long 	= ($long0 + $delta_x * $locationx);
									$record_long 	= $record_long * -1;
									$record_lat 	= ($lat0 + $delta_y * $locationy);
									//=(C109+C100*F96)*-1
									//echo $record_long."<br>";
									//echo $record_lat."<br>";

									// Creates a Placemark and append it to the Document.

									$node = $dom->createElement('Placemark');
									$placeNode = $docNode->appendChild($node);

									// Creates an id attribute and assign it the value of id column.
									$placeNode->setAttribute('id', 'placemark' . $tmpdiscrepancyid);

									// Create name, and description elements and assigns them the values of the name and address columns from the results.
									$nameNode = $dom->createElement('name',htmlentities($tmpdiscrepancy_name));
									$placeNode->appendChild($nameNode);

									$loadHTML_description = $innerHTML;

									$descNode = $dom->createElement('description', $loadHTML_description);
									$placeNode->appendChild($descNode);


									$styleUrl = $dom->createElement('styleUrl', 'style_sign');

										
									$placeNode->appendChild($styleUrl);

									// Creates a Point element.
									$pointNode = $dom->createElement('Point');
									$placeNode->appendChild($pointNode);

									// Creates a coordinates element and gives it the value of the lng and lat columns from the results.
									$coorStr = $record_long.','.$record_lat;
									$coorNode = $dom->createElement('coordinates', $coorStr);
									$pointNode->appendChild($coorNode);
									
							}
									$previous_id = $tmpdiscrepancyid;
								}
						}
				}
		

$kmlOutput = $dom->saveXML();
header('Content-type: application/vnd.google-earth.kml+xml');
header('Content-Disposition: attachment; filename="SurfaceAnomaly.kml"');
echo $kmlOutput;
?>