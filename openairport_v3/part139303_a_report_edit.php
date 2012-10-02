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
		$tblname				= $_POST['tblname'];													
		$tblsubname				= $_POST['tblsubname'];
		
		$debug = 0;
		
// Start Procedures		
		
		if (!isset($_POST["formsubmit"])) {
		
//	Start Form Set Variables
	
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

	
			errorreport("[1]. Load Template Form Header",$debug);
			
			include("includes/_template/_tp_blockform_form_header.binc.php");
	
	
	
			$sql 		= "SELECT * FROM tbl_systemusers 
							INNER JOIN tbl_systemusers_ncga ON tbl_systemusers_ncga.navigational_user_id_cb_int = tbl_systemusers.emp_record_id 
							INNER JOIN tbl_navigational_control_g ON tbl_navigational_control_g.navigational_groups_id = tbl_systemusers_ncga.navigational_group_id_cb_int 
							INNER JOIN tbl_organization_main ON tbl_organization_main.Organizations_id = tbl_systemusers.emp_organiation_cb_int 
							WHERE emp_record_id = '".$inspection_id."' ";
							
			$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
			errorreport("[2]. Connect to Database with the Following SQL Statement :".$sql." ",$debug);
			
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
							
									errorreport("[3]. In While Loop Show Form Elements",$debug);
									
									// FORM ELEMENTS
									//-----------------------------------------------------------------------------------------\\	
									// Load Form Elements
									//				POST Name		,Form Text			,Description of Field								,More Information about the Field																				,Syntax Information			,Type			,Field Width	,Field Height	,Default Value							,Function Name
									//																																																													1	Text Box	,in pixels		,in pixels		,										,
									//																																																													2	Text Area	,				,				,										,
									//																																																													3	Combobox	,
									//																																																													4	Map Button	,
									//																																																													5	Check box	,									
									form_new_control("303firstname"	,"First Name"		, "Enter your First Name"							,"You may not change your name, sorry"																			,"(cannot be changed)"		,1				,0				,0				,$objarray['emp_firstname']				,0);
									form_new_control("303lastname"	,"Last Name"		, "Enter your Last Name"							,"You may not change your name, sorry"																			,"(cannot be changed)"		,1				,0				,0				,$objarray['emp_lastname']				,0);
									form_new_control("303initials"	,"Initials"			, "Enter your initials"								,"You may not change this, sorry"																				,"(cannot be changed)"		,1				,0				,0				,$objarray['emp_initials']				,0);
									form_new_control("303username"	,"User Name"		, "Enter your User Name"							,"Your username can be edited"																					,""							,1				,35				,0				,$objarray['emp_username']				,0);
									form_new_control("303password"	,"Password"			, "Enter your Password"								,"Your password can be edited"																					,""							,1				,35				,0				,$objarray['emp_password']				,0);
									form_new_control("303password2"	,"Password"			, "Confirm your Password"							,"Your passwords must be the same"																				,""							,1				,35				,0				,$objarray['emp_password']				,0);
									form_new_control("303org"		,"Organization"		, "Select your Organization"						,"You may not change your organization"																			,"(cannot be changed)"		,3				,0				,0				,$objarray['emp_organiation_cb_int']	,"organizationcombobox");
									form_new_control("303acesslevel","Access Level"		, "Select your Access Level"						,"You may not change your access rights"																		,"(cannot be changed)"		,3				,0				,0				,$objarray['navigational_groups_id']	,"_ac_accessleveltypecombobox");
									?>
					<table width="100%">
						<tr>
							<td class="formheaders">
								Dash Name
								</td>
							<td class="formheaders">
								Menu Name
								</td>
							<td class="formheaders">
								Display
								</td>	
							<td class="formheaders">
								Display Order
								</td>
							</tr>
									<?php

									// Load all DashPanel Functions, set their values to what the user has in their own settings
									
									$sql2 		= "SELECT * FROM tbl_dashpanel_main 
													INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_dashpanel_main.dash_menulink_int 
													WHERE dash_hidden_yn = 0";									
									$objconn2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
									errorreport("[4]. Connect to Database with the Following SQL Statement :".$sql2." ",$debug);
									
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
															
															errorreport("[5]. Connect to Database with the Following SQL Statement :".$sql3." ",$debug);
															
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
															
																					errorreport("[6]. Connect to Database with the Following SQL Statement :".$dash_s_id." ",$debug);
															
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
							<td class="formresults" onMouseover="ddrivetip('<?php echo $dash_purp;?>')"; onMouseout="hideddrivetip()">
								<?php echo $dash_nl;?>
								</td>
							<td class="formresults" onMouseover="ddrivetip('<?php echo $dash_purp;?>')"; onMouseout="hideddrivetip()">
								<?php echo $menu_nl;?>
								</td>
							<td class="formresults" onMouseover="ddrivetip('Check the box to display this Dash on your DashPanel')"; onMouseout="hideddrivetip()">
								<INPUT TYPE="checkbox" NAME="dashdsp_<?php echo $dash_id;?>" ID="dashdsp_<?php echo $dash_id;?>" VALUE="1" 
								<?php
								if($array_values[$dash_id][0] == 1) {
										?>
																																		 CHECKED
										<?php
									}
									?>																									
								>
								</td>
							<td class="formresults" onMouseover="ddrivetip('Enter a number to sort this Dash.  The lower the number the more top of the page it will be')"; onMouseout="hideddrivetip()">
								<INPUT TYPE="text" SIZE="3" NAME="dashpri_<?php echo $dash_id;?>" ID="dashpri_<?php echo $dash_id;?>" VALUE="<?php echo $array_values[$dash_id][1];?>">
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
//
// FORM FOOTER
//------------------------------------------------------------------------------------------\\
		$display_submit 		= 1;														// 1: Display Submit Button,	0: No
			$submitbuttonname	= 'Submit Changes';											// Name of the Submit Button
		$display_close			= 0;														// 1: Display Close Button, 	0: No
		$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
		$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
		
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
	
		//echo "Form has been submitted, do summary result page <br>";
		// Load Form Header
				$formname		= "edittable";
				$subtitle 		= "Your Information - Summary Report";
				$form_menu		= "Summary Report of your information";
				$form_subh		= "Here is the information you provided";
			
		include("includes/_template/_tp_blockform_form_header.binc.php");

		// Load Form Elements	
		// Place Default values from the POST Here or enter 'post'---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\
		//																																																																										|
		//		Put a '0' here if you do not want to display the form field and only the result-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------\									|
		//																																																																	 v									v
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
					<table width="100%">
						<tr>
							<td class="formheaders">
								Dash Name
								</td>
							<td class="formheaders">
								Menu Name
								</td>
							<td class="formheaders">
								Display
								</td>	
							<td class="formheaders">
								Display Order
								</td>
							</tr>
									<?php

									// Load all DashPanel Functions, set their values to what the user has in their own settings
									
									$sql2 		= "SELECT * FROM tbl_dashpanel_main 
													INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_dashpanel_main.dash_menulink_int 
													WHERE dash_hidden_yn = 0";									
									$objconn2 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
									
									errorreport("[4]. Connect to Database with the Following SQL Statement :".$sql2." ",$debug);
									
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
															
															errorreport("[5]. Connect to Database with the Following SQL Statement :".$sql3." ",$debug);
															
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
																					
																					
																					errorreport("[6]. Connect to Database with the Following SQL Statement :".$dash_s_id." ",$debug);
															
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
							<td class="formresults" onMouseover="ddrivetip('<?php echo $dash_purp;?>')"; onMouseout="hideddrivetip()">
								<?php echo $dash_nl;?>
								</td>
							<td class="formresults" onMouseover="ddrivetip('<?php echo $dash_purp;?>')"; onMouseout="hideddrivetip()">
								<?php echo $menu_nl;?>
								</td>
							<td class="formresults" onMouseover="ddrivetip('Check the box to display this Dash on your DashPanel')"; onMouseout="hideddrivetip()">
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
							<td class="formresults" onMouseover="ddrivetip('Enter a number to sort this Dash.  The lower the number the more top of the page it will be')"; onMouseout="hideddrivetip()">
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
		//
		// Load Footer
				$display_submit 	= 0;
				$display_close 		= 0;
				$display_refresh	= 0;
				$display_pushdown	= 0;
				$display_text		= "Your information has been successfully Edited";	

			include("includes/_template/_tp_blockform_form_footer.binc.php");		
	
	

		}

include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>	
