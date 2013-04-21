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
//	Name of Document		:	part139303_a_report_edit.php
//
//	Purpose of Page			:	Edit Existing Part 139.303(c) Person
//
//	Special Notes			:	Change the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

// Load Global Include Files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		//include("includes/_modules/part139337/part139337.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");

// Collect POST Information
		
		$inspection_id			= $_POST['recordid'];
		$menuitemid 			= $_POST['menuitemid'];		

if (!isset($_POST["tblname"])) {	
		// echo "Table Name POST is not set.  Probably not used, set to default <br>";
		$tblname	= '';
	} else {
		$tblname				= $_POST['tblname'];
	}
if (!isset($_POST["tblsubname"])) {	
		// echo "Table Sub Name POST is not set.  Probably not used, set to default <br>";
		$tblsubname	= '';
	} else {
		$tblsubname				= $_POST['tblsubname'];
	}	

		$debug = 0;

// Define Variables	
		
		$navigation_page 			= 36;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 1;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
		//	Do NOT Display Breadcrum report on this page...
	
// Start Procedures		
		
		if (!isset($_POST["formsubmit"])) {
		
//	Start Form Set Variables
			$sql 		= "SELECT * FROM tbl_systemusers 
							INNER JOIN tbl_systemusers_ncga ON tbl_systemusers_ncga.navigational_user_id_cb_int = tbl_systemusers.emp_record_id 
							INNER JOIN tbl_navigational_control_g ON tbl_navigational_control_g.navigational_groups_id = tbl_systemusers_ncga.navigational_group_id_cb_int 
							INNER JOIN tbl_organization_main ON tbl_organization_main.Organizations_id = tbl_systemusers.emp_organiation_cb_int 
							WHERE emp_record_id = '".$inspection_id."' ";
							
			$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				else {
					$objrs = mysqli_query($objconn, $sql);
							
					if ($objrs) {
							$number_of_rows = mysqli_num_rows($objrs);
						?>
	<table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" class="perp_menuheader" />
				<?php echo $tblname;?>
				</td>			
			</tr>			
		<tr>
			<td colspan="3" class="perp_menusubheader" />
				(
				<?php echo $tblsubname;?>
				)
				</td>				
			</tr>
						<?php
							while ($objarray = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
									?>
					<tr>
						<td colspan="2" class="item_name_inactive">
							<table cellspacing="0" width="100%">
								<tr>
									<?php
											// Hijack Template Functions for our own purposes
											$settingsarray 	= array("SELECT * FROM tbl_139_303_a_main_a WHERE 139303_a_a_inspection_id = ",	"inspection",	"part139303_a_report_display_archived.php");
											$functionpage	= "part139303_a_report_archieved.php";														
											_tp_control_archived($inspection_id, $settingsarray, $functionpage);
											
											$settingsarray 	= array("SELECT * FROM tbl_139_303_a_main_e WHERE 139303_a_e_inspection_id = ",	"inspection",	"part139303_a_report_display_error.php");
											$functionpage	= "part139303_a_report_error.php";														
											_tp_control_error($inspection_id, $settingsarray, $functionpage);	
											?>
									</tr>
								</table>
							</td>
						</tr>
						<?php
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= '';															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= '';															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Your Information - Edit Form";								// Name of the FORM, shown to the user
			$form_subh			= "please complete the form";									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Here is the information about you that you can edit";		// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 0;													// See Summary Function for how to use this number
				$returnHTML				= 0;													// 1: Returns only an HTML variable, 0: Prints the information as assembled.

			include("includes/_template/_tp_blockform_form_header.binc.php");
			?>								
			<input type="hidden" name="formsubmit"	ID="formsubmit"	value="1">
			<input type="hidden" name="recordid"	ID="recordid" 	value="<?php echo $inspection_id;?>">
			<input type="hidden" name="inspector" 		id="inspector"		 	value="<?php echo $_SESSION['user_id'];?>">
			<?php
			// FORM ELEMENTS
			//-----------------------------------------------------------------------------------------\\	
			// Load Form Elements
			//				POST Name		,Form Text			,Description of Field								,More Information about the Field																				,Syntax Information			,Type			,Field Width	,Field Height	,Default Value							,Function Name
			//																																																													1	Text Box	,in pixels		,in pixels		,										,
			//																																																													2	Text Area	,				,				,										,
			//																																																													3	Combobox	,
			//																																																													4	Map Button	,
			//																																																													5	Check box	,									
			form_new_table_b($formname);
			form_new_control("303firstname"	,"First Name"		, "Enter your First Name"							,"You may not change your name, sorry"																			,"(cannot be changed)"		,1				,0				,0				,$objarray['emp_firstname']				,0);
			form_new_control("303lastname"	,"Last Name"		, "Enter your Last Name"							,"You may not change your name, sorry"																			,"(cannot be changed)"		,1				,0				,0				,$objarray['emp_lastname']				,0);
			form_new_control("303initials"	,"Initials"			, "Enter your initials"								,"You may not change this, sorry"																				,"(cannot be changed)"		,1				,0				,0				,$objarray['emp_initials']				,0);
			form_new_control("303username"	,"User Name"		, "Enter your User Name"							,"Your username can be edited"																					,""							,1				,35				,0				,$objarray['emp_username']				,0);
			form_new_control("303password"	,"Password"			, "Enter your Password"								,"Your password can be edited"																					,""							,1				,35				,0				,$objarray['emp_password']				,0);
			form_new_control("303password2"	,"Password"			, "Confirm your Password"							,"Your passwords must be the same"																				,""							,1				,35				,0				,$objarray['emp_password']				,0);
			form_new_control("303org"		,"Organization"		, "Select your Organization"						,"You may not change your organization"																			,"(cannot be changed)"		,3				,0				,0				,$objarray['emp_organiation_cb_int']	,"organizationcombobox");
			form_new_control("303acesslevel","Access Level"		, "Select your Access Level"						,"You may not change your access rights"																		,"(cannot be changed)"		,3				,0				,0				,$objarray['navigational_groups_id']	,"_ac_accessleveltypecombobox");
			?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" />
						<tr>
							<td class="item_name_active" colspan="4">
								<p>
									Below are all of the avilable Dashpanel windows that can be displayed on the <b>HOME</b> 
									screen. You may choose if you want the window displayed or not and in what order you 
									wish to order them. In the '<i>Display</i>' colum checking the box will display the window
									unchecking the box will hide that window. In the '<i>Display Order</i>' column enter a number
									in the priority you wish to see the window. A smaller number wil be displayed first while a 
									larger number will be displayed last. Experiment with the order and see how you like it.
									</p>
								</td>
							</tr>
				<tr>
					<td class="item_name_active">
						Dash Name
						</td>
					<td class="item_name_active">
						Menu Name
						</td>
					<td class="item_space_active">
						Display
						</td>	
					<td class="item_space_active">
						Display Order
						</td>
					</tr>
									<?php

									// Load all DashPanel Functions, set their values to what the user has in their own settings
									
									$sql2 		= "SELECT * FROM tbl_dashpanel_main 
													INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_dashpanel_main.dash_menulink_int 
													WHERE dash_hidden_yn = 0";									
									$objconn2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs2 = mysqli_query($objconn2, $sql2);
													
											if ($objrs2) {
													$number_of_rows2 = mysqli_num_rows($objrs2);

													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	

															$dash_id	= $objarray2['dash_id'];
															$dash_floc	= $objarray2['dash_function_location'];
															$dash_nl	= $objarray2['dash_name_long'];
															$dash_ns	= $objarray2['dash_name_short'];
															$dash_purp	= $objarray2['dash_purpose'];
															$dash_mlnk	= $objarray2['dash_menulink_int'];
															
															$menu_id	= $objarray2['menu_item_id'];
															$menu_nl	= $objarray2['menu_item_name_long'];
															
															// Does the User know anything about this DashPanel?
															// if so load information about it...
															
															$sql3 		= "SELECT * FROM tbl_dashpanel_sub_s  
																			WHERE navigational_user_id_cb_int = '".$inspection_id."' AND navigational_group_id_cb_int = '".$dash_id."' ";								
															$objconn3 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
															
															if (mysqli_connect_errno()) {
																	// there was an error trying to connect to the mysql database
																	printf("connect failed: %s\n", mysqli_connect_error());
																	exit();
																}
																else {
																	$objrs3 = mysqli_query($objconn3, $sql3);
																			
																	if ($objrs3) {
																			$number_of_rows3 = mysqli_num_rows($objrs3);

																			while ($objarray3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {

																					$dash_s_id	= $objarray3['navigational_access_id'];
																					$dash_s_dsp	= $objarray3['navigational_groups_display_yn'];
																					$dash_s_pri	= $objarray3['navigational_groups_priority'];
															
																					if($number_of_rows3 == 0) {
																							// Nothing displayed
																							$displayvalue 	= 0;
																							$displaypri		= 0;
																						}
																						else {
																							$displayvalue 	= $dash_s_dsp;
																							$displaypri		= $dash_s_pri;
																						}
																						
																					$array_values[$dash_id] = array($displayvalue,$displaypri);	
																					
																				}
																		}
																}
															
															?>
				<tr>
					<td name="dashname<?php echo $dash_id;?>" 
						id="dashname<?php echo $dash_id;?>" 
						onmouseover="togglebutton_M_D('<?php echo $dash_id;?>','on');" 
						onmouseout="togglebutton_M_D('<?php echo $dash_id;?>','off');" 
						class="item_name_inactive" />
						<?php echo $dash_nl;?>
						</td>
					<td name="dashmname<?php echo $dash_id;?>" 
						id="dashmname<?php echo $dash_id;?>" 
						onmouseover="togglebutton_M_D('<?php echo $dash_id;?>','on');" 
						onmouseout="togglebutton_M_D('<?php echo $dash_id;?>','off');" 
						class="item_name_inactive" />
						<?php echo $menu_nl;?>
						</td>
					<td name="dashcheckbox<?php echo $dash_id;?>" 
						id="dashcheckbox<?php echo $dash_id;?>" 
						onmouseover="togglebutton_M_D('<?php echo $dash_id;?>','on');" 
						onmouseout="togglebutton_M_D('<?php echo $dash_id;?>','off');" 
						class="item_space_inactive" />
						<INPUT class='table_forms_enter_input_field' TYPE="checkbox" NAME="dashdsp_<?php echo $dash_id;?>" ID="dashdsp_<?php echo $dash_id;?>" VALUE="1" 
								<?php
								if($array_values[$dash_id][0] == 1) {
										?>
																																		 CHECKED
										<?php
									}
									?>																									
								>
						</td>
					<td name="dashorder<?php echo $dash_id;?>" 
						id="dashorder<?php echo $dash_id;?>" 
						onmouseover="togglebutton_M_D('<?php echo $dash_id;?>','on');" 
						onmouseout="togglebutton_M_D('<?php echo $dash_id;?>','off');" 
						class="item_space_inactive" />
						<select NAME="dashpri_<?php echo $dash_id;?>" ID="dashpri_<?php echo $dash_id;?>" />
							<?php
							for($i=0;$i<=$number_of_rows2;$i=$i+1) {
									
									if($i == $array_values[$dash_id][1]) {
											$default = 'selected="selected"';
										} else {
											$default = '';
										}
									?>
							<option value=<?php echo $i;?> <?php echo $default;?>/><?php echo $i;?></option>
									<?php
								}
								?>
							</select>
						</td>
					</tr>
															<?php
														}
												}
										}
										?>
						</table>
										<?php
								}
						}
				}

	// FORM UNIVERSAL CONTROL LOADING
	//------------------------------------------------------------------------------------------\\
	
	$targetname		= $_POST['targetname'];			// From the Button Loader; Name of the window this form was loaded into.
	$dhtml_name		= $_POST['dhtmlname'];			// From the Button Loader; Name of the DHTML window function to call to change this window.
	form_uni_control("targetname"		,$targetname);
	form_uni_control("dhtmlname"		,$dhtml_name);
	
	
