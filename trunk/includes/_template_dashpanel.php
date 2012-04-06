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
//	Name of Document		:	_template_dashpanel.inc.php
//
//	Purpose of Page			:	Load Dashpanel Functions from modules
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// LOAD INCLUDE FILES

		// Load Systemuser Dashpanel
			include("includes/_systemusers/_dp_su_dailyactivity.inc.php");
		// Load Part 139.327 Inspection Dashpanel
			include("includes/_modules/part139327/part139327.list.php");
			include("includes/_modules/part139327/_dp_327_inspections.inc.php");
			include("includes/_modules/part139327/_dp_327_discrepancies.inc.php");		
		// Load Part 139.333 Inspection Dashpanel
			include("includes/_modules/part139333/part139333.list.php");
			include("includes/_modules/part139333/_dp_333_inspections.inc.php");
		// Load Part 139.337 Wildlife Hazard Reports Dashpanel
			include("includes/_modules/part139337/part139337.list.php");
			include("includes/_modules/part139337/_dp_337_inspections.inc.php");
		// Load Part 139.339 Field COndition Reports Dashpanel
			include("includes/_modules/part139339/part139339.list.php");
			include("includes/_modules/part139339/_dp_339_c_inspections.inc.php");
			include("includes/_modules/part139339/_dp_339_b_inspections.inc.php");
			
// START DASHBOARD PROCEDURES
		
		$counter 		= 0;
		$tmp_counter 	= 1;

		$sql = "SELECT * FROM tbl_dashpanel_main 
				INNER JOIN tbl_dashpanel_sub_s 	ON tbl_dashpanel_sub_s.navigational_group_id_cb_int = tbl_dashpanel_main.dash_id 
				INNER JOIN tbl_systemusers		ON tbl_systemusers.emp_record_id = tbl_dashpanel_sub_s.navigational_user_id_cb_int 
				INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_dashpanel_main.dash_menulink_int 
				WHERE tbl_dashpanel_sub_s.navigational_user_id_cb_int = '".$_SESSION['user_id']."' ORDER BY navigational_groups_priority ";

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
						// Take the number of rows returned divided by 2.
						$tmp_number_of_rows	= ( $number_of_rows / 2 );
						// Add One to the total and get the integer value, just in case the value is odd we add another row to even out the results.
						$tmp_number_of_rows	= ( $tmp_number_of_rows + 1 );
						settype($tmp_number_of_rows,'integer');
						?>
<table border="1" width="100%" align="left" valign="top" cellpadding="4" cellspacing="4" style="border-collapse:collapse;">
	<tr>
		<td colspan="2" class="layout_dashpanel_header">
			<?php echo $nameofairport;?> Dashboard
			</td>
		</tr>
	<tr>
		<td>
						<?php
						while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
								//echo $counter;
								
								$tmp_dash_sub_s_id 	= $objarray['navigational_access_id'];
								
								$tmp_dash_main_id 	= $objarray['dash_id'];
								$tmp_dash_main_func	= $objarray['dash_function_location'];
								$tmp_dash_main_nl	= $objarray['dash_name_long'];
								$tmp_dash_main_ns	= $objarray['dash_name_short'];
								$tmp_dash_main_p	= $objarray['dash_purpose'];
								$tmp_dash_main_ml	= $objarray['dash_menulink_int'];
								
								$tmp_menu_item_id	= $objarray['menu_item_id'];
								$tmp_menu_item_loc	= $objarray['menu_item_location'];
								$tmp_menu_item_nl	= $objarray['menu_item_name_long'];
								$tmp_menu_item_ns	= $objarray['menu_item_name_short'];
								
								$dasharray	= array($tmp_dash_main_id,$tmp_dash_main_func,$tmp_dash_main_nl,$tmp_dash_main_ns,$tmp_dash_main_p,$tmp_dash_main_ml,$tmp_menu_item_id,$tmp_menu_item_loc,$tmp_menu_item_nl,$tmp_menu_item_ns);
							
								if ($tmp_counter == 3) {
											$tmp_counter = 1;
										}
						
								if ($tmp_counter == 1) {
										// The TD Counter is equal to one, create a new row
										//echo "Making a new row in the table";
										?>

										<?php 								
									}
								?>
								

			<?php 
			$tmp_dash_main_func($dasharray);
			?>

								<?php 
								
								if ($tmp_counter == 2) {
										//End of the row that was created above
										//echo "Making the end of the row";
										?>

										<?php 
									}
													
						// Add One(1) to the TD Counter
						
								$tmp_counter = ($tmp_counter + 1);
								//echo "The next Loop of the TD Counter is equal to:".$tmp_counter."<br>";
						}
						mysqli_free_result($objrs);
						mysqli_close($objconn);
				}
		}
		?>
			</td>
		</tr>
	</table>