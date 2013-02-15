<?php
//require('phpsqlajax_dbinfo.php');

// Load Includes
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		//include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/gs_config.php");
		
// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_generalsettings/generalsettings.list.php");	
		include("includes/_dateandtime/_dt_amerdate2sqldatetime.inc.php");		
					
		$scale = 5;	

// get information from the loading form...
	//Get Information from the FORM
		
		// THIS PAGE CAN BE ACCESSED AS A NETWORK LINK KML FILE.
		//		IT WILL NEED CERTAIN VALUES SET TO DEFAULTS IF NO INFORMATION IS PROVIDED
		//		SHOULD BE APPLICABLE TO WHAT YOU WOULD EXPECT FROM A NETWORK KML FILE
		
		// TEST TO SEE IF THIS IS FROM THE LOADER OR A NETWORK LINK....
		if (!isset($_POST["$tmpenddate"])) {
				// FORM END DATE IS NOT DEFINED, THIS IS PROBABLY A NETWORK KML FILE, SET DEFAULTS
				
				$current_year	= date('Y');
				$tmpstartdate 	= "01/01/2000";
				$tmpenddate 	= "12/31/".$current_year;
				//$tmpstartdate2 	= $_POST['frmstartdateo'];
				//$tmpenddate2	= $_POST['frmenddateo'];	

				$timeperiod		= "all";
				$ficonid		= "";
				$averagemus		= 1;
				$use40andup		= 1;		
				$usenullmu		= 0;	
				$ussettings		= 1;			
		
		}
		else {
				// FORM IS MOST PROBABLY FROM THE LOADER, USE USER PROVIDED SETTINGS
		
				$tmpstartdate 	= $_POST['frmstartdate'];
				$tmpenddate 	= $_POST['frmenddate'];
				$tmpstartdate2 	= $_POST['frmstartdateo'];
				$tmpenddate2	= $_POST['frmenddateo'];	

				$timeperiod		= $_POST['discondition'];		// Combobox
				$ficonid		= $_POST['disfacility'];		// Input Box
				$averagemus		= $_POST['disusedates']; 		// Check box
				$use40andup		= $_POST['disuse40']; 			// Check box		
				$usenullmu		= $_POST['disuseblank']; 		// Check box	
				$ussettings		= $_POST['disusebrowser']; 		// Check box	
		
		}
		
		$running_total 	= 0;
		$i				= 0;
		$previous_c_id	= 0;					// Is the current condition the same as the last one?
		$interal_loop	= 0;
		$external_loop	= -1;

		$muarray		= array();
		$muarray_s		= array();
		$muarray_d		= array();
		$isrunway		= array();
			
		
	// Convert start date and end date into sql format
	
		//$tmpsqlstartdate	= amerdate2sqldatetime($tmpstartdate );
		//$tmpsqlenddate		= amerdate2sqldatetime($tmpenddate );
		//$tmpsqlstartdate2	= amerdate2sqldatetime($tmpstartdate2 );
		//$tmpsqlenddate2		= amerdate2sqldatetime($tmpenddate2 );
		
		$tmpsqlstartdate	= ($tmpstartdate );
		$tmpsqlenddate		= ($tmpenddate );
		$tmpsqlstartdate2	= ($tmpstartdate2 );
		$tmpsqlenddate2		= ($tmpenddate2 );		

	// Determine which Date Grouping we are using
		
		$tmptime = date('H:m:s');
		$tmpdate = date('Y/m/d');
		
		
		//echo "Average Mu Setting is [".$averagemus."]";
		
		if($averagemus == '1') {
				$averagemus		= 1;
			}
			else {
				$averagemus		= 0;			
			}
			
		//echo "Average Mu Setting is [".$averagemus."]";	
			
		if($use40andup == '1') {
				$use40andup		= 1;
			}
			else {
				$use40andup		= 0;			
			}
		if($usenullmu == '1') {
				$usenullmu		= 1;
			}
			else {
				$usenullmu		= 0;			
			}			
		if($ussettings == '1') {
				$use_start_date = $tmpsqlstartdate;
				$use_end_date 	= $tmpsqlenddate;
			}
			else {
				$use_start_date = $tmpsqlstartdate2;
				$use_end_date 	= $tmpsqlenddate2;			
			}		

			