//
// FORM FOOTER
//------------------------------------------------------------------------------------------\\
		$display_submit 		= 1;														// 1: Display Submit Button,	0: No
			$submitbuttonname	= 'Submit Changes';											// Name of the Submit Button
		$display_close			= 0;														// 1: Display Close Button, 	0: No
		$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
		$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
		$display_quickaccess	= 0;
		
	include("includes/_template/_tp_blockform_form_footer.binc.php");


					?>

				</table>
			</td>
		</tr>
	</table>
	</form>
					<?php
	}	
	else {
	
	// FORM HEADER
	// -----------------------------------------------------------------------------------------\\
			$formname			= "edittable";													// HTML Name for Form
			$formaction			= '';															// Page Form will submit information to. Leave valued at '' for the form to point to itself.
			$formopen			= 0;															// 1: Opens action page in new window, 0, submits to same window
				$formtarget		= '';															// HTML Name for the window
				$location		= $formtarget;													// Leave the same as $formtarget
	
	// FORM NAME and Sub Title
	//------------------------------------------------------------------------------------------\\
			$form_menu			= "Your Information - Summary Report";								// Name of the FORM, shown to the user
			$form_subh			= "Summary Report of your information";									// Sub Name of the FORM, shown to the user
			$subtitle 			= "Here is the information you provided";		// Subt title of the FORM, shown to the user

	// FORM SUMMARY information
	//------------------------------------------------------------------------------------------\\
			$displaysummaryfunction 	= 0;													// 1: Display Summary of Record, 0: Do not show summary
				$summaryfunctionname 	= '';													// Function to display the summary, leave as '' if not using the summary function
				$idtosearch				= '';													// ID to look for in the summary function, this is typically $_POST['recordid'].
				$detailtodisplay		= 0;													// See Summary Function for how to use this number
				$returnHTML				= 0;													// 1: Returns only an HTML variable, 0: Prints the information as assembled.
			
		include("includes/_template/_tp_blockform_form_header.binc.php");

		// Load Form Elements	
		// Place Default values from the POST Here or enter 'post'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\
		//																																																																										|
		//		Put a '0' here if you do not want to display the form field and only the result-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------\									|
		//																																																																	 v									v
		form_new_table_b($formname);
		form_new_control("303firstname"	,"First Name"		, "Enter your First Name"							,"You may not change your name, sorry"																			,"(cannot be changed)"		,1				,0				,0				,"post"			,0);
		form_new_control("303lastname"	,"Last Name"		, "Enter your Last Name"							,"You may not change your name, sorry"																			,"(cannot be changed)"		,1				,0				,0				,'post'			,0);
		form_new_control("303initials"	,"Initials"			, "Enter your initials"								,"You may not change this, sorry"																				,"(cannot be changed)"		,1				,0				,0				,'post'			,0);
		form_new_control("303username"	,"User Name"		, "Enter your User Name"							,"Your username can be edited"																					,""							,1				,0				,0				,'post'			,0);
		form_new_control("303password"	,"Password"			, "Enter your Password"								,"Your password can be edited"																					,""							,1				,0				,0				,'post'			,0);
		form_new_control("303password2"	,"Password"			, "Confirm your Password"							,"Your passwords must be the same"																				,""							,1				,0				,0				,'post'			,0);
		form_new_control("303org"		,"Organization"		, "Select your Organization"						,"You may not change your organization"																			,"(cannot be changed)"		,3				,0				,0				,'post'			,"organizationcombobox");
		form_new_control("303acesslevel","Access Level"		, "Select your Access Level"						,"You may not change your access rights"																		,"(cannot be changed)"		,3				,0				,0				,'post'			,"_ac_accessleveltypecombobox");
	
		// DO UPDATE OF MAIN TABLE HERE
		
		$sql = "UPDATE tbl_systemusers SET emp_username='".$_POST['303username']."', emp_password='".$_POST['303password']."' WHERE emp_record_id = ".$_POST['recordid']." ";
		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$lastid = mysqli_insert_id($mysqli);
						}

		// Now to do what we did before with the Dash Checklists, but we will have update issues and INSERT issues. 
	
		?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" />
				<tr>
					<td class="item_name_active" colspan="4">
						<p>
							Below are all of the avilable Dashpanel windows that can be displayed on the <b>HOME</b> 
							screen. You may choose if you want the window displayed or not and in what order you 
							wish to order them. In the '<i>Display</i>' colum checking the box will display the window
							unchecking the box will hide that window. In the '<i>Display Order</i>' column enter a number
							in the priority you wish to see the window. A smaller number wil be displayed first while a 
							larger number will be displayed last. Experiment with the order and see how you like it.
							</p>
						</td>
					</tr>
				<tr>
					<td class="item_name_active">
						Dash Name
						</td>
					<td class="item_name_active">
						Menu Name
						</td>
					<td class="item_space_active">
						Display
						</td>	
					<td class="item_space_active">
						Display Order
						</td>
					</tr>
									<?php

									// Load all DashPanel Functions, set their values to what the user has in their own settings
									
									$sql2 		= "SELECT * FROM tbl_dashpanel_main 
													INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_dashpanel_main.dash_menulink_int 
													WHERE dash_hidden_yn = 0";									
									$objconn2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
									//echo "DashPanel SQL :".$sql2." <br>";
									
									if (mysqli_connect_errno()) {
											// there was an error trying to connect to the mysql database
											printf("connect failed: %s\n", mysqli_connect_error());
											exit();
										}
										else {
											$objrs2 = mysqli_query($objconn2, $sql2);
													
											if ($objrs2) {
													$number_of_rows2 = mysqli_num_rows($objrs2);

													while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	

															$dash_id	= $objarray2['dash_id'];
															$dash_floc	= $objarray2['dash_function_location'];
															$dash_nl	= $objarray2['dash_name_long'];
															$dash_ns	= $objarray2['dash_name_short'];
															$dash_purp	= $objarray2['dash_purpose'];
															$dash_mlnk	= $objarray2['dash_menulink_int'];
															
															$menu_id	= $objarray2['menu_item_id'];
															$menu_nl	= $objarray2['menu_item_name_long'];
															
															$formvalue	= "dashdsp_".$dash_id;
															$formvalued	= $_POST[$formvalue];
															
															$formvalue	= "dashpri_".$dash_id;
															$formvaluep	= $_POST[$formvalue];
															
															
															if($formvaluep == '') {
																	$formvaluep = 0;
																}
																
															if($formvalued == '') {
																	$formvalued = 0;
																}
															
															//echo $formvalued." / ".$formvaluep." <br>";
															
															// Does the User know anything about this DashPanel?
															// if so load information about it...
															
															$sql3 		= "SELECT * FROM tbl_dashpanel_sub_s  
																			WHERE navigational_user_id_cb_int = '".$_POST['recordid']."' AND navigational_group_id_cb_int = '".$dash_id."' ";								
															$objconn3 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
															
															if (mysqli_connect_errno()) {
																	// there was an error trying to connect to the mysql database
																	printf("connect failed: %s\n", mysqli_connect_error());
																	exit();
																}
																else {
																	$objrs3 = mysqli_query($objconn3, $sql3);
																			
																	if ($objrs3) {
																			$number_of_rows3 = mysqli_num_rows($objrs3);

																			$counter = 0;
																			
																			while ($objarray3 = mysqli_fetch_array($objrs3, MYSQLI_ASSOC)) {

																					$dash_s_id	= $objarray3['navigational_access_id'];
																					$dash_s_dsp	= $objarray3['navigational_groups_display_yn'];
																					$dash_s_pri	= $objarray3['navigational_groups_priority'];
																					
																					//echo "FormValueP [ ".$formvaluep." ] <br>";
																					$array_sql[$counter] = "UPDATE tbl_dashpanel_sub_s SET navigational_groups_display_yn='".$formvalued."', navigational_groups_priority='".$formvaluep."' WHERE navigational_access_id = '".$dash_s_id."' ";
															
																					//echo $array_sql[$counter]." <br>";
																					
																					$counter = $counter + 1;
																				}
																		}
																}
															
															if($number_of_rows3 == 0) {
																	// No entry exists for this ID.
																	// INSERT RECORD
																	$sql_support = "INSERT INTO tbl_dashpanel_sub_s (navigational_user_id_cb_int, navigational_group_id_cb_int, navigational_groups_display_yn, navigational_groups_priority) 
																					VALUES ( '".$_POST['recordid']."', '".$dash_id."', '".$formvalued."', '".$formvaluep."' )";
																
																	//echo $sql_support." <br>";
																	
																	$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
																	//mysql_insert_id();
																	
																	if (mysqli_connect_errno()) {
																			// there was an error trying to connect to the mysql database
																			printf("connect failed: %s\n", mysqli_connect_error());
																			exit();
																		}		
																		else {
																		//mysql_insert_id();
																			$objrs = mysqli_query($mysqli, $sql_support) or die(mysqli_error($mysqli));
																			$lastid = mysqli_insert_id($mysqli);
																		}																					
																}
																else {
																
																	for($i=0; $i<count($array_sql); $i=$i+1) {
																	
																			//echo $array_sql[$i]." <br>";
																			
																			$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
																			//mysql_insert_id();
																			
																			if (mysqli_connect_errno()) {
																					// there was an error trying to connect to the mysql database
																					printf("connect failed: %s\n", mysqli_connect_error());
																					exit();
																				}		
																				else {
																				//mysql_insert_id();
																					$objrs = mysqli_query($mysqli, $array_sql[$i]) or die(mysqli_error($mysqli));
																					$lastid = mysqli_insert_id($mysqli);
																				}													
																	
																		}
																}
																
																															
															
																?>
					<tr>
					<td name="dashname<?php echo $dash_id;?>" 
						id="dashname<?php echo $dash_id;?>" 
						onmouseover="togglebutton_M_D('<?php echo $dash_id;?>','on');" 
						onmouseout="togglebutton_M_D('<?php echo $dash_id;?>','off');" 
						class="item_name_inactive" />
						<?php echo $dash_nl;?>
						</td>
					<td name="dashmname<?php echo $dash_id;?>" 
						id="dashmname<?php echo $dash_id;?>" 
						onmouseover="togglebutton_M_D('<?php echo $dash_id;?>','on');" 
						onmouseout="togglebutton_M_D('<?php echo $dash_id;?>','off');" 
						class="item_name_inactive" />
						<?php echo $menu_nl;?>
						</td>
					<td name="dashcheckbox<?php echo $dash_id;?>" 
						id="dashcheckbox<?php echo $dash_id;?>" 
						onmouseover="togglebutton_M_D('<?php echo $dash_id;?>','on');" 
						onmouseout="togglebutton_M_D('<?php echo $dash_id;?>','off');" 
						class="item_space_inactive" />
						<?php
								if($formvalued == 1) {
										?>
								Yes
										<?php
									}
									else {
									?>																									
								No
									<?php
								}
								?>
						</td>
					<td name="dashorder<?php echo $dash_id;?>" 
						id="dashorder<?php echo $dash_id;?>" 
						onmouseover="togglebutton_M_D('<?php echo $dash_id;?>','on');" 
						onmouseout="togglebutton_M_D('<?php echo $dash_id;?>','off');" 
						class="item_space_inactive" />
						<?php echo $formvaluep;?>
						</td>
					</tr>
															<?php
		
																
																
																
														}
												}
										}
										?>
						</table>
										<?php	
										
		// FORM UNIVERSAL CONTROL LOADING
	//------------------------------------------------------------------------------------------\\
	
	$targetname		= $_POST['targetname'];			// From the Button Loader; Name of the window this form was loaded into.
	$dhtml_name		= $_POST['dhtmlname'];			// From the Button Loader; Name of the DHTML window function to call to change this window.
	form_uni_control("targetname"		,$targetname);
	form_uni_control("dhtmlname"		,$dhtml_name);
		
	?>

	<?php
		//
		// Load Footer
				$display_submit 	= 0;
				$display_close 		= 0;
				$display_refresh	= 0;
				$display_pushdown	= 0;
				$display_text		= "Your information has been successfully Edited";	
				$display_quickaccess = 0;
				
			include("includes/_template/_tp_blockform_form_footer.binc.php");		
	?>
	</form>
	
	<form style="margin-bottom:0;" action="part139303_a_report_display.php" method="POST" name="printform" id="printform" target="_printerfriendlyreport" onsubmit="open_new_report_window('','_printerfriendlyreport');">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table3" align="left" valign="top" class="item_name_active" />
		<tr>
			<td class="item_name_active" colspan="5">
				<input type="hidden" name="recordid" 			value="<?php echo $_POST['recordid'];?>" />
				<?php
				_tp_control_function_submit('printform','Summary Report');
				?>
				</td>
			</tr>
		</table>
		</form>		
<?php
		}

// Establish Page Variables
		
		if (!isset($lastid)) {
				// Not defined, set to zero
				$last_main_id = 0;
			} else {
				$last_main_id = $lastid;
			}		
		if (!isset($_POST["formsubmit"])) {
				// Not defined, set to zero
				$submit = 0;
			} else {
				$submit = $_POST["formsubmit"];
			}

		$auto_array		= array($navigation_page, $_SESSION["user_id"], $submit, $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 
		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>