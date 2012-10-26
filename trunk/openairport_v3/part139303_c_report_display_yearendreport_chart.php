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
//	Name of Document		:	part139303_c_report_display_yearendreport.php
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
		$displaystudent_id		= $_POST['frm_student'];
		
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

		if($displaystudent_id == 'all') {
				// User has selected to display all activity
				//ignore this setting
			}
			else {
				// There is a control to limit the species to a specific type
				$msql_s 		= "AND tbl_systemusers.emp_record_id = '".$displaystudent_id."' ";
			}	
			
// Define Variables	
		
		$navigation_page 			= 36;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 12;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

		$graph_array				= array();
// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures
//

?>
		
<?php
	
	$ary_student_id_list	= array();
	$counter				= 0;
	$previous_id			= 0;
	
	$sql = "SELECT * FROM tbl_139_303_c_sub_sa 
			INNER JOIN tbl_systemusers		ON tbl_systemusers.emp_record_id = tbl_139_303_c_sub_sa.discrepancy_student_cb_int
			WHERE discrepancy_hidden_yn = 0 AND emp_archieved_yn = 0 ".$msql_s." 
			ORDER BY emp_record_id";
	
	//echo "SELECT SQL String is :".$sql." <br>";
	
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
							
							// Store Student ID in an array (Will probably have duplicate IDs
							//	We will clean the array latter
							//		hum..unique aray seems foobar
							
							$current_id 					= $objarray['emp_record_id'];
							
							if($previous_id == 0) {
									// Never been run before
									
									//echo "[1] Test Has never run before <br>";
							
									$ary_student_id_list[$counter] 	= $objarray['emp_record_id'];
							
									//echo "Initial Array Counter Value [ ".$ary_student_id_list[$counter]." ] <br>";
									$counter = $counter + 1;
								} else {
									
									if($current_id == $previous_id) {
											// They are the same, do nothing
											
											//echo "Values are the same, ignore <br>";
											
										} else {
											// Now they are not.
											
											//echo "Test has run before, and this row is different than the one before it <br>";
											
											$ary_student_id_list[$counter] 	= $objarray['emp_record_id'];
									
											//echo "Initial Array Counter Value [ ".$ary_student_id_list[$counter]." ] <br>";
											$counter = $counter + 1;
										}
								}
							$previous_id = $objarray['emp_record_id'];
						}
				}
		}

	// Remove Duplicate Student ID's from the Array
	
		//$ary_student_id_list_unique = array_unique($ary_student_id_list);
		//$ary_student_id_list_ucount	= count($ary_student_id_list_unique);
		
		$ary_student_id_list_unique = $ary_student_id_list;
		$ary_student_id_list_ucount	= count($ary_student_id_list);
		
		$student_cells	= ($ary_student_id_list_ucount + 1);
		$table_cells	= ($student_cells + 3);
		
		//echo "There are [ ".$ary_student_id_list_ucount." ] Students in the unique array <br>";
		?>
	<table border="1" style="border-collapse:collapse;" width="750" bgcolor="#FFFFFF" align="left" valign="top">
		<tr>
			<td colspan="<?php echo $table_cells;?>" align="center" valign="middle" height="42" width="60%">
				<font size="4"><b>
					Part 139.303 (c) Student Training Record
					</font></b>
				</td>
			</tr>	
		<tr>
			<td colspan="<?php echo $table_cells;?>" align="center" valign="middle" bgcolor="#000000">
				<font color="#FFFFFF">Classes students have taken</font>
				</td>
			</tr>		
		<tr>
			<td rowspan="2" align="center" valign="middle">
				&nbsp;&nbsp;<b>Facility </b>
				</td>
			<td rowspan="2" align="center" valign="middle">
				&nbsp;&nbsp;<b>Condition </b>
				</td>
			<td colspan="<?php echo $student_cells;?>" align="center" valign="middle">
				&nbsp;&nbsp;<b>Student Training Time</b>
				</td>							
			</tr>
		<tr>
			<?php
			for($i=0;$i<($ary_student_id_list_ucount);$i++) {
					?>
			<td colspan="<?php echo $student_cellst;?>" align="center" valign="bottom">
				<?php
				// Get Student Name field into a variable
				$student_id		= $ary_student_id_list_unique[$i];
				//echo "Student ID is [ ".$student_id." ] <br>";
				$student_name 	= systemusertextfield($student_id, "all", "any", "hide", $student_id);
				//echo "Student Name [ ".$student_name." ] <br><br>";
				// Split the value of the field into one char arrays
				$ary_student_name 	= str_split($student_name);
				$ary_student_cname 	= count($ary_student_name);
				//echo "Student Name is [ ".$ary_student_cname." ] chars long <br>";
				// Loop through the array and place each char on a new line
				for($j=0;$j<=($ary_student_cname);$j++) {
						?>
						<?php echo $ary_student_name[$j];?><br>
						<?php
					}
				
					?>

					<?php
			}
			?>
		</td>
			<td bgcolor="#COCOCO" align="center" valign="middle">
				Total <br>
				in <br>
				Minutes
				</td>
			</tr>				
		<?php
	$sql = "SELECT * FROM tbl_139_303_c_sub_c_f 
			INNER JOIN tbl_139_303_c_sub_c	ON tbl_139_303_c_sub_c.condition_facility_cb_int = tbl_139_303_c_sub_c_f.facility_id 
			WHERE facility_archived_yn = 0 AND condition_archived_yn = 0 ".$msql_f." ".$msql_c." 
			ORDER BY facility_name, condition_name";	
	
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
							$current_condition 	= $objarray['conditions_id'];
							$current_cname		= $objarray['condition_name'];
									
							?>
		<tr>
			<td>
				<?php echo $current_fname;?>
				</td>
			<td>
				<?php echo $current_cname;?>
				</td>
							<?php
							for($i=0;$i<($ary_student_id_list_ucount);$i++) {
									?>
			<td align="right" valign="middle">
				<?php
				echo $student_class_time = tools_139303_c_studenttimeinaclass($current_facility,$current_condition,$ary_student_id_list_unique[$i]);
				
				$condition_time = $condition_time + $student_class_time;
				
				$ary_student_time[$i] = $ary_student_time[$i] + $student_class_time;
				?>
				</td>
									<?php
								}
								?>
			<td bgcolor="#COCOCO" align="center" valign="middle">
				<?php
				echo $condition_time;
				
				$facility_time = $facility_time + $condition_time;
				$condition_time = 0;
				?>
				</td>
			</tr>
								
								<?php
							
						}
				}
		}
		?>
		<tr>
			<td colspan="2">
				Total Time (Minutes)
				</td>
		<?php
		for($i=0;$i<($ary_student_id_list_ucount);$i++) {
				?>
			<td align="right" valign="middle">
				<?php
				echo $ary_student_time[$i];
				?>
				</td>
				<?php
			}				
			?>
			<td bgcolor="#COCOCO" align="center" valign="middle">
				<?php echo $facility_time;?>
				
				</td>
			</tr>
		<tr>
			<td colspan="2">
				Total Time (Hours)
				</td>
		<?php
		for($i=0;$i<($ary_student_id_list_ucount);$i++) {
				?>
			<td align="right" valign="middle">
				<?php
				
				$tmp_hours = $ary_student_time[$i];
				$tmp_hours = round(($tmp_hours/60),2);
				echo $tmp_hours;
				?>
				</td>
				<?php
			}				
			?>
			<td bgcolor="#COCOCO" align="center" valign="middle">
				<?php 
				
				$facility_time = round(($facility_time/60),2);
				echo $facility_time;
				?>
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