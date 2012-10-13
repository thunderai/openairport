<?php 
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	part139327_discrepancy_display_distribution_chart.php
//
//	Purpose of Page			:	View Part 139.327 Discrepancy Hot Spots
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	
?>
<HTML>
	<HEAD>
		<TITLE>
			Open Airport - Airport Safety Self-Inspection Report (Printer Friendly)
			</TITLE>
<?php
// Load global include files
	
		//include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes
		include("includes/_dateandtime/dateandtime.list.php");
		include("scripts/_scripts_header_iface.inc.php");
		include("includes/AutoEntryFunctions.php");
		include("includes/_systemusers/systemusers.list.php");
		include("includes/_modules/part139327/part139327.list.php");
		include("includes/_navigation/_nav_displaytxtonreport.inc.php");
		include("includes/_generalsettings/_gs_gis_settings.inc.php");					// Load GIS Functions
		
// Set Variables
		$tmpspecies			= '';
		$tmpcounter			= '';
		$tmplastspecies		= '';
		
		$fullcounter		= '';
		
		$displayedrow		= '';	
		$display_spermit	= '';
		$display_fpermit	= '';

		$isarchived			= '';
		$iserror			= '';
		$displaydatarow		= '';
		
		$tmpdate			= '';
		
		$displayrow			= 1;

// Load POST Variables

		$tmpyear 		= $_POST['frmyear'];
	
			
		if (!isset($_POST['wlhmborder'])) {
				// Option is not set
				$displaygridborder	= 0;
			}
			else {
				// Option is set
				$displaygridborder 	= $_POST['wlhmborder'];
			}	


	//Get Information from the FORM
		$tmpstartdate 	= $_POST['frmstartdate'];
		$tmpenddate 	= $_POST['frmenddate'];
		$tmpstartdate2 	= $_POST['frmstartdateo'];
		$tmpenddate2	= $_POST['frmenddateo'];
		
		$displaycondition_id 	= $_POST['discondition'];
		$displayfacility_id 	= $_POST['disfacility'];
		$displayinspection_id 	= $_POST['disinspection'];
		
	// Convert start date and end date into sql format
	
		$tmpsqlstartdate	= amerdate2sqldatetime($tmpstartdate );
		$tmpsqlenddate		= amerdate2sqldatetime($tmpenddate );
		$tmpsqlstartdate2	= amerdate2sqldatetime($tmpstartdate2 );
		$tmpsqlenddate2		= amerdate2sqldatetime($tmpenddate2 );
		
		$tmptime = date('H:m:s');
		
		if($_POST['disusebrowser'] == '1') {
				$use_start_date = $tmpsqlstartdate;
				$use_end_date 	= $tmpsqlenddate;
			}
			else {
				$use_start_date = $tmpsqlstartdate2;
				$use_end_date 	= $tmpsqlenddate2;			
			}			

// Define Variables	
		
		$navigation_page 			= 16;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 13;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
		//	Do NOT Display Breadcrum report on this page...
	
