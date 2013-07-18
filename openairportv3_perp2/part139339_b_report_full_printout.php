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
//	Name of Document		:	printouts_general_get.php
//
//	Purpose of Page			:	Default Printout Viewer
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	
// Load Global Include Files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");	
		include("includes/_template/template.list.php");								// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");
		
// Load GET Variables		
		
		// LOAD DATE INFORMATION
		
		$frmstartdate	= $_GET['frmstartdate'];
		$frmenddate		= $_GET['frmenddate'];
		
		// Construct SQL Statement		
		
		$sql 			= "SELECT * FROM tbl_139_339_sub_n 
							INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_339_sub_n.139339_sub_n_type_cb_int 
							INNER JOIN tbl_139_339_sub_t ON tbl_139_339_sub_t.139339_type_id = tbl_139_339_sub_n.139339_sub_n_type_cb_int 
							WHERE tbl_139_339_sub_n.139339_sub_n_date >= '".$frmstartdate."' AND tbl_139_339_sub_n.139339_sub_n_date <= '".$frmenddate."' 
							ORDER BY tbl_139_339_sub_n.139339_sub_n_date";
		
// ESTABLISH TABLE FORMAT (B/W)

?>
<table width="100%" cellpadding="0" cellspacing="0" border="1" />
	<tr>
		<td colspan="20" bgcolor="#000000" align="center" valign="middile" />
			<font color="#FFFFFF" size="4">
				NOTAM FULL SUMMARY
				</font>
			</td>
		</tr>
	<tr>
		<td colspan="5" bgcolor="#808080" align="left" valign="middile" /> 
			Start Date
			</td>
		<td colspan="5" bgcolor="#808080" align="left" valign="middile" /> 
			<?php echo $frmstartdate;?>
			</td>			
		<td colspan="5" bgcolor="#808080" align="left" valign="middile" /> 
			End Date
			</td>		
		<td colspan="5" bgcolor="#808080" align="left" valign="middile" /> 
			<?php echo $frmenddate;?>
			</td>
		</tr>
	<tr>
		<td rowspan="2" bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">ID
			</td>
		<td rowspan="2" bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">TYPE
			</td>	
		<td colspan="6" bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">ISSUE
			</td>
		<td rowspan="2" bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">NOTES
			</td>	
		<td rowspan="2" bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">Discrepancies
			</td>			
		<td rowspan="2" bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">SURFACES
			</td>
		<td colspan="2" bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">AUTO CLOSE
			</td>
		<td rowspan="2" bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">METAR
			</td>			
		<td colspan="6" bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">CLOSE
			</td>
		</tr>
	<tr>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">WHO
			</td>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">DATE
			</td>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">TIME
			</td>			
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">WX
			</td>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">Airline
			</td>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">FBO
			</td>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">DATE
			</td>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">TIME
			</td>	
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">WHO
			</td>			
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">DATE
			</td>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">TIME
			</td>			
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">WX
			</td>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">Airline
			</td>
		<td bgcolor="#C0C0C0" align="center" valign="middile" /> 
			<font size="2">FBO
			</td>			
		</tr>		
