<?php
//require('phpsqlajax_dbinfo.php');

// Load Includes
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		//include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/gs_config.php");
		
// Load Page Specific Includes
		include("includes/_modules/part139327/part139327.list.php");
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

	//				Field Name			Field Text Name				Field Comment						Field Notes												Field Format		Field Type	Field Width		Field Height	Default Value			Field Function		
	//form_new_control("frmstartdate"		,"Date"						, "Enter the the date to start from"		,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				,"current"				,0);
	//form_new_control("frmenddate"		,"Date"						, "Enter the the date to end at"			,"The current date has automatically been provided!"	,"(mm/dd/yyyy)"		,1			,10				,0				,"current"				,0);
	//form_new_control("disinspectiontype","Inspection Type"			, "Select an Inspection Type"				,"Select an inspection type from the list provided!"	,""					,3			,50				,0				,"all"					,"part139327typescomboboxwall");
	//form_new_control("disonlycurrent"	,"Only Outstanding Status"	, "Display only outstanding discrepancies"	,"Checking this box will display only outstanding discrepancies. Unchecking the box will display all discrepancies."		,""					,5			,50				,0				,"all"					,0);
	//form_new_control("disusebrowser"	,"Use Above Settings"		, "Use Broser Settings or override"			,"Checking this box will use the dates above, unchecked will use the dates from the browser form"		,""					,5			,50				,0				,"all"					,0);

	if (!isset($_POST["frmstartdate"])) {
			// FORM END DATE IS NOT DEFINED, THIS IS PROBABLY A NETWORK KML FILE, SET DEFAULTS
			
			$current_year	= date('Y');
			$tmpstartdate 	= "01/01/2000";
			$tmpenddate 	= "12/31/".$current_year;
			//$tmpstartdate2 	= $_POST['frmstartdateo'];
			//$tmpenddate2	= $_POST['frmenddateo'];	

			$disinspectiontype	= 'all';
			$disonlycurrent		= 1;	
			$disusebrowser		= 1;			
	
		} else {
			// FORM IS MOST PROBABLY FROM THE LOADER, USE USER PROVIDED SETTINGS
		
			$tmpstartdate 	= $_POST['frmstartdate'];
			$tmpenddate 	= $_POST['frmenddate'];
			$tmpstartdate2 	= $_POST['frmstartdateo'];
			$tmpenddate2	= $_POST['frmenddateo'];

			$disinspectiontype	= $_POST['disinspectiontype']; 	// Check box
			$disonlycurrent		= $_POST['disonlycurrent']; 	// Check box	
			$disusebrowser		= $_POST['disusebrowser']; 		// Check box	
		
		}

	// Convert start date and end date into sql format
	
		$tmpsqlstartdate	= amerdate2sqldatetime($tmpstartdate );
		$tmpsqlenddate		= amerdate2sqldatetime($tmpenddate );
		$tmpsqlstartdate2	= amerdate2sqldatetime($tmpstartdate2 );
		$tmpsqlenddate2		= amerdate2sqldatetime($tmpenddate2 );	

		$sql_a = "";
		
		
	// DO WE ONLY WANT THE CURRENT STATUS OR SOME OTHER CREATION?
		if($disinspectiontype == 'all') {
				// USER HAS SELECTED ALL TIME PERIODS
				//	add nothing to the SQL statement
				//echo "Nothing to add to the SQL Statement <br>";
			} else {
				// USER HAS SELECTED A TIME PERIOD, 
				//	add specific data to sql statement
				//echo "Adding to the SQL Statement <br>";
				$sql_a = "AND tbl_139_327_main.type_of_inspection_cb_int = '".$disinspectiontype."' ";
			}	
			
		if($disusebrowser == 1) {
				$usebrowser		= 0;
				$date_to_use_s	= $tmpsqlstartdate;
				$date_to_use_e	= $tmpsqlenddate;
			}
			else {
				$usebrowser		= 1;
				$date_to_use_s	= $tmpsqlstartdate2;
				$date_to_use_e	= $tmpsqlenddate2;
			}	


			$sql_b = "AND tbl_139_327_main.139327_date >= '".$date_to_use_s."' AND tbl_139_327_main.139327_date <= '".$date_to_use_e."' ";
		
// Loop through the connection
// Selects all the rows in the markers table.
	$sql = "SELECT * FROM tbl_139_327_sub_d 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d.Discrepancy_by_cb_int 
		INNER JOIN tbl_139_327_main 	ON tbl_139_327_main.inspection_system_id = tbl_139_327_sub_d.Discrepancy_inspection_id 
		INNER JOIN tbl_139_327_sub_t 	ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int 
		INNER JOIN tbl_139_327_sub_c 	ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_d.discrepancy_checklist_id 
		INNER JOIN tbl_139_327_sub_c_f 	ON tbl_139_327_sub_c_f.facility_id = tbl_139_327_sub_c.condition_facility_cb_int 
		INNER JOIN tbl_general_conditions ON tbl_general_conditions.general_condition_id = tbl_139_327_sub_d.discrepancy_priority ";
		$sql = $sql."".$sql_a."".$sql_b."";
		
		
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
							
							$displayrow_a				= preflights_tbl_139_327_main_sub_d_a_yn($tmpdiscrepancyid,0); // 0 will not return a row even if it is archieved.
							$displayrow_d				= preflights_tbl_139_327_main_sub_d_d_yn($tmpdiscrepancyid,0); // 0 will not return a row even if it is duplicate.
							$status						= part139327discrepancy_getstage($tmpdiscrepancyid,0, 0,0,0);
							
							$current = 'burp';
							
							if($disonlycurrent == 1) {
									
									// Display only current Discrepancies
									if($status <> 3) {
											$current = 1;
										} else {
											$current = 0;
										}
								} else {
									$current = 1;
								}
							
							//echo "Display A ".$displayrow_a." / Display D ".$displayrow_d." <br>";
							
							if($displayrow_a == 0 OR $displayrow_d == 0) {
									// Do display Row
									$displayrow = 0;
								}
								else {
									if($current == 1 ) {
										$displayrow = 1;
									} else {
										$displayrow = 0;
									}
								}
								
							if($displayrow == 1) {

									$innerHTML 		= display_discrepancy_summary($tmpdiscrepancyid,2,1);
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
						}
				}
		}

$kmlOutput = $dom->saveXML();
header('Content-type: application/vnd.google-earth.kml+xml');
header('Content-Disposition: attachment; filename="discrepancies.kml"');
echo $kmlOutput;
?>