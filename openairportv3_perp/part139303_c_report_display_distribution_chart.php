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
//	Name of Document		:	part139303_c_report_classdist.php
//
//	Purpose of Page			:	Display Part 139.303 (c) Personnel Report
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
		include("includes/POSTs.php");															// This include pulls information from the $_POST['']; variable array for use on this page

// Load Page Specific Includes

		include("includes/_modules/part139303/part139303.list.php");
		//include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Collect POST Information
		
	//Get Information from the FORM
		$tmpstartdate 	= $_POST['frmstartdate'];
		$tmpenddate 	= $_POST['frmenddate'];
		$tmpstartdate2 	= $_POST['frmstartdateo'];
		$tmpenddate2	= $_POST['frmenddateo'];
		
		$displaycondition_id 	= $_POST['frm_condition'];
		$displayfacility_id 	= $_POST['frm_facility'];
		
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
		
		$navigation_page 			= 36;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 12;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

		$graph_array				= array();

		
		if($displaycondition_id == 'all') {
				// User has selected to display all animals
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_c 		= "AND tbl_139_303_c_sub_c.conditions_id = '".$displaycondition_id."' ";
			}
			
		if($displayfacility_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_f 		= "AND tbl_139_303_c_sub_c_f.facility_id = '".$displayfacility_id."' ";
			}	
		
?>
	<table border="1" style="border-collapse:collapse;" width="750" bgcolor="#FFFFFF" align="left" valign="top">
		<tr>
			<td colspan="4" align="center" valign="middle" height="42" width="60%">
				<font size="4"><b>
					Part 139.303 (c) Training Distribution Record
					</font></b>
				</td>
			</tr>	
			<tr>
				<td colspan="4" align="center" valign="middle" bgcolor="#000000">
					<font color="#FFFFFF">Topics Covered</font>
					</td>
				</tr>
			<tr>
				<td align="left" valign="middle">
					&nbsp;&nbsp;<b>Facility </b>
					</td>
				<td colspan="1" align="left" valign="middle">
					&nbsp;&nbsp;<b>Condition </b>
					</td>
				<td align="left" valign="middle">
					&nbsp;&nbsp;<b>Time Taken (m)</b>
					</td>							
				</tr>			
<?php

	$previous_type 		= 0;
	$previous_facility 	= 0;
	$previous_condition = 0;
	
	//$sql = "SELECT * FROM tbl_139_303_c_sub_c_c 
	//		INNER JOIN tbl_139_303_c_sub_c		ON tbl_139_303_c_sub_c.conditions_id = tbl_139_303_c_sub_c_c.conditions_checklists_condition_cb_int 
	//		INNER JOIN tbl_139_303_c_sub_c_f	ON tbl_139_303_c_sub_c_f.facility_id = tbl_139_303_c_sub_c.condition_facility_cb_int 
	//		INNER JOIN tbl_139_303_c_sub_t		ON tbl_139_303_c_sub_t.inspection_type_id = tbl_139_303_c_sub_c.condition_type_cb_int 
	//		WHERE conditions_checklist_archived_yn = 0 
	//		ORDER BY inspection_type, facility_name, condition_name";
	
	$sql = "SELECT * FROM tbl_139_303_c_sub_c_f WHERE facility_archived_yn = 0 ".$msql_f." ";	
	
	//echo $sql." <br>";
	
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
					
					//echo "Number of Rows 1 :".$number_of_rows." <br>";

					while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {		
							
							$current_facility 	= $objarray['facility_id'];
							$current_fname		= $objarray['facility_name'];
							
							$sql2 = "SELECT * FROM tbl_139_303_c_sub_c WHERE condition_facility_cb_int = '".$current_facility."' AND condition_archived_yn = 0 ".$msql_c." ";	
	
							//echo $sql2." <br>";
							
							$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

							if (mysqli_connect_errno()) {
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}
								else {
									$objrs2 = mysqli_query($objconn2, $sql2);
											
									if ($objrs2) {
											$number_of_rows2 = mysqli_num_rows($objrs2);

											//echo "Number of Rows 2 :".$number_of_rows2." <br>";
											
											while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {		
													
													$current_condition 	= $objarray2['conditions_id'];
													$current_cname		= $objarray2['condition_name'];
							
													$sql3 = "SELECT * FROM tbl_139_303_c_sub_c_c 
															INNER JOIN tbl_139_303_c_main		ON tbl_139_303_c_main.139_303_id = tbl_139_303_c_sub_c_c.conditions_checklists_inspection_cb_int 
															WHERE conditions_checklists_condition_cb_int = '".$current_condition."' AND conditions_checklist_archived_yn = 0 
																	AND tbl_139_303_c_main.139_303_date >= '".$use_start_date."' AND tbl_139_303_c_main.139_303_date <= '".$use_end_date."' ";	
							
													//echo $sql3." <br>";
													
													$objconn3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

													if (mysqli_connect_errno()) {
															// there was an error trying to connect to the mysql database
															printf("connect failed: %s\n", mysqli_connect_error());
															exit();
														}
														else {
															$objrs3 = mysqli_query($objconn3, $sql3);
																	
															if ($objrs3) {
																	$number_of_rows3 = mysqli_num_rows($objrs3);

																	//echo "Number of Rows 3 :".$number_of_rows3." <br>";
																	
																	$inner_loop = 0;
																	
																	while ($objarray3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {		
																			
																			
																			$current_condition 		= $objarray3['conditions_checklists_id'];							
																			
																			$current_training_time 	= $current_training_time + $objarray3['conditions_checklist_hours'];
																			$inner_loop 			= $inner_loop + 1;
																			
																			//echo "Number of Rows3 :".$number_of_rows3." / Inner Loop : ".$inner_loop." <br>";
																			
																			
																			
																			
																			if($inner_loop == $number_of_rows3) {
																					
																					//echo "Inner Loop is equal to Number of rows";
																					// This is the last record in the row, 
																					//	display the total time
																					?>
																					<tr>
																						<td>
																							<?php echo $current_fname;?>
																							</td>
																						<td>
																							<?php echo $current_cname;?>
																							</td>
																						<td>
																							<?php echo $current_training_time;?>
																							</td>
																						</tr>
																					<?php
																					$total_ticks = $total_ticks + 1;
																					
																					$graph_array[$total_ticks] = array($current_fname,$current_cname,$current_training_time);
																					
																					$inner_loop 			= 0;
																					$rolling_total 			= $current_training_time;
																					$current_training_time 	= 0;
																				
																				}
																			//$inner_loop = $inner_loop + 1;
																			
																		}
																		$number_of_rows3 = 0;
															}
														}
												

											}
									}
								}
								
					}
			}
		}

