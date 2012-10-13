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
//	Name of Document		:	part139303_a_report_user_edit.php
//
//	Purpose of Page			:	Edit Existing Part 139.303(c) Person - You the User
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

		$debug = 0;

// Define Variables	
		
		$navigation_page 			= 4;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 1;							// Page is Type ID, see function for notes!
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
							WHERE emp_record_id = '".$_SESSION['user_id']."' ";
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
									form_new_control("303emails"	,"emails"			, "Enter Emails to contact you"						,"seperate each email with a cama (\,). You can also include your Cell Phone SMS number!"																			,""							,2				,35				,3				,$objarray['emp_emails']				,0);
									form_new_control("303org"		,"Organization"		, "Select your Organization"						,"You may not change your organization"																			,"(cannot be changed)"		,3				,0				,0				,$objarray['emp_organiation_cb_int']	,"organizationcombobox");
									form_new_control("303acesslevel","Access Level"		, "Select your Access Level"						,"You may not change your access rights"																		,"(cannot be changed)"		,3				,0				,0				,$objarray['navigational_groups_id']	,"_ac_accessleveltypecombobox");
									?>
					<table width="100%">
						<tr>
							<td class="formheaders" colspan="4">
								DASH PANEL
								</td>
							</tr>
						<tr>
							<td class="formresults" colspan="4">
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
																			WHERE navigational_user_id_cb_int = '".$_SESSION['user_id']."' AND navigational_group_id_cb_int = '".$dash_id."' ";								
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
					<table width="100%">
						<tr>
							<td class="formheaders" colspan="4">
								Messaging and Emails
								</td>
							</tr>
						<tr>
							<td class="formresults" colspan="4">
								<p>
									You are allowed to have up to <b>five</b> alerts that you will receive text messages or emails from. 
									Under the '<i>Page Name</i>' column you can select the module name you want to be alerted about. Under 
									the '<i>Event Type</i>' coulmn you can select the type of alert you want to be messaged about and under
									the '<i>By Whom</i>' you can select which person you want to be alerted if they cause the action. You 
									may <b>NOT</b> choose to be alerted of all Page Names and any fields below that include 
									"<em>All Modules</em>" will be ignored.  You may choose to be alerted by all events and by all people. If you 
									no longer want to receive alerts from a '<i>Page Name</i>', select "<em>All Modules</em>" from that row
									and click the '<i>Submit Changes</i>' button.
									</p>
								</td>
							</tr>
						<tr>
							<td class="formheaders">
								Page Name
								</td>
							<td class="formheaders">
								Event Type
								</td>
							<td class="formheaders">
								By Whom
								</td>								
							</tr>
								<?php
								$i			= 1;
								// NEED TO LOAD EXISTING MESSAGES AND ALERTS
								$sql2 		= "SELECT * FROM tbl_139_modules_sms 
													WHERE 139_sms_by_int = '".$_SESSION['user_id']."' AND 139_sms_hidden_yn = 0";
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
														
														$sms_id			= $objarray2['139_sms_id_int'];
														$sms_by_id		= $objarray2['139_sms_by_int'];
														$sms_mod_id		= $objarray2['139_sms_module_int'];
														$sms_event_id	= $objarray2['139_sms_event_int'];
														$sms_whom_id	= $objarray2['139_sms_bywhom_int'];
														$sms_hide_id	= $objarray2['139_sms_hidden_yn'];
														
														?>
							<tr>
								<td class="formresults" />
								<INPUT TYPE="hidden" SIZE="3" NAME="<?php echo $i;?>_event_trigger_id" ID="<?php echo $i;?>_event_trigger_id" VALUE="<?php echo $sms_id;?>">
								<?php
								navigationalcombobox_bypage('all', 'no', $i.'_event_trigger_module', 'show', $sms_mod_id);
								?>
							<td class="formresults" />
								<?php
								gs_eventtypeswall('all', 'no', $i.'_event_trigger_event', 'show', $sms_event_id);
								?>
								</td>
							<td class="formresults" />
								<?php
								 systemusercomboboxwall('all', 'no', $i.'_event_trigger_who', 'show', $sms_whom_id);
								?>
								</td>
							</tr>	
														<?php
														$i				= $i + 1;
													}
											}
									}
							
								// DETERMINE HOW MANY MORE ROWS TO MAKE
								$max_rows		= 5;
								$remaing_rows 	= $max_rows - $i;
							
								//echo "There are: ".$i."rows and rows ".$remaing_rows." rows to make <br>";
							
								for ($j=$i; $j<=$max_rows; $j=$j+1) {
									?>
							<tr>
								<td class="formresults" />
								<INPUT TYPE="hidden" SIZE="3" NAME="<?php echo $j;?>_event_trigger_id" ID="<?php echo $j;?>_event_trigger_id" VALUE="new">
								<?php
								navigationalcombobox_bypage('all', 'no', $j.'_event_trigger_module', 'show', 'all');
								?>
							<td class="formresults" />
								<?php
								gs_eventtypeswall('all', 'no', $j.'_event_trigger_event', 'show', 'all');
								?>
								</td>
							<td class="formresults" />
								<?php
								 systemusercomboboxwall('all', 'no', $j.'_event_trigger_who', 'show', 'all');
								?>
								</td>
							</tr>								
										<?php
										}
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
		$username 	= form_new_control("303username"	,"User Name"		, "Enter your User Name"							,"Your username can be edited"																					,""							,1				,0				,0				,'post'			,0);
		$password1	= form_new_control("303password"	,"Password"			, "Enter your Password"								,"Your password can be edited"																					,""							,1				,0				,0				,'post'			,0);
		$password2	= form_new_control("303password2"	,"Password"			, "Confirm your Password"							,"Your passwords must be the same"																				,""							,1				,0				,0				,'post'			,0);
		$emails		= form_new_control("303emails"	,"emails"			, "Enter Emails to contact you"						,"seperate each email with a cama (\,)"																			,""							,2				,0				,0				,'post'			,0);
					form_new_control("303org"		,"Organization"		, "Select your Organization"						,"You may not change your organization"																			,"(cannot be changed)"		,3				,0				,0				,'post'			,"organizationcombobox");
					form_new_control("303acesslevel","Access Level"		, "Select your Access Level"						,"You may not change your access rights"																		,"(cannot be changed)"		,3				,0				,0				,'post'			,"_ac_accessleveltypecombobox");
	
		// Strip Input
			
			
	
		// DO UPDATE OF MAIN TABLE HERE
		
		$sql = "UPDATE tbl_systemusers SET emp_username='".$username."', emp_password='".$password1."', emp_emails='".$emails."' WHERE emp_record_id = ".$_SESSION['user_id']." ";
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
							<td class="formheaders" colspan="4">
								DASH PANEL
								</td>
							</tr>
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
															
															$formvalued = sanatize_inputs($formvalued);
															
															$formvalue	= "dashpri_".$dash_id;
															$formvaluep	= $_POST[$formvalue];
															
															$formvaluep = sanatize_inputs($formvaluep);													
															
															
															
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
																			WHERE navigational_user_id_cb_int = '".$_SESSION['user_id']."' AND navigational_group_id_cb_int = '".$dash_id."' ";								
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
																					VALUES ( '".$_SESSION['user_id']."', '".$dash_id."', '".$formvalued."', '".$formvaluep."' )";
																
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
					<table width="100%">
						<tr>
							<td class="formheaders" colspan="4">
								Messaging and Emails
								</td>
							</tr>
						<tr>
							<td class="formheaders">
								Page Name
								</td>
							<td class="formheaders">
								Event Type
								</td>
							<td class="formheaders">
								By Whom
								</td>								
							</tr>
							<?php
							
							for ($j=1; $j<6; $j=$j+1) {
								
									$error = 1;
									
									// ASSEMBLE FIELD NAMES
									$trigger_id		= $j."_event_trigger_id";
									$trigger_mod	= $j."_event_trigger_module";
									$trigger_event	= $j."_event_trigger_event";
									$trigger_whom	= $j."_event_trigger_who";
									
									$tmp_t_id		= $_POST[$trigger_id];
									$tmp_t_mod		= $_POST[$trigger_mod];
									$tmp_t_evt		= $_POST[$trigger_event];
									$tmp_t_whom		= $_POST[$trigger_whom];
									
									if($tmp_t_id == 'new') {
											$id = 'new';
										} else {
											$id = $tmp_t_id;
										}
									
									
									if($tmp_t_evt == 'all') {
											// USER SELECTED ALL EVENTS COMPENSATING....
											$event_field 	= '139_sms_event_txt';
											$event_default 	= 'all';
											$event_fieldc	= '139_sms_event_int';
											$event_defaultc = 0;
										} else {
											$event_field 	= '139_sms_event_int';
											$event_default 	= $tmp_t_evt;
											$event_fieldc	= '139_sms_event_txt';
											$event_defaultc = '';
										}
										
									if($tmp_t_whom == 'all') {
											// USER SELECTED ALL EVENTS COMPENSATING....
											$whom_field 	= '139_sms_bywhom_txt';
											$whom_default 	= 'all';
											$whom_fieldc	= '139_sms_bywhom_int';
											$whom_defaultc 	= 0;
										} else {
											$whom_field 	= '139_sms_bywhom_int';
											$whom_default 	= $tmp_t_whom;
											$whom_fieldc	= '139_sms_bywhom_txt';
											$whom_defaultc 	= '';
										}
									
									if($_POST[$trigger_mod] == 'all') {
											// User has All Modules selected. Maybe this is an attempt to delet an alert?
											if($_POST[$trigger_id] == 'new') {
													// THIS IS A REQUEST FOR A NEW ROW, BUT ALL IS SELECTED IGNORE IT
													
													//echo "Module selected is all, and is a new row. Reject input";
													$error = 1;
													
												} else {
													// USER HAS AN ID HERE AND HAS SELECTED ALL MODULES ON PURPOSE.
													//	UPDATE RECORD AND HIDE IT SO USER WONT SEE IT ANYMORE.
													
													//echo "Achiving record id: ".$_POST[$trigger_id]." <br>";
													
													$sql2 = "UPDATE tbl_139_modules_sms SET 139_sms_hidden_yn = 1 WHERE 139_sms_id_int = '".$tmp_t_id."' "; 
													
													//echo "SQL Statement is: ".$sql2." <br>";
													
													$error = 0;
												
												}
										} else {
											// USER HAS SELECTED A SPECIFIC MODULE. CHECK IF ITS NEW OR NOT.
											if($_POST[$trigger_id] == 'new') {
													// THIS IS A REQUEST FOR A NEW ROW, INSERT ROW
													
													//echo "Module selected and row is new. Insert Row.";
													
													$sql2 = "INSERT INTO tbl_139_modules_sms (139_sms_by_int, 139_sms_module_int, ".$event_field.", ".$whom_field.", 139_sms_hidden_yn) 
																VALUES ( '".$_SESSION['user_id']."', '".$tmp_t_mod."', '".$event_default."', '".$whom_default."', 0 )";
													
													//echo "SQL Statement is: ".$sql2." <br>";
													
													$error = 0;
													
												} else {
													// This is a request to update a row with new information
													
													//echo "Updating record id: ".$_POST[$trigger_id]." <br>";
													
													$sql2 = "UPDATE tbl_139_modules_sms SET 139_sms_module_int='".$tmp_t_mod."', 
																".$event_field."='".$event_default."', 
																".$whom_field."='".$whom_default."',  
																".$event_fieldc."='".$event_defaultc."',
																".$whom_fieldc."='".$whom_defaultc."' 
															WHERE 139_sms_id_int = '".$tmp_t_id."' "; 
													
													//echo "SQL Statement is: ".$sql2." <br>";
																										
													$error = 0;
												
												}	
										}

									if($error == 1) {
											// Do nothing
											//echo "There was an error with your request <br>";
											$lastid = 'new';
										} else {
											
											$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
																		//mysql_insert_id();
																		
											if (mysqli_connect_errno()) {
													// there was an error trying to connect to the mysql database
													printf("connect failed: %s\n", mysqli_connect_error());
													exit();
												}		
												else {
												//mysql_insert_id();
													$objrs = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));
													$lastid = mysqli_insert_id($mysqli);
												}	
										}
							
								if($tmp_t_mod == 'all') {
										// Display Nothing
									} else {
										?>
							<tr>
								<td class="formresults" />
								<INPUT TYPE="hidden" SIZE="3" NAME="<?php echo $trigger_id;?>" ID="<?php echo $trigger_id;?>" VALUE="<?php echo $lastid;?>">
								<?php
								if($tmp_t_mod == 'all') {
										echo "all";
								} else {
								navigationalcombobox_bypage($tmp_t_mod, 'no', $trigger_mod, 'hide', $tmp_t_mod);
								}
								?>
							<td class="formresults" />
								<?php
								if($event_default == 'all') {
										echo "all";
								} else {
								gs_eventtypeswall($event_default, 'no', $trigger_event, 'hide', $event_default);
								}
								?>
								</td>
							<td class="formresults" />
								<?php
								if($whom_default == 'all') {
										echo "all";
								} else {								
								 systemusercomboboxwall($whom_default, 'no', $trigger_whom, 'hide', $whom_default);
								}
								?>
								</td>
							</tr>								
									<?php
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
		
		$last_main_id	= $_SESSION['user_id'];
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $_POST["formsubmit"], $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>