// Start Procedures		
		?>
		<link href="stylesheets/reports_oa.css" rel="stylesheet" type="text/css">
		</HEAD>
	<BODY>
	
	<!-- Map -->
	<div style="position:absolute; z-index:1; left:4; top:85; width:<?php echo $maparray[1][1];?>;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[1][0];?>" width="<?php echo $maparray[1][1];?>" height="<?php echo $maparray[1][2];?>" />
		</div>
	<!-- Overlay -->
	<div style="position:absolute; z-index:2; left:0; top:30; width:<?php echo $maparray[2][1];?>;" align="left" />
		<img src="images/part_139_327/<?php echo $maparray[2][0];?>" width="<?php echo $maparray[2][1];?>" height="<?php echo $maparray[2][2];?>" />
		</div>			

		<?php
		
		$offsety 		= 85;
		$offsetx		= 3;											
		$mapwidth 		= $maparray[1][1];
		$mapheight		= $maparray[1][2];
		$displaygrid	= 70;											// <- ADJUST THIS VALUE FOR LARGER or SMALLER GRIDS
		
		if($displaycondition_id == 'all') {
				// User has selected to display all animals
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_c 		= "AND tbl_139_327_sub_c.conditions_id = '".$displaycondition_id."' ";
			}
			
		if($displayfacility_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_f 		= "AND tbl_139_327_sub_c_f.facility_id = '".$displayfacility_id."' ";
			}
			
		if($displayinspection_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_i 		= "AND tbl_139_327_sub_t.inspection_type_id = '".$displayinspection_id."' ";
			}			
			
		$sql 		= "SELECT * FROM tbl_139_327_sub_d 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_327_sub_d.Discrepancy_by_cb_int 
		INNER JOIN tbl_139_327_main 	ON tbl_139_327_main.inspection_system_id = tbl_139_327_sub_d.Discrepancy_inspection_id 
		INNER JOIN tbl_139_327_sub_t 	ON tbl_139_327_sub_t.inspection_type_id = tbl_139_327_main.type_of_inspection_cb_int 
		INNER JOIN tbl_139_327_sub_c 	ON tbl_139_327_sub_c.conditions_id = tbl_139_327_sub_d.discrepancy_checklist_id  
		INNER JOIN tbl_139_327_sub_c_f 	ON tbl_139_327_sub_c_f.facility_id = tbl_139_327_sub_c.condition_facility_cb_int 
		INNER JOIN tbl_general_conditions ON tbl_general_conditions.general_condition_id = tbl_139_327_sub_d.discrepancy_priority 
		
		WHERE Discrepancy_date >= '".$use_start_date."' AND Discrepancy_date <= '".$use_end_date."' ".$msql_c." ".$msql_f." ".$msql_i." ORDER BY facility_name, condition_name";

		//echo  "The SQL Statement is ".$sql." <BR>";

		// Create Connection Object to Database
		$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		
		// Establish Array
			//$mapwidth 		= 679;
			//$mapheight		= 849;
			//$displaygrid		= 50;
			
			$gridwidth_x	= round(($mapwidth / $displaygrid),0);
			$gridwidth_y	= round(($mapheight / $displaygrid),0);
			
			//echo "Grid Width X: ".$gridwidth_x." ";
			//echo "Grid Width Y: ".$gridwidth_y." || ";	
			
			$gridpixels_x	= round(($mapwidth / $gridwidth_x),0);
			$gridpixels_y	= round(($mapwidth / $gridwidth_x),0);					//	<- Notice the Hack, using x not y
			
			//echo "Grid Pixels X: ".$gridpixels_x." ";
			//echo "Grid Pixels Y: ".$gridpixels_y." <br>";				
			
		/* 		
		for ($i=0; $i < $gridwidth_x; $i=$i+1) {

				for ($j=0; $j<$gridwidth_y; $j=$j+1) {			
					
						$aphasethree_x[$i] = 0;
						$aphasethree_y[$j] = 0;
					}
			}		
		 */
		
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				// There is a good connection to the database
				$objrs = mysqli_query($objconn, $sql);
		
				if ($objrs) {
						// There is a successfull connection to the object record set
						
						$numberofrows = mysqli_num_rows($objrs);
						
						//echo  "There are ".$numberofrows." in this recordset. <br>";
						
						$counter		= 0;
						$totalweight	= 0;
						$hitcounter		= 0;
						$lastmax		= 0;
						
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$tmpid			= $objarray['Discrepancy_id'];
								$tmpspecies		= $objarray['conditions_id'];
								$tmpactivity	= $objarray['facility_id'];
								$tmpaction		= $objarray['inspection_type_id'];
								
								//$tmplocationx	= $objarray['139337_locationx'];
								//$tmplocationy	= $objarray['139337_locationy'];
								
								$tmplocationx	= convertfromlargescale_to_smallscale_x($objarray['Discrepancy_location_x'],$maparray);
								$tmplocationy	= convertfromlargescale_to_smallscale_y($objarray['Discrepancy_location_y'],$maparray);
								
								$displayrow_a	= preflights_tbl_139_327_main_sub_d_a_yn($tmpid,0); // 1 will not return a row even if it is archieved.
								$displayrow_d	= preflights_tbl_139_327_main_sub_d_d_yn($tmpid,0); // 1 will not return a row even if it is duplicate.

								if($displayrow_a == 0 OR $displayrow_d == 0) {
									// Do display Row
									$displayrow = 0;
								}
								else {
									$displayrow = 1;
								}
								
								//echo "test";
								
								if ($displayrow == 0) {
										// Report is archieved, do not display it
										$displayrow = 0;
									}
									else {
										
										for ($i=0; $i < $gridwidth_x; $i=$i+1) {

												for ($j=0; $j<$gridwidth_y; $j=$j+1) {			
													
														$current_x1 = ($i * $gridpixels_x);
														$current_y1 = ($j * $gridpixels_y);
														
														//echo "Current Grid Top-Left ".$current_x1.",".$current_y1." || ";
														
														$current_x2 = ($current_x1 + $gridpixels_x);
														$current_y2 = ($current_y1 + $gridpixels_y);
													
														//echo "Current Grid Bottom-Right ".$current_x2.",".$current_y2." <br>";
													
														// Now check to see if the report is within this box
														if($tmplocationx >= $current_x1) {
																//echo "Location is greater than X Origon... ";
																if($tmplocationx <= $current_x2) {
																		//echo "Location is less than X2... ";
																		if($tmplocationy >= $current_y1) {
																				//echo "Location is greater than Y Origon... ";	
																				if($tmplocationy <= $current_y2) {
																						//echo "Location is less than Y2... || ";
																						//echo "All Condition are met, save to grid <br>";
																						
																						$acordpare[$i][$j] 			= $acordpare[$i][$j] + 1;
																						$acordpare2[$i][$j][$tmpid] = 1;
																						
																						$currentmax = $tmpid;
																						
																						if($currentmax > $lastmax) {
																								$lastmax = $currentmax;
																							}
																							
																						
																						//echo "The ID of the array is ".$acordpare2[$i][$j][$tmpid]." tempid ".$tmpid."<br>";
																						//$hitcounter = $hitcounter + 1;
																						
																						//echo "New Cord Pare is ".$acordpare[$i][$j]." || ";
																						//echo "Values are i ".$i.", j ".$j." <br>";
																					}
																			}
																	}
															}
															
													$hitcounter = $hitcounter + 1;
													
													}
													
											$hitcounter = $hitcounter + 1;		
													
											}								
									}
									
								$counter		= $counter + 1;
								$tmpid = 0;
								
							}	// End of while loop
					}	// End of Object Record set
			}	// End of Active Connection
			
