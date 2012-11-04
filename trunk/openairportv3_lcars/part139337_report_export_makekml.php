<?php
//require('phpsqlajax_dbinfo.php');

// Load Includes
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		//include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/gs_config.php");
		
// Load Page Specific Includes
		//include("includes/_dateandtime/dateandtime.list.php");
		//include("scripts/_scripts_header_iface.inc.php");
		//include("includes/AutoEntryFunctions.php");
		//include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139337/part139337.list.php");
		//include("includes/_navigation/navigation.list.php");
		include("includes/_generalsettings/generalsettings.list.php");	
		include("includes/_dateandtime/_dt_amerdate2sqldatetime.inc.php");		

					
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
$signIconstyleNode->setAttribute('color', 'ffffffff');
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

//Get Information from the FORM

	if (!isset($_POST["frmstartdate"])) {
			// FORM END DATE IS NOT DEFINED, THIS IS PROBABLY A NETWORK KML FILE, SET DEFAULTS
			
			$current_year		= date('Y');
			$tmpstartdate 		= "01/01/2000";
			$tmpenddate 		= "12/31/".$current_year;
			//$tmpstartdate2 	= $_POST['frmstartdateo'];
			//$tmpenddate2		= $_POST['frmenddateo'];	
			
			$tmpspecies 	= 'all';
			$tmpactivity 	= 'all';
			$tmpaction		= 'all';
			
			$displayspecies_id 	= 'all';
			$displayactivity_id = 'all';
			$displayaction_id 	= 'all';
	
		} else {
			// FORM IS MOST PROBABLY FROM THE LOADER, USE USER PROVIDED SETTINGS
		
			$tmpstartdate 	= $_POST['frmstartdate'];
			$tmpenddate 	= $_POST['frmenddate'];
			$tmpstartdate2 	= $_POST['frmstartdateo'];
			$tmpenddate2	= $_POST['frmenddateo'];		
			$tmpspecies 	= $_POST['wlhmspecies'];
			$tmpactivity 	= $_POST['wlhmactivity'];
			$tmpaction		= $_POST['wlhmaction'];
			
			$displayspecies_id 	= $_POST['wlhmspecies'];
			$displayactivity_id = $_POST['wlhmactivity'];
			$displayaction_id 	= $_POST['wlhmaction'];
		
		}	
	
	// Convert start date and end date into sql format
	
		$tmpsqlstartdate	= amerdate2sqldatetime($tmpstartdate );
		$tmpsqlenddate		= amerdate2sqldatetime($tmpenddate );
		$tmpsqlstartdate2	= amerdate2sqldatetime($tmpstartdate2 );
		$tmpsqlenddate2		= amerdate2sqldatetime($tmpenddate2 );

		$notlimited_p1 = 0;
		$notlimited_p1 = 0;
		$notlimited_p1 = 0;
	
		if($_POST['disusebrowser'] == '1') {
				$use_start_date = $tmpsqlstartdate;
				$use_end_date 	= $tmpsqlenddate;
			}
			else {
				$use_start_date = $tmpsqlstartdate2;
				$use_end_date 	= $tmpsqlenddate2;			
			}		

		if($displayspecies_id == 'all') {
				// User has selected to display all animals
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_s 		= "AND 139337_species_cb_int = '".$displayspecies_id."' ";
			}
			
		if($displayactivity_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_ay 		= "AND 139337_activity_cb_int = '".$displayactivity_id."' ";
			}
			
		if($displayaction_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_an 		= "AND 139337_action_cb_int = '".$displayaction_id."' ";
			}



// Loop through the connection
// Selects all the rows in the markers table.
		$sql 		= "SELECT * FROM tbl_139_337_main 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id 			= tbl_139_337_main.139337_author_by_cb_int 
		INNER JOIN tbl_139_337_sub_an 	ON tbl_139_337_sub_an.139337_sub_an_id 		= tbl_139_337_main.139337_action_cb_int 
		INNER JOIN tbl_139_337_sub_ay 	ON tbl_139_337_sub_ay.139337_sub_ay_id 		= tbl_139_337_main.139337_activity_cb_int 
		INNER JOIN tbl_139_337_sub_s 	ON tbl_139_337_sub_s.139337_sub_s_id 		= tbl_139_337_main.139337_species_cb_int 
		WHERE 139337_date >= '".$use_start_date."' AND 139337_date <= '".$use_end_date."' ".$msql_s." ".$msql_ay." ".$msql_an." ORDER BY 139337_sub_s_category, 139337_sub_s_name";


		
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
					
					//echo "Number of Rows ".$number_of_rows." <br>";
					
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {	
					
							$displayrow					= 0;
							$displayrow_a				= 0;
							$displayrow_d				= 1;
							$locationx					= 0;
							$locationy 					= 0;
					
							// Construct FielName
							$fieldname					= $objarray['139337_numberofspecies']."x ".$objarray['139337_sub_s_name']."";
							
							$tmpdiscrepancyid			= $objarray['139337_id'];
							$tmpdiscrepancy_name		= $fieldname;
							$tmpdiscrepancycondition	= $objarray['139337_resultsofaction'];	
							
							$displayrow_a				= preflights_tbl_139_337_main_a_yn($tmpdiscrepancyid,0); // 0 will not return a row even if it is archieved.
							//$displayrow_d				= preflights_tbl_139_327_main_sub_d_d_yn($tmpdiscrepancyid,0); // 0 will not return a row even if it is duplicate.


							//echo "Display A ".$displayrow_a." / Display D ".$displayrow_d." <br>";
							
							if($displayrow_a == 0 OR $displayrow_d == 0) {
									// Do display Row
									$displayrow = 0;
								}
								else {
									$displayrow = 1;
								}
								
							if($displayrow == 1) {
									
									$i = $i + 1;
							
									$innerHTML 		= _337_display_summary($tmpdiscrepancyid,2,1);
									//echo "Display Row ".$i."<br>";
									//echo $innerHTML;
									
									// Do location Point Work									
									$locationx		= $objarray['139337_locationx'];
									$locationy 		= $objarray['139337_locationy'];
									
									//$locationx		= convertfromlargescale_to_smallscale_x($objarray['139337_locationx'],$maparray);
									//$locationy 		= convertfromlargescale_to_smallscale_y($objarray['139337_locationy'],$maparray);
									
									
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


									$styleUrl = $dom->createElement('styleUrl', 'style_papi');

										
									$placeNode->appendChild($styleUrl);

									// Creates a Point element.
									$pointNode = $dom->createElement('Point');
									$placeNode->appendChild($pointNode);

									// Creates a coordinates element and gives it the value of the lng and lat columns from the results.
									$coorStr = $record_long.','.$record_lat;
									$coorNode = $dom->createElement('coordinates', $coorStr);
									$pointNode->appendChild($coorNode);
								}
						}
				}
		}

$kmlOutput = $dom->saveXML();
header('Content-type: application/vnd.google-earth.kml+xml');
header('Content-Disposition: attachment; filename="wildlife.kml"');
echo $kmlOutput;
?>