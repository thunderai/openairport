<?php
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	part139339_b_report_display_new.php
//
//	Purpose of Page		:	Display any Part 139.339 (b) Inspection Report
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

		include("includes/gs_config.php");
		
// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");
		include("includes/_generalsettings/_gs_gis_settings.inc.php");	
		include("includes/_dateandtime/_dt_amerdate2sqldatetime.inc.php");	

// Creates the Document.
$dom	= new DOMDocument('1.0', 'UTF-8');
$nKml	= $dom->appendChild($dom->createElementNS('http://earth.google.com/kml/2.1', 'kml'));
$nDoc	= $nKml->appendChild($dom->createElement('Document'));	
	
$idSuffix='_Closed';

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
			
$idSuffix='_Expired';

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
			
		
		

		$discrepancybouncedid 		= "";
		$discrepancybounceddate 	= "";
		$discrepancybouncedtime 	= "";
		$discrepancyrepairid 		= "";
		$discrepancyrepairdate 		= "";
		$discrepancyrepairtime 		= "";
		$isduplicate				= "";
		$isarchived					= "";
		$displaydatarow				= "";
		$displaydiscrepancy 		= "";
		$rwy_loop_count				= 0;
		$tmp_rwy_mu					= 0;
		$previous_rwy_loop			= "";
		$current_rwy_loop			= "";
		$inner_rwy_loop				= 0;
		
		$tmp_runwayort_12			= -1;
		$tmp_runwayort_17			= -1;
		$display_menu_item			= array();
		
		$offset_x					= 1;
		$offset_y					= 90;	
	

	// GET SETTING CONTROLS
	//	form_new_control("discondition"		,"Time Period"				, "Select a Time Period"					,"Select a condition from the list provided!"			,""					,3			,50				,0				,"all"					,"part139339typescomboboxwall");
	//	form_new_control("disusedfor"		,"Search by Date"			, "Find by Dates Issued or Dates Closed"	,"Checking this box will use the dates above as issued, unchecked will use dates as closed by"		,""					,5			,50				,0				,"all"					,0);
	//	form_new_control("disonlycurrent"	,"Only Current Status"		, "Display only the current surface status"	,"Checking this box will display only the current status. Unchecking the box will allow other controls to work."		,""					,5			,50				,0				,"all"					,0);
	//	form_new_control("disusebrowser"	,"Use Above Settings"		, "Use Broser Settings or override"			,"Checking this box will use the dates above, unchecked will use the dates from the browser form"		,""					,5			,50				,0				,"all"					,0);

	if (!isset($_POST["frmstartdate"])) {
			// FORM END DATE IS NOT DEFINED, THIS IS PROBABLY A NETWORK KML FILE, SET DEFAULTS
			
			$current_year	= date('Y');
			$tmpstartdate 	= "01/01/2000";
			$tmpenddate 	= "12/31/".$current_year;
			//$tmpstartdate2 	= $_POST['frmstartdateo'];
			//$tmpenddate2	= $_POST['frmenddateo'];	

			$discondition		= 'all';
			$disusedfor			= 1;		
			$disonlycurrent		= 1;	
			$disusebrowser		= 1;			
	
		} else {
			// FORM IS MOST PROBABLY FROM THE LOADER, USE USER PROVIDED SETTINGS
		
			$tmpstartdate 	= $_POST['frmstartdate'];
			$tmpenddate 	= $_POST['frmenddate'];
			$tmpstartdate2 	= $_POST['frmstartdateo'];
			$tmpenddate2	= $_POST['frmenddateo'];

			$discondition	= $_POST['discondition']; 		// Check box
			$disusedfor		= $_POST['disusedfor']; 		// Check box		
			$disonlycurrent	= $_POST['disonlycurrent']; 	// Check box	
			$disusebrowser	= $_POST['disusebrowser']; 		// Check box	
		
		}	
	
	
		
	// Convert start date and end date into sql format
	
		$tmpsqlstartdate	= amerdate2sqldatetime($tmpstartdate );
		$tmpsqlenddate		= amerdate2sqldatetime($tmpenddate );
		$tmpsqlstartdate2	= amerdate2sqldatetime($tmpstartdate2 );
		$tmpsqlenddate2		= amerdate2sqldatetime($tmpenddate2 );	


	if ($disonlycurrent == 1) {
		
	} else {
		
			// DO WE ONLY WANT THE CURRENT STATUS OR SOME OTHER CREATION?
			if($discondition == 'all') {
					// USER HAS SELECTED ALL TIME PERIODS
					//	add nothing to the SQL statement
					//echo "Nothing to add to the SQL Statement <br>";
				} else {
					// USER HAS SELECTED A TIME PERIOD, 
					//	add specific data to sql statement
					//echo "Adding to the SQL Statement <br>";
					$sql_a = "AND tbl_139_339_sub_n.139339_sub_n_type_cb_int = '".$discondition."' ";
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
				
			if($disusedfor == 1) {
					// USER HAS SELECTED TO FIND BY DATE ISSUED
					//	add date made to search critera
					//echo "Add Date Issued to SQL Statement <br>";
					$sql_b = "AND tbl_139_339_sub_n.139339_sub_n_date >= '".$date_to_use_s."' AND tbl_139_339_sub_n.139339_sub_n_date <= '".$date_to_use_e."' ";
				} else {
					// USER HAS SELECTED A TIME PERIOD, 
					//	add specific data to sql statement
					//echo "Adding to the SQL Statement <br>";
					$sql_b = "AND tbl_139_339_sub_n.139339_sub_n_date_closed >= '".$date_to_use_s."' AND 139339_sub_n_closed <= '".$date_to_use_e."' ";
				}			
			
		}

	$sql = "SELECT * FROM tbl_139_339_sub_n 
	INNER JOIN tbl_139_339_sub_t 	ON tbl_139_339_sub_t.139339_type_id = tbl_139_339_sub_n.139339_sub_n_type_cb_int 
	INNER JOIN tbl_139_339_sub_t_i 	ON tbl_139_339_sub_t_i.139339_sub_t_id_int = tbl_139_339_sub_t.139339_type_id 
	INNER JOIN tbl_systemusers		ON tbl_systemusers.emp_record_id = tbl_139_339_sub_n.139339_sub_n_by_cb_int 
	WHERE 139339_sub_n_archived_yn = 0 ".$sql_a." ".$sql_b." ";

	//echo $sql."<br>";
	
	//make connection to database
	$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs = mysqli_query($objconn, $sql);
						
			if ($objrs) {
					$number_of_rows = mysqli_num_rows($objrs);
					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
							
							$record_id		= $objarray['139339_sub_n_id'];
							$skipping		= 0;
							
							// IS THIS NOTAM CURRENTLY CLOSED or ARCHIEVED?
							
							
							// Test for archived. If 1 not archived, 0 is archived?
							$display_archived		= preflights_tbl_139_339_sub_n_a_yn($objarray['139339_sub_n_id'],0);	
							//echo "Display Archived = ".$display_archived."<br>";
							$display_closed			= preflights_tbl_139_339_sub_n_r_yn($objarray['139339_sub_n_id'],0);
							//echo "Display Closed = ".$display_closed."<br>";
							
							if($display_archived == 0) {
									// Surface is archived, skipp the rest
									$skipping = 1;
								} else {														
									
									if($display_closed == 1) {
											// Surface NOTAM has no closed records
											$message = "Closed";
											$skipping = 0;
										} else {
											// Surface currently has closed notams on file
											$message = "Expired";
											if($disonlycurrent == 1) {
													// User has selected to display only active notams
													$skipping = 1;
												}
										}
									
									
								}

							
							//echo "Skipping is: ".$skipping;
							
							if($skipping == 0) {
									// Record is archived
									//		or
									//	surface is not closed and we only want current notams
									// dont do anything with this record. skip it.
									
								
							
							
							
							//	-----
							//	LOOK FOR THE SURFACES ATTACHED TO THIS NOTAM
							//	-----

							// Define SQL
							$sql = "SELECT * FROM tbl_139_339_sub_n_cc  
									INNER JOIN tbl_139_339_sub_c 	ON tbl_139_339_sub_c.139339_c_id = tbl_139_339_sub_n_cc.139339_cc_c_cb_int 
									INNER JOIN tbl_139_339_sub_c_f 	ON tbl_139_339_sub_c_f.139339_f_id =  tbl_139_339_sub_c.139339_c_facility_cb_int  
									WHERE tbl_139_339_sub_n_cc.139339_cc_d_yn = 1 AND tbl_139_339_sub_n_cc.139339_cc_ficon_cb_int = '".$record_id."' 
									ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
							
							//echo $sql;
							
							// Establish a Conneciton with the Database
							$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
							if (mysqli_connect_errno()) {
									printf("connect failed: %s\n", mysqli_connect_error());
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
													
												// IS THIS SURFACE A RUNWAY OR A TAXIWAY?
												//		if $facility_is_runway =1, then it is a runway. 0 is a taxiway and 8 is a ramp. 
												//		The only tricky part here is that a runway is composed of nine different sub 
												//		surfaces which need to be added to the array for display. 
												//		The display procedure doesn't care, it just wants x,y locations.
												//		Need to loop through the surfces of the runway and forcethem into the display_menu_item array
												
												if($facility_is_runway == 1) {
													
														// Surface is an array, load subload function
														// Define SQL
														$sql4 = "SELECT * FROM tbl_139_339_sub_c  
																WHERE 139339_c_facility_cb_int = '".$facility_id."' AND 139339_cc_type = 0 
																ORDER BY 139339_c_name";
														
												}
												else {
														// Define Different SQL Statement
														$tmp_surfacename		= str_replace("Closed","Mu",$tmpcondname);
														$sql4 = "SELECT * FROM tbl_139_339_sub_c  
																WHERE 139339_c_facility_cb_int = '".$facility_id."' AND 139339_c_name = '".$tmp_surfacename."' AND 139339_cc_type = 0  
																ORDER BY 139339_c_name";
												}
													
														//echo $sql4."<br><br>";
														
														// Establish a Conneciton with the Database
														$objcon4 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
								
														if (mysqli_connect_errno()) {
																printf("connect failed: %s\n", mysqli_connect_error());
																exit();
															}
															else {
																$res4 = mysqli_query($objcon4, $sql4);
																if ($res4) {
																		$number_of_rows4 = mysqli_num_rows($res4);
																		//printf("result set has %d rows. \n", $number_of_rows);
												
																		while ($objfields4 = mysqli_fetch_array($res4, MYSQLI_ASSOC)) {
														
																				
																				$condition_location_x2	= $objfields4['139339_cc_location_x'];
																				$condition_location_y2	= $objfields4['139339_cc_location_y'];
																				
																				$xlocations		= explode(",",$condition_location_x2);
																				$ylocations		= explode(",",$condition_location_y2);
																				$size_of_array 	= count($xlocations);				

																				$tmpid2					= $objfields4['139339_c_id'];
																				$facility_is_runway2	= $facility_is_runway;
																				$facility_name2			= $facility_name;
																				
																				//echo "<br> Size of Array: ".$size_of_array." <br>";
																				
																				if($size_of_array == 1) {
																						// Draw Single Point Item
																					}
																					else {
																						// CONVERT Large X,Y into gps x,y
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
																								
																								$tmp_value = "20";
																								
																								$locationstring = $locationstring."".$record_long.",".$record_lat .",".$tmp_value." ";
																							}	
																					}	
																				
																				$name			= "Facility: ".$facility_name." ";
																				$description 	= "Facility: ".$facility_name.", Surface is currently: ".$message." ";
									
																				$locationstring = $locationstring.",".$first_y.",".$first_x.",".$tmp_value." ";
											
																				$value_of_mu = $checklist_item_disc;
											
																				$styleselect = "style_".$message;
											
																				
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
															}
											}
									}
								}
							}
					}
			}
		}
		
$kmlOutput = $dom->saveXML();
header('Content-type: application/vnd.google-earth.kml+xml');
header('Content-Disposition: attachment; filename="SurfaceMuValues.kml"');
echo $kmlOutput;
?>	