// Creates the Document.
$dom	= new DOMDocument('1.0', 'UTF-8');
$nKml	= $dom->appendChild($dom->createElementNS('http://earth.google.com/kml/2.1', 'kml'));
$nDoc	= $nKml->appendChild($dom->createElement('Document'));

// 0 to 20
//	HTML:	"#4F0000";
//	GE:		'ff00004f';
// 21 to 25
//	HTML:	#D80000";
//	GE:		'ff0000d8';
// 26 to 29
//	HTML:	"#FF5916";
//	GE:		'ff1659ff';
// 30 to 35
//	HTML:	"#FFCE34";
//	GE:		'ff34ceff';
// 36 to 39
//	HTML:	"#B8DC2E";
//	GE:		'ff2edcb8';
// 40 and Up
//	HTML:	"#399C0E";
//	GE:		'ff0e9c39';

$idSuffix='_Mu20';

//Style
$nStyle      = $nDoc->appendChild($dom->createElement('Style'));
$nStyle->setAttribute('id', 'style'.$idSuffix);

  //IconStyle
  $nIconStyle      = $nStyle->appendChild($dom->createElement('IconStyle'));
  $nIconStyle->setAttribute('id', 'icon'.$idSuffix);
    //color
    $nIconStyleColor=$nIconStyle->appendChild($dom->createElement('color'));
    $nIconStyleColor->appendChild($dom->createTextNode('ff0000ff'));
    //Icon
    $nIconStyleIcon=$nIconStyle->appendChild($dom->createElement('Icon'));
      //href
      $nIconStyleHref=$nIconStyleIcon->appendChild($dom->createElement('href'));
      $nIconStyleHref->appendChild($dom->createTextNode('http://maps.google.com/../cross-hairs.png'));

  //PolyStyle
  $nPolyStyle      = $nStyle->appendChild($dom->createElement('PolyStyle'));
  $nPolyStyle->setAttribute('id', 'poly'.$idSuffix);
    //color
    $nPolyStyleColor=$nPolyStyle->appendChild($dom->createElement('color'));
    $nPolyStyleColor->appendChild($dom->createTextNode('ff00004f'));

  //LineStyle
  $nLineStyle      = $nStyle->appendChild($dom->createElement('LineStyle'));
  $nLineStyle->setAttribute('id', 'line'.$idSuffix);
    //width
    $nLineStyleWidth=$nLineStyle->appendChild($dom->createElement('width'));
    $nLineStyleWidth->appendChild($dom->createTextNode('2'));
    $nLineStyleColor=$nLineStyle->appendChild($dom->createElement('color'));
    $nLineStyleColor->appendChild($dom->createTextNode('ff000000'));
	
$idSuffix='_Mu25';

//Style
$nStyle      = $nDoc->appendChild($dom->createElement('Style'));
$nStyle->setAttribute('id', 'style'.$idSuffix);

  //IconStyle
  $nIconStyle      = $nStyle->appendChild($dom->createElement('IconStyle'));
  $nIconStyle->setAttribute('id', 'icon'.$idSuffix);
    //color
    $nIconStyleColor=$nIconStyle->appendChild($dom->createElement('color'));
    $nIconStyleColor->appendChild($dom->createTextNode('ff0000ff'));
    //Icon
    $nIconStyleIcon=$nIconStyle->appendChild($dom->createElement('Icon'));
      //href
      $nIconStyleHref=$nIconStyleIcon->appendChild($dom->createElement('href'));
      $nIconStyleHref->appendChild($dom->createTextNode('http://maps.google.com/../cross-hairs.png'));

  //PolyStyle
  $nPolyStyle      = $nStyle->appendChild($dom->createElement('PolyStyle'));
  $nPolyStyle->setAttribute('id', 'poly'.$idSuffix);
    //color
    $nPolyStyleColor=$nPolyStyle->appendChild($dom->createElement('color'));
    $nPolyStyleColor->appendChild($dom->createTextNode('ff0000d8'));

  //LineStyle
  $nLineStyle      = $nStyle->appendChild($dom->createElement('LineStyle'));
  $nLineStyle->setAttribute('id', 'line'.$idSuffix);
    //width
    $nLineStyleWidth=$nLineStyle->appendChild($dom->createElement('width'));
    $nLineStyleWidth->appendChild($dom->createTextNode('2'));
    $nLineStyleColor=$nLineStyle->appendChild($dom->createElement('color'));
    $nLineStyleColor->appendChild($dom->createTextNode('ff000000'));			

