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
		include("includes/gs_config.php");
		
// Load Page Specific Includes

		//include("includes/_modules/part139337/part139337.list.php");
		include("includes/_template_enter.php");
		include("includes/_template/template.list.php");
		
// Load Page Specific Includes

		include("includes/_modules/part139327/part139327.list.php");

// Define Variables	
		
		$navigation_page 			= 36;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 16;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
		//	Do NOT Display Breadcrum report on this page...
	
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
			$form_menu			= "Enter New Persons";											// Name of the FORM, shown to the user
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
			form_new_control("303firstname"	,"First Name"		, "Enter your First Name"							,"You may not change your name, sorry"																			,""							,1				,35				,0				,''										,0);
			form_new_control("303lastname"	,"Last Name"		, "Enter your Last Name"							,"You may not change your name, sorry"																			,""							,1				,35				,0				,''										,0);
			form_new_control("303initials"	,"Initials"			, "Enter your initials"								,"You may not change this, sorry"																				,""							,1				,35				,0				,''										,0);
			form_new_control("303username"	,"User Name"		, "Enter your User Name"							,"Your username can be edited"																					,""							,1				,35				,0				,''										,0);
			form_new_control("303password"	,"Password"			, "Enter your Password"								,"Your password can be edited"																					,""							,1				,35				,0				,''										,0);
			form_new_control("303password2"	,"Password"			, "Confirm your Password"							,"Your passwords must be the same"																				,""							,1				,35				,0				,''										,0);
			form_new_control("303org"		,"Organization"		, "Select your Organization"						,"You may not change your organization"																			,""							,3				,35				,0				,'all'									,"organizationcombobox");
			form_new_control("303acesslevel","Access Level"		, "Select your Access Level"						,"You may not change your access rights"																		,""							,3				,35				,0				,'all'									,"_ac_accessleveltypecombobox");
			
			// Build List of all DashPanel Items
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" />
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
						<INPUT TYPE="checkbox" NAME="dashdsp_<?php echo $dash_id;?>" ID="dashdsp_<?php echo $dash_id;?>" VALUE="1" >
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
							<option value=<?php echo $i;?>" <?php echo $default;?>/><?php echo $i;?></option>
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
//
// FORM FOOTER
//------------------------------------------------------------------------------------------\\
		$display_submit 		= 1;														// 1: Display Submit Button,	0: No
			$submitbuttonname	= 'Submit Changes';											// Name of the Submit Button
		$display_close			= 0;														// 1: Display Close Button, 	0: No
		$display_pushdown		= 0;														// 1: Display Push Down Button, 0: No
		$display_refresh		= 0;														// 1: Display Refresh Button, 	0: No
		$display_quickaccess	= 1;
		
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
		form_new_table_b($formname);
		form_new_control("303firstname"	,"First Name"		, "Enter your First Name"							,"You may not change your name, sorry"																			,"(cannot be changed)"		,1				,0				,0				,"post"			,0);
		form_new_control("303lastname"	,"Last Name"		, "Enter your Last Name"							,"You may not change your name, sorry"																			,"(cannot be changed)"		,1				,0				,0				,'post'			,0);
		form_new_control("303initials"	,"Initials"			, "Enter your initials"								,"You may not change this, sorry"																				,"(cannot be changed)"		,1				,0				,0				,'post'			,0);
		form_new_control("303username"	,"User Name"		, "Enter your User Name"							,"Your username can be edited"																					,""							,1				,0				,0				,'post'			,0);
		form_new_control("303password"	,"Password"			, "Enter your Password"								,"Your password can be edited"																					,""							,1				,0				,0				,'post'			,0);
		form_new_control("303password2"	,"Password"			, "Confirm your Password"							,"Your passwords must be the same"																				,""							,1				,0				,0				,'post'			,0);
		form_new_control("303org"		,"Organization"		, "Select your Organization"						,"You may not change your organization"																			,"(cannot be changed)"		,3				,0				,0				,'post'			,"organizationcombobox");
		form_new_control("303acesslevel","Access Level"		, "Select your Access Level"						,"You may not change your access rights"																		,"(cannot be changed)"		,3				,0				,0				,'post'			,"_ac_accessleveltypecombobox");
	
		// INSERT NEW Records OF MAIN TABLE HERE
		
		$sql = "INSERT INTO tbl_systemusers (emp_firstname, emp_lastname, emp_initials, emp_username, emp_password, emp_organiation_cb_int, emp_addedon_date, emp_addon_time ) VALUES
											('".$_POST['303firstname']."', '".$_POST['303lastname']."', '".$_POST['303initials']."', '".$_POST['303username']."', '".$_POST['303password']."', '".$_POST['303org']."', '".date('Y-m-d')."', '".date('H:i:s')."' )";

		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs 		= mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$person_id 	= mysqli_insert_id($mysqli);
						}

						
		// INSERT NEW Access Level REcord into Table
		
		$sql = "INSERT INTO tbl_systemusers_ncga (navigational_user_id_cb_int, navigational_group_id_cb_int ) VALUES
												('".$person_id."', '".$_POST['303acesslevel']."' )";

		$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		//mysql_insert_id();
				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs 		= mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
						$access_id 	= mysqli_insert_id($mysqli);
						}		
						
						
						
						
						
		// Now to do what we did before with the Dash Checklists, but we will have update issues and INSERT issues. 
	
		?>
			<table width="100%">
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
																			WHERE navigational_user_id_cb_int = '".$person_id."' AND navigational_group_id_cb_int = '".$dash_id."' ";								
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
																					VALUES ( '".$person_id."', '".$dash_id."', '".$formvalued."', '".$formvaluep."' )";
																
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
		//
		// Load Footer
				$display_submit 	= 0;
				$display_close 		= 0;
				$display_refresh	= 0;
				$display_pushdown	= 0;
				$display_text		= "Your information has been successfully Edited";	

			include("includes/_template/_tp_blockform_form_footer.binc.php");		
	
	

		}

// Establish Page Variables

		if (!isset($last_main_id)) {
				$last_main_id	= "-";	// NO Useable ID
			} else {
				$last_main_id	= $person_id;													//  THe ID to display!!!
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