// Calculate the TOTAL Weight

if($counter <> 0) {

		$counter 		= 0;
		$tmpw			= 0;
		$totalweight 	= 0;

		//echo  "Array Y has ".count($aphasethree_y)." Elements <br>";
		
				for ($i=0; $i < $gridwidth_x; $i=$i+1) {

						for ($j=0; $j<$gridwidth_y; $j=$j+1) {	

								$tmpw 			= $acordpare[$i][$j];
								$totalweight	= $totalweight + $tmpw;
								
								//echo "The Total Weight of this Pare set is ".$tmpw." The Grand Total so far is ".$totalweight."<br>";
								
							}
					}
					
		//echo  "THE TOTAL WEIGHT is ".$totalweight." <br>";		

		$counter = 0;

		for ($i=0; $i < $gridwidth_x; $i=$i+1) {

				for ($j=0; $j<$gridwidth_y; $j=$j+1) {	
				
						$tmpw 						= $acordpare[$i][$j];
						$percent_of_weight 			= ( ($tmpw / $totalweight) * 100 );
						$array_percents[$counter]	= $percent_of_weight;
						
						//echo "The New Cord Pare Set has a weight of ".$tmpw." which is ".$percent_of_weight."% of the total <br>";
					
						$counter = $counter + 1;	
					}
					
				$counter = $counter + 1;		
			}

		$percent_minimum 	= min($array_percents);
		$percent_max 		= max($array_percents);
		$percent_average	= (100/count($array_percents));

		//echo  "Minimum Percent is ".$percent_minimum." <br>";
		//echo  "Maximum Percent is ".$percent_max." <br>";
		//echo  "Average Percent is ".$percent_average." <br>";

		$percent_max 	= $percent_max;
		$percent_90max 	= ($percent_max * .9);
		$percent_80max 	= ($percent_max * .8);
		$percent_70max 	= ($percent_max * .7);
		$percent_60max 	= ($percent_max * .6);
		$percent_50max 	= ($percent_max * .5);
		$percent_40max 	= ($percent_max * .4);
		$percent_30max 	= ($percent_max * .3);
		$percent_20max 	= ($percent_max * .2);
		$percent_10max 	= ($percent_max * .1);

		//echo  $percent_max."<br>";
		//echo  $percent_90max."<br>";
		//echo  $percent_80max."<br>";
		//echo  $percent_70max."<br>";
		//echo  $percent_60max."<br>";
		//echo  $percent_50max."<br>";
		//echo  $percent_40max."<br>";
		//echo  $percent_30max."<br>";
		//echo  $percent_20max."<br>";
		//echo  $percent_10max."<br>";
		//echo  $percent_minimum."<br>";		


		$cpercent_max 		= '#FF0000';
		$cpercent_90max 	= '#f35009';
		$cpercent_80max 	= '#f9860f';
		$cpercent_70max 	= '#fcb71a';
		$cpercent_60max 	= '#f2bd2c';
		$cpercent_50max 	= '#e8c43f';
		$cpercent_40max 	= '#dfca50';
		$cpercent_30max 	= '#d3d265';
		$cpercent_20max 	= '#c7da7c';
		$cpercent_10max 	= '#b8e498';
		$cpercent_min		= '#C3FDB8';

		$color				= '#CCCCCC';
		
		for ($i=0; $i < $gridwidth_x; $i=$i+1) {

				for ($j=0; $j< $gridwidth_y; $j=$j+1) {		

						// For this we need unrounded numbers as much as possible
						
						// Need to Cheat it.  Tge grid is 70
				
						$addedmod_x = 0;
						$addedmod_y = 0;
				
						$current_x1 = ($i * $gridpixels_x) + $offsetx + $addedmod_x;
						$current_y1 = ($j * $gridpixels_y) + $offsety + $addedmod_y;
						
						//echo "Grid Pixel x :".$gridpixels_x.", Y: ".$gridpixels_y." <br>";
						
						//echo "Current Grid Top-Left ".$current_x1.",".$current_y1." || ";
						
						$current_x2 = ($current_x1 + $gridpixels_x);
						$current_y2 = ($current_y1 + $gridpixels_y);
					
						//echo "Current Grid Bottom-Right ".$current_x2.",".$current_y2." <br>";							

						$cellvalue = $acordpare[$i][$j];
						
						//echo "Cell Value is ".$cellvalue." <br>";
						
						$percent_of_weight 	= ( ($cellvalue / $totalweight) * 100 );
						
						//echo "Percent of Weight is ".$percent_of_weight."% <br>";
				
						// Deterime Color
				
						if($percent_of_weight == $percent_minimum ) {
								//echo  "Percent weight is equal to Percent minimum <br>";
								$color = $cpercent_min;
								$image = 'pmin.png';
							}
							else {
								if($percent_of_weight == ($percent_max) ) {
										//echo  "Percent weight is 10 <br>";
										$color = $cpercent_max;
										$image = 'pmax.png';
									}
									else {
										if($percent_of_weight >= ($percent_90max) ) {
												//echo  "Percent weight is 20 <br>";
												$color = $cpercent_90max;
												$image = 'p90.png';
											}
											else {									
												if($percent_of_weight >= ($percent_80max) ) {
														//echo  "Percent weight is 30 <br>";
														$color = $cpercent_80max;
														$image = 'p80.png';
													}
													else {											
														if($percent_of_weight >= ($percent_70max) ) {
																//echo  "Percent weight is 40 <br>";
																$color = $cpercent_70max;
																$image = 'p70.png';
															}
															else {
																if($percent_of_weight >= ($percent_60max) ) {
																		//echo  "Percent weight is 50 <br>";
																		$color = $cpercent_60max;
																		$image = 'p60.png';
																	}
																	else {
																		if($percent_of_weight >= ($percent_50max) ) {
																				//echo  "Percent weight is 60 <br>";
																				$color = $cpercent_50max;
																				$image = 'p50.png';
																			}
																			else {
																				if($percent_of_weight >= ($percent_40max) ) {
																						//echo  "Percent weight is 70 <br>";
																						$color = $cpercent_40max;
																						$image = 'p40.png';
																					}
																					else {
																						if($percent_of_weight >= ($percent_30max) ) {
																								//echo  "Percent weight is 80 <br>";
																								$color = $cpercent_30max;
																								$image = 'p30.png';
																							}
																							else {
																								if($percent_of_weight >= ($percent_20max) ) {
																										//echo  "Percent weight is 90 <br>";
																										$color = $cpercent_20max;
																										$image = 'p20.png';
																									}
																									else {
																										if($percent_of_weight >= ($percent_10max) ) {
																												//echo  "Percent weight is MAX <br>";
																												$color = $cpercent_10max;
																												$image = 'p10.png';
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
							}						

						// Now we need to make an array to send with our link to a summary of those reports in the box
						
						$xs = $i;
						$ys = $j;
						//$zs = 652;
						
						$hits = 0;
						
						//echo "Hit Counter is ".$hitcounter." <br>";
						//echo "Max is ".$lastmax." <br>";
						
						//echo "Count of Z ".count($acordpare2,COUNT_RECURSIVE)." <br>";
						
					for ($z=0; $z<=$lastmax; $z=$z+1) {
								
								// The ID of the record is Z!
								
								$tmpz = $acordpare2[$xs][$ys][$z];
								
								//echo "Temp Z is ".$tmpz."<br>";;
								
								if($tmpz == 1) {
										// This is an element ID of this box!  save it to an array to pass to the form
										$aIDs[$hits] = $z;
										
										$hits = $hits + 1;
										//echo "Temp Z is ".$z."   ".$tmpz."<br>";
								
									}
									
							}
						
						// Alternate Test
						//$ahits_1		= (serialize($ahits_1));
						//$saIDs 	  		= str_replace("\"","|",$ahits_1);

						// Serilze the Array for transport!
						$saIDs 			= (serialize($aIDs));
						$saIDs 	  		= str_replace("\"","|",$saIDs);
						
						// Now to catch the Hack from above!
						
						// 1. What is the currentx1, currenty1, are they going to be larger than the max map height?
						
						$expected_end = ($current_y1 + $displaygrid - $offsety);
						
						if( $expected_end > $mapheight) {
								
								//echo "<br>";
								//echo "<br>";
								//echo "This box initial Y point plus the displaygrid will be greater than the mapheight <br>";
								
								$currentmoffsety = $current_y1 - $offsety;
								
								//echo "[1]. Current Y1: ".$currentmoffsety." plus ".$displaygrid." is ".($currentmoffsety+$displaygrid)." <br>";
								
								$largerthanmapheight = ($currentmoffsety + $displaygrid) - $mapheight;
								
								//echo "[2]. The map height is ".$mapheight.". This means that Y1 is ".$largerthanmapheight." larger <br>";
								
								$adjustedheight = ($displaygrid - $largerthanmapheight);
								
								//echo "[3]. The adjusted height of this cell is ".$adjustedheight." <br>";
								
								$adjustheight = 1;
								
							}			
						
						// Start to Display Div
						
						if($adjustheight == 1) {
								
								$heightnowis = $adjustedheight;
							}
							else {
								$heightnowis = $gridpixels_y;
							}
								
								
						?>
<div style="position:absolute; width:<?php echo $gridpixels_x;?>; left:<?php echo $current_x1;?>; top:<?php echo $current_y1;?>; z-index:9;border-collapse:collapse;" align="right" height="<?php echo $heightnowis;?>">
	<form style="margin: 0px; margin-bottom:0px; margin-top:0px;" action="part139327_discrepancy_display_distribution_summary.php" method="post" name="distform_<?php echo $i;?>_<?php echo $j;?>" id="distform_<?php echo $i;?>_<?php echo $j;?>" target="HotSpotSummaryReport" onsubmit="openchild600('part139327_discrepancy_display_distribution_summary.php','HotSpotSummaryReport');" />
		<input type="hidden" name="idarray" id="idarray" value="<?php echo $saIDs;?>">
	<table width="100%" cellpadding="0" cellspacing="0" border="<?php echo $displaygridborder;?>" style="border-collapse:collapse;margin: 0px; margin-bottom:0px; margin-top:-1px;">
		<tr>								
			<td height="<?php echo $heightnowis;?>" background="images/part_139_337/<?php echo $image;?>" align="center" valign="middle" onclick="javascript:document.distform_<?php echo $i;?>_<?php echo $j;?>.submit()">
				<font size="3"><B><?php echo $cellvalue;?></B></font>
				</td>
			</tr>
		</table>
		</form>
	</div>
						<?php
						$saIDs  = '';
						$aIDs  	= '';
						$overbypixels = '';
						$adjustheight = '';
						$heightnow = '';
					}
			}
	}
	?>
	<div style="position:absolute; z-index:13; left:10; top:470; width:400; align="center" />
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" borderCOLOR="#000000" width="100%" id="AutoNumber1" />
			<tr>
				<td colspan="2" align="center" valign="middle" align="center" bgcolor="#FFFFFF" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="4" COLOR="#000000" /><b>Discrepancy HotSpots!</b></font>
					</td>
				</tr>				
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Types of Conditions </b></font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="right" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" />
						<?php
						part139327conditionscomboboxwall($displaycondition_id , "all", "all", "hide", "");
						?>
						</font>
					</td>
				</tr>			
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Types of Facility(ies) </b></font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="right" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" />
						<?php
						part139327facilitycomboboxwall($displayfacility_id, "all", "all", "hide", "");
						?>
						</font>
					</td>
				</tr>					
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>Types of Inspection(s) </b></font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="right" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" />
						<?php
						part139327typescomboboxwall($displayinspection_id, "all", "all", "hide", "");
						?>
						</font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="2" COLOR="#000000" /><b>&nbsp;</b></font>
					</td>
				</tr>				
			<tr>
				<td colspan="2" align="left" valign="middle" width="100" background="images/part_139_327/cellbackground.png" height="15" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;">
					<font size="1" COLOR="#000000" />
						^, a report may not be shown because it is archived
						</font>
					</td>
				</tr>
			</table>
		</div>	

	<?php

	
		//					Filed Name / Variable				b	f	h	j		w		x		y	z
		//displaytxtonreport($objarray['Discrepancy_id'], 		1, 1, 30, "right", 	30, 	690, 	0, 	11); <-- Don't need this
		displaytxtonreport("Discrepancy HotSpot Locations", 	1, 5, 30, "center", 713, 	0, 		0, 	11);	
		displaytxtonreport("DATE", 								1, 3, 13, "left", 	190, 	5, 		32, 11);	
		displaytxtonreport(date('Y-m-d'), 							1, 3, 13, "left", 	190, 	95, 	32, 11);	
		displaytxtonreport("START DATE",	 					1, 3, 13, "left", 	190, 	290, 	32, 11);		
		displaytxtonreport($use_start_date,						1, 3, 13, "left", 	190, 	395, 	32, 11);		
		displaytxtonreport("TIME",								1, 3, 13, "left", 	190, 	5, 		52, 11);		
		displaytxtonreport($tmptime,							1, 3, 13, "left", 	30, 	95, 	52, 11);	
		displaytxtonreport("END DATE",							1, 3, 13, "left", 	190, 	290, 	52, 11);
		displaytxtonreport($use_end_date,						1, 3, 13, "left", 	190, 	395, 	52, 11);		

		displaytxtonreport("Discrepancy Report Hot Spots.  Red:(Very Hot)/Green:(No Action).",		1, 1, 50, "right", 	132, 	611, 	33, 12);
				
// Establish Page Variables
		
		$last_main_id	= "-";	// NO Useable ID
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>