$idSuffix='_Mu29';

//Style
$nStyle      = $nDoc->appendChild($dom->createElement('Style'));
$nStyle->setAttribute('id', 'style'.$idSuffix);

  //IconStyle
  $nIconStyle      = $nStyle->appendChild($dom->createElement('IconStyle'));
  $nIconStyle->setAttribute('id', 'icon'.$idSuffix);
    //color
    $nIconStyleColor=$nIconStyle->appendChild($dom->createElement('color'));
    $nIconStyleColor->appendChild($dom->createTextNode('ff0000ff'));
    //Icon
    $nIconStyleIcon=$nIconStyle->appendChild($dom->createElement('Icon'));
      //href
      $nIconStyleHref=$nIconStyleIcon->appendChild($dom->createElement('href'));
      $nIconStyleHref->appendChild($dom->createTextNode('http://maps.google.com/../cross-hairs.png'));

  //PolyStyle
  $nPolyStyle      = $nStyle->appendChild($dom->createElement('PolyStyle'));
  $nPolyStyle->setAttribute('id', 'poly'.$idSuffix);
    //color
    $nPolyStyleColor=$nPolyStyle->appendChild($dom->createElement('color'));
    $nPolyStyleColor->appendChild($dom->createTextNode('ff1659ff'));

  //LineStyle
  $nLineStyle      = $nStyle->appendChild($dom->createElement('LineStyle'));
  $nLineStyle->setAttribute('id', 'line'.$idSuffix);
    //width
    $nLineStyleWidth=$nLineStyle->appendChild($dom->createElement('width'));
    $nLineStyleWidth->appendChild($dom->createTextNode('2'));
    $nLineStyleColor=$nLineStyle->appendChild($dom->createElement('color'));
    $nLineStyleColor->appendChild($dom->createTextNode('ff000000'));	

$idSuffix='_Mu35';

//Style
$nStyle      = $nDoc->appendChild($dom->createElement('Style'));
$nStyle->setAttribute('id', 'style'.$idSuffix);

  //IconStyle
  $nIconStyle      = $nStyle->appendChild($dom->createElement('IconStyle'));
  $nIconStyle->setAttribute('id', 'icon'.$idSuffix);
    //color
    $nIconStyleColor=$nIconStyle->appendChild($dom->createElement('color'));
    $nIconStyleColor->appendChild($dom->createTextNode('ff0000ff'));
    //Icon
    $nIconStyleIcon=$nIconStyle->appendChild($dom->createElement('Icon'));
      //href
      $nIconStyleHref=$nIconStyleIcon->appendChild($dom->createElement('href'));
      $nIconStyleHref->appendChild($dom->createTextNode('http://maps.google.com/../cross-hairs.png'));

  //PolyStyle
  $nPolyStyle      = $nStyle->appendChild($dom->createElement('PolyStyle'));
  $nPolyStyle->setAttribute('id', 'poly'.$idSuffix);
    //color
    $nPolyStyleColor=$nPolyStyle->appendChild($dom->createElement('color'));
    $nPolyStyleColor->appendChild($dom->createTextNode('ff34ceff'));

  //LineStyle
  $nLineStyle      = $nStyle->appendChild($dom->createElement('LineStyle'));
  $nLineStyle->setAttribute('id', 'line'.$idSuffix);
    //width
    $nLineStyleWidth=$nLineStyle->appendChild($dom->createElement('width'));
    $nLineStyleWidth->appendChild($dom->createTextNode('2'));
    $nLineStyleColor=$nLineStyle->appendChild($dom->createElement('color'));
    $nLineStyleColor->appendChild($dom->createTextNode('ff000000'));	
	