?>
			<tr>
				<td colspan="2" align="left" valign="middle">
					&nbsp;&nbsp;Total Training Time
					</td>
				<td align="left" valign="middle">
					<?php 
					echo $rolling_total."m / ";

					$rolling_total = round(($rolling_total/60),2);
					echo $rolling_total."h";
					
					$length = count($graph_array);
					$max	= max($graph_array);
					$max_h	= 300;
					$max_i	= settype($max,"integer");
					$ratio	= $max_i / $max_h;
					
					//echo $max_i." ";
					//echo $ratio;
					?>
					</td>						
				</tr>
			<tr>
				<td colspan="4" align="center" valign="middle" bgcolor="#000000">
					<font color="#FFFFFF">Topics Chart</font>
					</td>
				</tr>				
			<tr>
				<td colspan="4">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" valign="middle" bgcolor="#000000">
								<font color="#FFFFFF">Chart Key</font>
								</td>
							<td align="center" valign="middle" bgcolor="#000000">
								<font color="#FFFFFF">Chart</font>
								</td>
						<tr>
							<td width="100" height="<?php echo $max;?>" valign="top" align="left">
								Move your mouse over each bar chart to learn more about it.
								</td>
							<td >
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
<?php	

//$max	= $max + 25;
for ($i = 1; $i <=$length; $i++) {
							?>
							<td height="<?php echo $max;?>" width="35" align="left" valign="bottom">
									<?php
									$tooltip = "Bar Chart shows".$graph_array[$i][0].", ".$graph_array[$i][1]." ( ".$graph_array[$i][2]." ) minutes";
									?>
									<img src="/openairportv3t/images/Part_139_339/barchart_04.png" width="35" height="<?php echo $graph_array[$i][2];?>" alt="<?php echo $graph_array[$i][0];?>,<?php echo $graph_array[$i][1];?>(<?php echo $graph_array[$i][2];?>) minutes" onMouseover="ddrivetip('<?php echo $tooltip;?>')"; onMouseout="hideddrivetip()"/>
									<br><?php echo $graph_array[$i][2];?>
									</td>
							<?php
  
}
						?>
										</tr>
									</table>
								</td>
							</tr>
			<?php
// Establish Page Variables

		$last_main_id	= $inspection_id;
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>