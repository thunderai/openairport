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
//	Name of Document		:	part139303_c_c_ajax_getchecklist.php
//
//	Purpose of Page			:	Load Part 139.303 (c) Inspection Checklist (AJAX)
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
		include("includes/gs_config.php");
		
// Load Page Specific Includes

		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		include("includes/_modules/part139303/part139303.list.php");
	
// Define Variables	
	
		$aInspection	= "";
		$i				= 1;
		$InspCheckList 	= $_GET["InspCheckList"];
		$IntInspector 	= $_GET["Employee"];
		
// Start Procedures		
		?>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<?php
	form_new_control('frmdate'			, 'Date'			, 'Enter the date this record was made'					,'The current date has automatically been provided!'	, '(mm/dd/yyyy)'				, 1				, 10			, 0 			, 'current'				, 0);
	form_new_control('frmtime'			, 'Time'			, 'Enter the time this record was made'					,'The current time has automatically been provided!'	, '(hh:mm:ss) - 24 hour format'	, 1				, 10			, 0 			, 'current'				, 0);
	?>
	</table>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
		<td class="item_space_active" />
				Focus Group (Regulation)
			</td>
		<td class="item_space_active" />
				Class Topic
			</td>
		<td class="item_space_active" />
				Taught ?
			</td>
		<td class="item_space_active" />
				Minutes
			</td>
		<td class="item_space_active" />
				Notes 
			</td>						
		</tr>
			<input type="hidden" id="typeofinspection" name="typeofinspection" value="<?php echo $InspCheckList;?>">
							<?php
							// Define SQL
							$sql = "SELECT * FROM tbl_139_303_c_sub_c 
							INNER JOIN tbl_139_303_c_sub_c_f ON tbl_139_303_c_sub_c_f.facility_id = tbl_139_303_c_sub_c.condition_facility_cb_int 							
							WHERE condition_type_cb_int = '".$InspCheckList."' AND condition_archived_yn = 0
							ORDER BY tbl_139_303_c_sub_c_f.facility_name, tbl_139_303_c_sub_c.condition_name";
							
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
											if($number_of_rows == 0) {
													// There are no records in this dataset
													?>
	<tr>
		<td class="item_space_active" colspan="5" />
			Checklist is empty.
			</td>
		</tr>
													<?php
												} else {					
													while ($objfields = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
															$tmpid = $objfields['conditions_id'];
															?>
	<tr>
		<td name="col_1_r<?php echo $tmpid;?>"
			id="col_1_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',5);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',5);" 
			class="item_name_small_inactive"
			/>
			&nbsp;
			<?php
			$tmpfacility = $objfields["condition_facility_cb_int"];
			//part139303_c_c_typescombobox($tmpfacility, "all", "notused", "hide", "all");
			$tmpvalue 	= (string) $tmpid;
			$tmpa 		= $tmpvalue."za";
			$tmpd		= $tmpvalue."zd";
			$tmpe		= $tmpvalue."ze";
			?>
			<?php echo $objfields["facility_name"];?>
			</td>
		<td name="col_2_r<?php echo $tmpid;?>" 
			id="col_2_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',5);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',5);" 
			class="item_name_small_inactive"
			/>
			&nbsp;
			<?php echo $objfields["condition_name"];?>
			</td>
		<td name="col_3_r<?php echo $tmpid;?>"
			id="col_3_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',5);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',5);" 
			class="item_name_small_inactive"
			/>
			<input class="commonfieldbox" type="checkbox" name="<?php echo $tmpa;?>" value="1" CHECKED>
			</td>
		<td name="col_4_r<?php echo $tmpid;?>"
			id="col_4_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',5);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',5);" 
			class="item_name_small_inactive"
			/>
			<input class="commonfieldbox" type="text" ID="<?=$tmpe;?>" name="<?=$tmpe;?>" value="15" size="3">
			</td>
		<td name="col_5_r<?php echo $tmpid;?>"
			id="col_5_r<?php echo $tmpid;?>"
			onmouseover="togglebutton_M_C('<?php echo $tmpid;?>','on',5);" 
			onmouseout="togglebutton_M_C('<?php echo $tmpid;?>','off',5);" 
			class="item_name_small_inactive"
			/>
			<?php
			// Need button to open window
			// Need window command
			//		Open in an iframe DHTML window, using the actual location with the get string. Button opens the window
			$target = 'addsubrecord';
			$action = 'part139303_c_discrepancy_report_new.php?facility='.$tmpfacility.'&condition='.$tmpid.'&checklist='.$InspCheckList.'&targetname='.$target.'&dhtmlname='.$target.'_var';
			
			_tp_control_function_button_iframe('addsubrecord','ADD','icon_add',$action,$target);
			?>
			</td>							
		</tr>
												<?php
														$i = $i + 1;
														}	// End of while loop
												}
												mysqli_free_result($res);
												mysqli_close($objcon);
										}	// end of Res Record Object						
								}
								?>
	</table>