$idSuffix='_Mu39';

//Style
$nStyle      = $nDoc->appendChild($dom->createElement('Style'));
$nStyle->setAttribute('id', 'style'.$idSuffix);

  //IconStyle
  $nIconStyle      = $nStyle->appendChild($dom->createElement('IconStyle'));
  $nIconStyle->setAttribute('id', 'icon'.$idSuffix);
    //color
    $nIconStyleColor=$nIconStyle->appendChild($dom->createElement('color'));
    $nIconStyleColor->appendChild($dom->createTextNode('ff0000ff'));
    //Icon
    $nIconStyleIcon=$nIconStyle->appendChild($dom->createElement('Icon'));
      //href
      $nIconStyleHref=$nIconStyleIcon->appendChild($dom->createElement('href'));
      $nIconStyleHref->appendChild($dom->createTextNode('http://maps.google.com/../cross-hairs.png'));

  //PolyStyle
  $nPolyStyle      = $nStyle->appendChild($dom->createElement('PolyStyle'));
  $nPolyStyle->setAttribute('id', 'poly'.$idSuffix);
    //color
    $nPolyStyleColor=$nPolyStyle->appendChild($dom->createElement('color'));
    $nPolyStyleColor->appendChild($dom->createTextNode('ff2edcb8'));

  //LineStyle
  $nLineStyle      = $nStyle->appendChild($dom->createElement('LineStyle'));
  $nLineStyle->setAttribute('id', 'line'.$idSuffix);
    //width
    $nLineStyleWidth=$nLineStyle->appendChild($dom->createElement('width'));
    $nLineStyleWidth->appendChild($dom->createTextNode('2'));
    $nLineStyleColor=$nLineStyle->appendChild($dom->createElement('color'));
    $nLineStyleColor->appendChild($dom->createTextNode('ff000000'));		
	
	
$idSuffix='_Mu40';