<?php
		$objconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
		if (mysqli_connect_errno()) {															// if there is an error making the connection inform the user
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());							// tell the user the error message
				exit();
			}
			else {																				// without any errors...
				$objrs = mysqli_query($objconn, $sql);											// create the query recordsource
						
				if ($objrs) {																	// if the recordsource is created without error do...
						$number_of_rows = mysqli_num_rows($objrs);								// How many rows did the sql statement find
						if($number_of_rows == 0) {
								?>
	<tr>
		<td rowspan="17" bgcolor="#FFFFFF" align="left" valign="middile" />
			NO RESULTS TO DISPLAY
			</td>
		</tr>
								<?php
							}
							while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
								?>
	<tr>
		<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
			<font size="1"><?php echo $objarray['139339_sub_n_id'];?>
			</td>
		<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
			<font size="1"><?php echo $objarray['139339_type'];?>
			</td>	
		<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
			<font size="1"><?php echo $objarray['emp_firstname'];?> <?php echo $objarray['emp_lastname'];?>
			</td>			
		<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
			<font size="1"><?php echo $objarray['139339_sub_n_date'];?>
			</td>
		<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
			<font size="1"><?php echo $objarray['139339_sub_n_time'];?>
			</td>			
		<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
			<font size="1"><?php echo $objarray['139339_sub_n_wx_in'];?>
			</td>
		<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
			<font size="1"><?php echo $objarray['139339_sub_n_airline_in'];?>
			</td>
		<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
			<font size="1"><?php echo $objarray['139339_sub_n_fbo_in'];?>
			</td>
		<td bgcolor="#FFFFFF" align="left" valign="middile" /> 
			<font size="1">
				<?php echo $objarray['139339_sub_n_notes'];?>
				</font>
			</td>	
		<td bgcolor="#FFFFFF" align="left" valign="middile" /> 
			<?php
			$sql3 			= "SELECT * FROM tbl_139_339_sub_n_dlink 
								INNER JOIN tbl_139_327_sub_d ON tbl_139_327_sub_d.Discrepancy_id = tbl_139_339_sub_n_dlink.139_339_n_dlink_discrepancy_id 
								WHERE tbl_139_339_sub_n_dlink.139_339_n_dlink_notam_id = '".$objarray['139339_sub_n_id']."' ";
								
			$objconn3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
							if (mysqli_connect_errno()) {															// if there is an error making the connection inform the user
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());							// tell the user the error message
									exit();
								}
								else {																				// without any errors...
									$objrs3 = mysqli_query($objconn3, $sql3);											// create the query recordsource
											
									if ($objrs3) {																	// if the recordsource is created without error do...
											$number_of_rows3 = mysqli_num_rows($objrs3);								// How many rows did the sql statement find
											if($number_of_rows3 == 0) {
													?>
								<font size="1">
									No Discrepancies
									</font>
													<?php
												}
												while ($objarray3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {
														?>
													<font size="1"><?php echo $objarray3['Discrepancy_name'];?>&nbsp;<i>(<?php echo $objarray3['discrepancy_remarks'];?>)</i>, 
													
													
													<?php
													}
											}
									
									}
									?>
			</td>				
		<td bgcolor="#FFFFFF" align="left" valign="middile" /> 
			<?php
			// PULL ALL SURFACE RECORDS
			$sql3 			= "SELECT * FROM tbl_139_339_sub_n_cc 
								INNER JOIN tbl_139_339_sub_n ON tbl_139_339_sub_n.139339_sub_n_id = tbl_139_339_sub_n_cc.139339_cc_ficon_cb_int 
								INNER JOIN tbl_139_339_sub_c ON tbl_139_339_sub_c.139339_c_id = tbl_139_339_sub_n_cc.139339_cc_c_cb_int 
								INNER JOIN tbl_139_339_sub_c_f ON tbl_139_339_sub_c_f.139339_f_id = tbl_139_339_sub_c.139339_c_facility_cb_int 
								WHERE tbl_139_339_sub_n.139339_sub_n_id = '".$objarray['139339_sub_n_id']."' 
								ORDER BY tbl_139_339_sub_c_f.139339_f_name";
								
			$objconn3 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
							if (mysqli_connect_errno()) {															// if there is an error making the connection inform the user
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());							// tell the user the error message
									exit();
								}
								else {																				// without any errors...
									$objrs3 = mysqli_query($objconn3, $sql3);											// create the query recordsource
											
									if ($objrs3) {																	// if the recordsource is created without error do...
											$number_of_rows3 = mysqli_num_rows($objrs3);								// How many rows did the sql statement find
											if($number_of_rows3 == 0) {
													?>
								<font size="1">
									No Surfaces
									</font>
													<?php
												}
												while ($objarray3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {													
													?>
													<font size="1"><?php echo $objarray3['139339_f_name'];?>, 
													
													
													<?php
													}
											}
									}
									
												
			// PULL ALL SURFACE RECORDS
			?>
			</td>
		<td bgcolor="#FFFFFF" align="left" valign="middile" /> 
			<font size="1"><?php echo $objarray['139339_sub_n_date_closed'];?>
			</td>
		<td bgcolor="#FFFFFF" align="left" valign="middile" /> 
			<font size="1"><?php echo $objarray['139339_sub_n_time_closed'];?>
			</td>
		<td bgcolor="#FFFFFF" align="left" valign="middile" /> 
			<font size="1">
				<?php echo $objarray['139339_sub_n_metar'];?>
				</font>
			</td>
							<?php
							// PULL CLOSED INFORMATION
							$sql2 			= "SELECT * FROM tbl_139_339_sub_n_r 
												INNER JOIN tbl_139_339_sub_n ON tbl_139_339_sub_n.139339_sub_n_id = tbl_139_339_sub_n_r.139339_sub_n_r_cancelled_id_int 
												INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_339_sub_n_r.139339_sub_n_r_by_cb_int 
												WHERE tbl_139_339_sub_n.139339_sub_n_id = '".$objarray['139339_sub_n_id']."' 
												ORDER BY tbl_139_339_sub_n.139339_sub_n_date";
												
							$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
							if (mysqli_connect_errno()) {															// if there is an error making the connection inform the user
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());							// tell the user the error message
									exit();
								}
								else {																				// without any errors...
									$objrs2 = mysqli_query($objconn2, $sql2);											// create the query recordsource
											
									if ($objrs2) {																	// if the recordsource is created without error do...
											$number_of_rows2 = mysqli_num_rows($objrs2);								// How many rows did the sql statement find
											if($number_of_rows2 == 0) {
													?>
							<td colspan="6" bgcolor="#FFFFFF" align="left" valign="middile" />
								<font size="1">
									NOT CLOSED
									</font>
								</td>
													<?php
												}
												while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
														?>
							<td bgcolor="#FFFFFF" align="left" valign="middile" /> 
								<font size="1"><?php echo $objarray2['emp_firstname'];?> <?php echo $objarray2['emp_lastname'];?>
								</td>				
							<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
								<font size="1"><?php echo $objarray2['139339_sub_n_r_date'];?>
								</td>
							<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
								<font size="1"><?php echo $objarray2['139339_sub_n_r_time'];?>
								</td>			
							<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
								<font size="1"><?php echo $objarray2['139339_sub_n_r_wx_in'];?>
								</td>
							<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
								<font size="1"><?php echo $objarray2['139339_sub_n_r_airline_in'];?>
								</td>
							<td bgcolor="#FFFFFF" align="center" valign="middile" /> 
								<font size="1"><?php echo $objarray2['139339_sub_n_r_fbo_in'];?>
								</td>
													<?php
														}
												}
										}
								?>
								</tr>
								<?php
								}
						}
				}
		?>
	<tr>
		<td colspan="20" bgcolor="#000000" align="center" valign="middile" />
			<font color="#FFFFFF" size="2">
				End of Report
				</font>
			</td>
		</tr>
		<?php

		$navigation_page 			= 36;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 1;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");			
			
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $submit, $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 
		ae_completepackage($auto_array);			
			
// END OF FILE
?>