//Style
$nStyle      = $nDoc->appendChild($dom->createElement('Style'));
$nStyle->setAttribute('id', 'style'.$idSuffix);

  //IconStyle
  $nIconStyle      = $nStyle->appendChild($dom->createElement('IconStyle'));
  $nIconStyle->setAttribute('id', 'icon'.$idSuffix);
    //color
    $nIconStyleColor=$nIconStyle->appendChild($dom->createElement('color'));
    $nIconStyleColor->appendChild($dom->createTextNode('ff0000ff'));
    //Icon
    $nIconStyleIcon=$nIconStyle->appendChild($dom->createElement('Icon'));
      //href
      $nIconStyleHref=$nIconStyleIcon->appendChild($dom->createElement('href'));
      $nIconStyleHref->appendChild($dom->createTextNode('http://maps.google.com/../cross-hairs.png'));

  //PolyStyle
  $nPolyStyle      = $nStyle->appendChild($dom->createElement('PolyStyle'));
  $nPolyStyle->setAttribute('id', 'poly'.$idSuffix);
    //color
    $nPolyStyleColor=$nPolyStyle->appendChild($dom->createElement('color'));
    $nPolyStyleColor->appendChild($dom->createTextNode('ff0e9c39'));

  //LineStyle
  $nLineStyle      = $nStyle->appendChild($dom->createElement('LineStyle'));
  $nLineStyle->setAttribute('id', 'line'.$idSuffix);
    //width
    $nLineStyleWidth=$nLineStyle->appendChild($dom->createElement('width'));
    $nLineStyleWidth->appendChild($dom->createTextNode('2'));
    $nLineStyleColor=$nLineStyle->appendChild($dom->createElement('color'));
    $nLineStyleColor->appendChild($dom->createTextNode('ff000000'));	

	
		if($timeperiod == 'all') {
				// User has selected to display all animals
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_s 		= "AND tbl_139_339_sub_t.139339_type_id = '".$timeperiod."' ";
			}	
	
		if($ficonid == '') {
				// USer has not provided a specific FiCON to load information from, so we use the dates given
				//	as the control 
				$msql_d 		= "AND tbl_139_339_main.139339_date >= '".$use_start_date."' AND tbl_139_339_main.139339_date <= '".$use_end_date ."' ";
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_d			= "AND tbl_139_339_main.139339_main_id = '".$ficonid."' ";
			}			
	
	// Define SQL
	$sql = "SELECT * FROM tbl_139_339_sub_c_c 
			INNER JOIN tbl_139_339_sub_c ON 139339_cc_c_cb_int = 139339_c_id 
			INNER JOIN tbl_139_339_sub_c_f ON 139339_f_id = 139339_c_facility_cb_int 
			INNER JOIN tbl_139_339_main		ON tbl_139_339_main.139339_main_id = tbl_139_339_sub_c_c.139339_cc_ficon_cb_int
			WHERE 139339_cc_type = 0 ".$msql_s." ".$msql_d." 
			ORDER BY 139339_c_id ";
							
	//echo $sql;
	// Establish a Conneciton with the Database
	
	$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			//printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($objcon, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);

					while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
																										
							$tmpid 					= $objfields['139339_c_id'];
							$current_facility 		= $objfields['139339_c_facility_cb_int'];
							$current_facility_rwy	= $objfields['139339_f_rwy_yn'];
							$tmpcondname			= $objfields['139339_c_name'];
							$tmp_xlox				= $objfields['139339_cc_xloc'];
							
							$facility_id			= $objfields['139339_f_id'];				// The ID of the facility row
							$facility_name			= $objfields['139339_f_name'];				// The Name of this facility. Typically english readable
							$facility_is_runway		= $objfields['139339_f_rwy_yn'];			// Toggle for dynamic control. 0: Nothing special, 1: Is a runway, 2: is a holder for runway orintation, 3: Checkbox not applicable to a surface
							
							$condition_id			= $objfields['139339_c_id'];				// The ID of the condition row
							$condition_name			= $objfields['139339_c_name'];				// The Programming name of this condition.  Typically not something readable
							$condition_type			= $objfields['139339_c_type_cb_int'];		// The type of FiCON this condition is part of.  Timeline....
							$condition_field_type	= $objfields['139339_cc_type'];				// Describes the type of input box this is:  0:Mu Value, 1: checkbox, 2: text
							$condition_xlocation	= $objfields['139339_cc_xloc'];				// Describes the order to sort this condition

							$condition_location_x	= $objfields['139339_cc_location_x'];
							$condition_location_y	= $objfields['139339_cc_location_y'];
							
							$checklist_item_id		= $objfields['139339_cc_id'];				// ID of the checklist item
							$checklist_item_disc	= $objfields['139339_cc_d_yn'];				// Value of the discrepancy (could be Mu value, a surface description, or a checkbox toggle).
													
							//$main_id				= $objfields['139339_main_id'];
							//$main_time			= $objfields['139339_time'];
							//$main_date			= $objfields['139339_date'];
													
													
							$tmpcondnamestr			= str_replace(" ","",$tmpcondname);
							
							//echo "FiCON id is [".$ficonid."] <br>";
							
							if($ficonid == '') {
									//echo "FiCON id currently is null <br>";
									
									//echo "Previous ID: ".$previous_id.", Current ID: ".$condition_id."<br>";
									
									if($previous_id != $condition_id) {
											//ECHO "<br> [Previous ID NOT EQUAL to Current ID] <br>";
											//echo "Facility: ".$facility_name.", Surface: ".$condition_name."<br> ";
											
											// Add array values to KML file
											// Reset array values
											if($has_run == 1) {
													// Program has run once, do averages and things now
													$number_of_records 	= count($muarray);
													$average_mu			= ($muarray_t[0] / $number_of_records);
													
													$xlocations		= explode(",",$muarray_loc[0][0]);
													$ylocations		= explode(",",$muarray_loc[0][1]);
													$size_of_array 	= count($xlocations);	
													

													if($size_of_array == 1) {
															// Draw Single Point Item
														}
														else {
															// CONVERT Large X,Y into small X,Y....
															for ($k=0; $k<count($xlocations); $k=$k+1) {
																	// Loop through array and replace values as they comeup
																	//echo "X Locations: ".$xlocations[$k]." <br>";
																	
																	$locationx		= $xlocations[$k];
																	$locationy 		= $ylocations[$k];
																	
																	$locationx		= convertfromlargescale_x_to_gps_long($locationx,$convertarray);
																	$locationy 		= convertfromlargescale_y_to_gps_lat($locationy,$convertarray);
																				
																	
																	$record_long	= $locationx;
																	$record_lat		= $locationy;
																	
																	if($k == 0) {
																			$first_y = $record_long;
																			$first_x = $record_lat;
																	}
																	
																	if($averagemus == 1) {
																			$tmp_value_d = round($average_mu,2);
																			$tmp_value_l = round($average_mu,0) * $scale;
																			//echo "Doing averages, average is: ".$tmp_value." <br>";
																	}
																	else {
																			$tmp_value_d = round($average_mu,2);
																			$tmp_value_l = round($muarray_t[0],0);
																	}
																	
																	$locationstring = $locationstring."".$record_long.",".$record_lat .",".$tmp_value_l." ";
																}	
														}	
													
													$average_text		= 	"Total Records: ".$number_of_records." <br>";
													$average_text		=	$average_text."Average:		".$tmp_value_d." <br>";
													$average_text		=	$average_text."Total:		".$muarray_t[0]." <br>";
													
													$name				= "Name: Facility: ".$muarray_f[0].", Surface: ".$muarray_c[0]."";
													$description 		= "Description: <br>Facility: ".$muarray_f[0].", Surface: ".$muarray_c[0]." <br>".$average_text." ";
									
													
													$locationstring = $locationstring.",".$first_y.",".$first_x.",".$tmp_value_l." ";
													
													$value_of_mu = $average_mu;
													
													if($value_of_mu >= 0 AND $value_of_mu <=20 ) {
															$linecolor = "_Mu20";
													}
													if($value_of_mu >= 21 AND $value_of_mu <= 25 ) {
															$linecolor = "_Mu25";
													}
													if($value_of_mu >= 26 AND $value_of_mu <= 29 ) {
															$linecolor = "_Mu29";
													}				
													if($value_of_mu >= 30 AND $value_of_mu <= 35 ) {
															$linecolor = "_Mu35";
													}
													if($value_of_mu >= 36 AND $value_of_mu <= 39 ) {
															$linecolor = "_Mu39";
													}			
													if($value_of_mu >= 40 ) {
															$linecolor = "_Mu40";
													}	

													$styleselect = "style".$linecolor;
												
												
		$placeobject = $dom->createElement('Placemark');
		$placeNode = $nDoc->appendChild($placeobject);			
		$placeobject->setAttribute('id',$muarray_f[0]."_".$muarray_c[0]);

		$placename = $dom->createElement('name',$name);
		$placeNode->appendChild($placename);				

		$placedesc = $dom->createElement('description', $description);
		$placeNode->appendChild($placedesc);

		$stylenode =$dom->createElement('styleUrl',$styleselect);
		$placeNode->appendChild($stylenode);

		$linenode = $dom->createElement('Polygon');
		$placeNode->appendChild($linenode);

		$lineextrude = $dom->createElement('extrude', '1');
		$linenode->appendChild($lineextrude);

		$linealtitude = $dom->createElement('altitudeMode', 'relativeToGround');
		$linenode->appendChild($linealtitude);					

		$outerboundnode = $dom->createElement('outerBoundaryIs');
		$linenode = $linenode->appendChild($outerboundnode);

		$ringtype =$dom->createElement('LinearRing');
		$linenode = $linenode->appendChild($ringtype);

		$coordnode = $dom->createElement('coordinates',$locationstring);
		$ringtype->appendChild($coordnode);													
												
												
												
												
												
											
													//echo "<br> There are: ".$number_of_records." records in the array";
													//echo "Total of all Mu values is: ".$muarray_t[0]." <br>";
													//echo "Average Mu is: ".$average_mu." <br>";
													//echo "Surface is located at: ".$locationstring." <br>";


													//echo "<br> Resetting all variables ========================================<br>";
													$interal_loop 	= 0;
													$include		= 0;
													$number_of_records = 0;
													$average_mu		= 0;
													$size_of_array	= 0;
													$locationstring = "";
													$locationx		= "";
													$locationy		= "";
													$average_text	= "";
													$muarray		= array();
													$muarray_t		= array();
													$muarray_i		= array();
													$muarray_f		= array();
													$muarray_c		= array();
													$muarray_loc	= array();

											
											}
									}
									
								//echo "Text is: ".$checklist_item_disc."<br>";
								// Test to see if we include this record into the array
								$include = 0;
								
								if($use40andup == 1 AND $checklist_item_disc >=40) {
										$include = 1;
								}
								if($usenullmu == 1 AND $checklist_item_disc == '') {
										$include = 1;
								}
								if($checklist_item_disc > 0 AND $checklist_item_disc <= 39) {
										$include = 1;
								}

								
								if($include == 1) {
										// Include this record
										
										$muarray[$interal_loop] 	= $checklist_item_disc;
										$muarray_t[0] 				= $muarray_t[0] + ($muarray[$interal_loop]);
										$muarray_i[$interal_loop]	= $condition_id;
										$muarray_f[$interal_loop]	= $facility_name;
										$muarray_c[$interal_loop]	= $condition_name;
										$muarray_loc[$interal_loop]	= array($condition_location_x,$condition_location_y);
										//echo "     Mu Value: ".$muarray[$interal_loop]." <br>";
										//echo "     Total:    ".$muarray_t[0] ." <br>";
										//echo "This Mu:		".$checklist_item_disc."	Current Total:		".$muarray_t[0]." 		Loop #:		".$interal_loop." <br>";


										$has_run		= 1;
										$interal_loop 	= $interal_loop + 1;	
									}
									
									$previous_id = $condition_id;
							}
							else {
							
									if ($checklist_item_id	== $previous_facility) {
												// This is is a new row to display.
												// Display Facility Name
										}
										else {
											
											$offset_x		= 58;
											$offset_y		= 61;	
											
											$js_array_x		= "";
											$js_array_y		= "";
											$locationstring	= "";
											
											$xlocations		= explode(",",$condition_location_x);
											$ylocations		= explode(",",$condition_location_y);
											$size_of_array 	= count($xlocations);				

											if($size_of_array == 1) {
													// Draw Single Point Item
												}
												else {
													// CONVERT Large X,Y into small X,Y....
													for ($k=0; $k<count($xlocations); $k=$k+1) {
															// Loop through array and replace values as they comeup
															//echo "X Locations: ".$xlocations[$k]." <br>";
															
															
															$locationx		= $xlocations[$k];
															$locationy 		= $ylocations[$k];
															
															$locationx		= convertfromlargescale_x_to_gps_long($locationx,$convertarray);
															$locationy 		= convertfromlargescale_y_to_gps_lat($locationy,$convertarray);
																		
															
															//echo "Location X ".$locationx."<br>";
															//echo "Location Y ".$locationy."<br>";
															//$locationx		= settype($locationx,'int');
															//$locationy		= settype($locationy,'int');
															
															//$record_long 	= ($long0 + $delta_x * $locationx);
															//$record_long 	= $record_long * -1;
															//$record_lat 	= ($lat0 + $delta_y * $locationy);
															
															$record_long	= $locationx;
															$record_lat		= $locationy;
															
															if($k == 0) {
																	$first_y = $record_long;
																	$first_x = $record_lat;
															}
															
															//$xlocations[$k] = convertfromlargescale_to_gps_x($ylocations[$k],$convertarray);
															//$ylocations[$k] = convertfromlargescale_to_gps_y($xlocations[$k],$convertarray);
															
															if($checklist_item_disc == 0 OR $checklist_item_disc == '') {
																	$tmp_value = 0 * $scale;
															}
															else {
																	$tmp_value = ($checklist_item_disc * $scale);
															}
															
															$locationstring = $locationstring."".$record_long.",".$record_lat .",".$tmp_value." ";
														}	
												}									
									
											$name			= "Facility: ".$facility_name.", Surface: ".$condition_name." ";
											$description 	= "Facility: ".$facility_name.", Surface: ".$condition_name.", has a Mu value of : ".$checklist_item_disc." ";
									
											//$xlocations		= implode(", ",$xlocations);
											//$ylocations		= implode(", ",$ylocations);				
									
											
											//echo $locationstring;	
											// Remove training ','
											//$locationstring = substr_replace($locationstring ,"",-1);
											//echo $locationstring;	
											$locationstring = $locationstring.",".$first_y.",".$first_x.",".$tmp_value." ";
											
											$value_of_mu = $checklist_item_disc;
											
											if($value_of_mu >= 0 AND $value_of_mu <=20 ) {
													$linecolor = "_Mu20";
											}
											if($value_of_mu >= 21 AND $value_of_mu <= 25 ) {
													$linecolor = "_Mu25";
											}
											if($value_of_mu >= 26 AND $value_of_mu <= 29 ) {
													$linecolor = "_Mu29";
											}				
											if($value_of_mu >= 30 AND $value_of_mu <= 35 ) {
													$linecolor = "_Mu35";
											}
											if($value_of_mu >= 36 AND $value_of_mu <= 39 ) {
													$linecolor = "_Mu39";
											}			
											if($value_of_mu >= 40 ) {
													$linecolor = "_Mu40";
											}	
											
											$styleselect = "style".$linecolor;
											
											$previous_facility	= $checklist_item_id;
											$i 					= $i + 1;
										
											// GOOGLE EARTH WORK for KML File
													//Create a Folder element and append it to the KML element
		$placeobject = $dom->createElement('Placemark');
		$placeNode = $nDoc->appendChild($placeobject);			
		$placeobject->setAttribute('id',$tmpid);

		$placename = $dom->createElement('name',$name);
		$placeNode->appendChild($placename);				

		$placedesc = $dom->createElement('description', $description);
		$placeNode->appendChild($placedesc);

		$stylenode =$dom->createElement('styleUrl',$styleselect);
		$placeNode->appendChild($stylenode);

		$linenode = $dom->createElement('Polygon');
		$placeNode->appendChild($linenode);

		$lineextrude = $dom->createElement('extrude', '1');
		$linenode->appendChild($lineextrude);

		$linealtitude = $dom->createElement('altitudeMode', 'relativeToGround');
		$linenode->appendChild($linealtitude);					

		$outerboundnode = $dom->createElement('outerBoundaryIs');
		$linenode = $linenode->appendChild($outerboundnode);

		$ringtype =$dom->createElement('LinearRing');
		$linenode = $linenode->appendChild($ringtype);

		$coordnode = $dom->createElement('coordinates',$locationstring);
		$ringtype->appendChild($coordnode);	


												

										}
								}
														
						}
						mysqli_free_result($res);
						mysqli_close($objcon);				
				}
		}


$kmlOutput = $dom->saveXML();
header('Content-type: application/vnd.google-earth.kml+xml');
header('Content-Disposition: attachment; filename="SurfaceMuValues.kml"');
echo $kmlOutput;
?>