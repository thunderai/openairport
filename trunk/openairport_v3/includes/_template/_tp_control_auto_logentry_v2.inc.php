<?php
//
// The purpose of this code is to add entries to the daily log routine
function ae_completepackage($settingsarray) {
	
		$start_time = microtime();
		
		// Settingsarray is:
		//							0				, 1						, 2						, 3						, 4						, 5				, 6
		//$settingsarray	= array($navigation_page, $_SESSION["user_id"]	, $_POST["formsubmit"]	, $date_to_display_new	, $time_to_display_new	, $type_page	,$last_main_id); 

		$navigation_page			= $settingsarray[0];
		$user_id					= $settingsarray[1];
		$form_submmit				= $settingsarray[2];
		$date_to_display_new		= $settingsarray[3];
		$time_to_display_new 		= $settingsarray[4];
		$page_type					= $settingsarray[5];
		$main_id					= $settingsarray[6];
		$force_message				= $settingsarray[7];

//		... Navigational Page ($navigation_page)
//				
//				ID		Modules
//				-------	--------------------------------------------------------------------------
//				3		14 CFR Part 139.301 Records	301	Menu Root Item		1	0
//				4		14 CFR Part 139.303 Personnel	303	Menu Root Item		1	0
//				36		14 CFR Part 139.303 Personnel (a)	303 (a)	Menu Structure for 14 CFR Part 139.303 Personnel (...	4	0	0
//				37		14 CFR Part 139.303 Personnel (c)	303 (c)	Menu Structure for 14 CFR Part 139.303 Personnel (...	4	0	0
//				5		14 CFR Part 139.305 Paved Areas	305	Menu Root Item		1	0
//				6		14 CFR Part 139.307 Unpaved Areas	307	Menu Root Item		1	0
//				7		14 CFR Part 139.309 Safety Areas	309	Menu Root Item		1	0
//				8		14 CFR Part 139.311 Marking, Signs, and Lighting	311	Menu Root Item		1	0
//				9		14 CFR Part 139.313 Snow and Ice Control	313	Menu Root Item		1	0
//				10		14 CFR Part 139.315 Aircraft Rescue and Firefighti...	315	Menu Root Item		1	0
//				11		14 CFR Part 139.317 Aircraft Rescue and Firefighti...	317	Menu Root Item		1	0
//				12		14 CFR Part 139.319 Aircraft Rescue and Firefighti...	319	Menu Root Item		1	0
//				13		14 CFR Part 139.321 Handling and storing of hazard...	321	Menu Root Item		1	0
//				14		14 CFR Part 139.323 Traffic and Wind Direction Ind...	323	Menu Root Item		1	0
//				15		14 CFR Part 139.325 Airport Emergency Plan	325	Menu Root Item		1	0
//				16		14 CFR Part 139.327 Self-Inspection Program	327	Menu Root Item		1	0
//				17		14 CFR Part 139.329 Pedestrians and ground vehicle...	329	Menu Root Item		1	0
//				18		14 CFR Part 139.331 Obstructions	331	Menu Root Item		1	0
//				19		14 CFR Part 139.333 Protection of NAVAIDS	333	Menu Root Item		1	0
//				20		14 CFR Part 139.335 Public Protection	335	Menu Root Item		1	0
//				21		14 CFR Part 139.337 Wildlife Hazard Management	337	Menu Root Item		1	0
//				39		14 CFR Part 139.339 (b) Airport condition reportin...	339 (b)	Menu Structure for 14 CFR Part 139.303 (b) Airport...	22	0	0
//				40		14 CFR Part 139.339 (c) Airport condition reportin...	339 (c)	Menu Structure for 14 CFR Part 139.339 (c) Airport...	22	0	0
//				22		14 CFR Part 139.339 Airport Condition Reporting	339	Menu Root Item		1	0
//				23		14 CFR Part 139.341 Identifying, marking, and ligh...	341	Menu Root Item		1	0
//				24		14 CFR Part 139.343 Noncomplying conditions	343	Menu Root Item		1	0

//		... Page Type ($page_type)
//
//				ID		Module
//				------- ------------------------------------------
//				11		Display Calendar			0
//				12		Display Linechart			0
//				13		Display Map					0
//				10		Display Printer Printout	0
//				3		Display Report				0
//				17		Display Report - Archived	0
//				19		Display Report - Bounced	0
//				20		Display Report - Closed		0
//				21		Display Report - Duplicate	0
//				22		Display Report - Error		0
//				23		Display Report - Repaired	0
//				24		Display Report - Workorder	0
//				4		Mark Archived				0
//				8		Mark Bounced				0
//				9		Mark Closed					0
//				6		Mark Duplicated				0
//				7		Mark Repaired				0
//				5		Mark with Error				0
//				15		Records - Browse			0
//				1		Records - Edit				0
//				14		Records - Export			0
//				16		Records - New				0
//				2		Summary Report				0	
//				18		Form Loader					0
//				0		all - stored in txt field not the int column

//		... Form Submit Type ($form_submmit)
//
//				ID		Defined
//				-------	-----------------------------------------------
//				1		Form has been submitted
//				{else}	Form has NOT been submitted


		// Step One, What is the current Stage of the Form?
		
				if($force_message == '') {
						
						// Then do default naming scheme
		
						$username 		= systemusertextfield($user_id, 'all', 'notused', 'hide', $user_id);
						$page_module	= getnameofmenuitemid_return_nohtml($navigation_page, 'long', 'notused', 'hide', $navigation_page);
						$page_event_n	= gs_eventtypes_silent($page_type, 'all', 'notused', 'hide', $tmp_evt_id_int);
						
						$message_to_display_new 	= $username." has opened a new ".$page_module." - ".$page_event_n." form";
						$message_to_display_submit	= $username." has saved a ".$page_module." - ".$page_event_n." form ID ([id])";
				
						switch($form_submmit) {
								case 1:			// Submited
									$message = $message_to_display_submit;
									// replace known string tags with variables
									//$message = str_replace('[user]',$username,$message);
									$message = str_replace('[id]',$main_id,$message);
									break;
								default:		// Not submitted
									$message = $message_to_display_new;
									// replace known string tags with variables
									//$message = str_replace('[user]',$username,$message);
									break;
							}
					} else {
					
						$message = $force_message;

				}
		
		// Step Two, submit record into database
		
				$sql = "INSERT INTO tbl_duty_log (duty_log_comments,duty_log_by_cb_int,duty_log_date,duty_log_time) VALUES ('".$message."', '".$user_id."', '".$date_to_display_new."', '".$time_to_display_new."')";
				$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
					
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
					//mysql_insert_id();
						$objrs_support 	= mysqli_query($objconn_support, $sql) or die(mysqli_error($objconn_support));
						$lastid		 	= mysqli_insert_id($objconn_support);
						mysqli_close($objconn_support);
						}
		
		// Step Three, Does anyone care?
		//	Loop through all SMS records, looking for a possible match

				$sql 	= "SELECT * FROM tbl_139_modules_sms 
							INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_139_modules_sms.139_sms_module_int 
							WHERE 139_sms_hidden_yn = 0";
				
				$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

				//mysql_insert_id();
						
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
								//mysql_insert_id();
								$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
								while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
										$alert = 0;
										
										// We now are inside each record of each type of condition that is part of the selected checklist, now we need to add a new record to another table for each of these records.
										// That means establishing a new connection to the database while this one is still open.
										$tmp_id 		= $objfields['139_sms_id_int'];
										$tmp_by			= $objfields['139_sms_by_int'];
										$tmp_mod_id_int	= $objfields['139_sms_module_int'];
										$tmp_evt_id_int	= $objfields['139_sms_event_int'];
										$tmp_who_id_int	= $objfields['139_sms_bywhom_int'];
										$tmp_evt_id_txt	= $objfields['139_sms_event_txt'];
										$tmp_who_id_txt	= $objfields['139_sms_bywhom_txt'];
										
										$tmp_mod_name_l	= $objfields['menu_item_name_long'];
										$tmp_mod_name_s	= $objfields['menu_item_name_short'];
										$tmp_mod_name_p	= $objfields['menu_item_purpose'];
										
										$send_alert		= 0;
										$test_user		= 0;
										$test_event		= 0;			// Not Used
										
										//echo "Loop through SMS record checks <br>";
										//echo "Does this SMS record care about the module <br>";
										//echo " [1.0] Navigation Page : ".$navigation_page." <br>";
										//echo " [1.1] SMS Record Module : ".$tmp_mod_id_int." <br>";
										//echo " [1.2] Is the Navigation Page and SMS Record Module the same ? <br>";
										
										if($navigation_page == $tmp_mod_id_int) {
										
												//echo " [1.3] Values are the same continue with records check <br>";
												
												//echo " [2.0] Check EVENT trigger. <br>";
												//echo " [2.1] Does the SMS records check care about all events or a event type <br>";
												//echo " [2.2] Event Type ID : ".$page_type." <br> ";
												//echo " [2.3] SMS Records Event : ".$tmp_evt_id_int." <br>";
												//echo " [2.4] Are the Event Type and SMS Record Type the same? <br>";
												
												$alert = "A module has had activity that meets your search criteria. ";
												$alert = $alert." Module (".$tmp_mod_name_l.") ";
												
												if($tmp_evt_id_int == 0) {
													
														//echo " [2.5] The SMS Record Event Check wants all events. <br>";
														
														$alert 		= $alert." Any Event ";
														$send_alert = 1;
														$test_user	= 1;
														
														// Test SMS Record User Check...
														
													} else {
														
														//echo " [2.6] The SMS Record Event Check wants to match one event only. <br>";
														
														if($tmp_evt_id_int == $page_type) {
																
																//echo " [2.7] The SMS Record Event Check is the same as the Page Event. <br>";
																
																$event_id 	= gs_eventtypes_silent($tmp_evt_id_int, 'all', 'notused', 'hide', $tmp_evt_id_int);
																$alert 		= $alert." Event (".$event_id.")";
																$send_alert = 1;
																$test_user	= 1;
																
																// Test SMS Record User Check...
																
															} else {
																
																//echo " [2.8] The SMS Record Event Check is NOT the same as the Page Event. <br>";
																
																$send_alert = 0;
																$test_user	= 0;
																
																// DO NOT Test SMS Record User Check...
															}
													
													}
												
												if($test_user == 0) {
														
														// Do NOTHING
													
													} else {
												
														//echo " [3.0] Does the SMS Records Check care about this user or all users <br>";
														//echo " [3.1] Current User :".$user_id." <br>";
														//echo " [3.2] SMS Records User Check : ".$tmp_who_id_int." <br>";
														//echo " [3.3] Are the Current User and the SMS REcords User Check the same? <br>";
														
														if($tmp_who_id_int == 0) {
															
																//echo " [3.4] The SMS Record User Check wants all Users. <br>";
																
																$alert 		= $alert." By Anyone ";
																$send_alert = 1;
																
															} else {
																
																//echo " [3.5] The SMS Record User Check wants to match one User only. <br>";
																
																if($tmp_who_id_int == $user_id) {
																		
																		//echo " [3.6] The SMS Record User Check is the same as the Current User. <br>";
																		
																		$by_whom 	= systemusertextfield($tmp_who_id_int, 'all', 'notused', 'hide', $tmp_who_id_int);
																		$alert 		= $alert." By (".$by_whom.") ";
																		$send_alert = 1;
																		
																	} else {
																		
																		//echo " [3.7] The SMS Record User Check is NOT the same as the Current User. <br>";
																		
																		$send_alert = 0;
																	}
															
															}
													}
												
											} else {
												
												//echo " [1.4] Values are NOT the same, skip the records check <br>";
												
												$send_alert = 0;
										
											}
											
										if($send_alert == 1) {	
										
												//echo "Message is: ".$message." <br>";
												//echo "Alert Message is: ".$alert." <br>";	
												//echo "Need to send email to user of this SMS message <br>";
												//echo "Getting User email addresses <br>";
												$tmp_emails = systemusertextfield_emails($tmp_by, 'all', 'notused', 'hide', $tmp_by);
												//echo "Split emails by a ',' <br>";
												$tmp_emails_array = explode(',',$tmp_emails);
												$tmp_emails_count = count($tmp_emails_array);
												//echo "There are ".$tmp_emails_count." elements in the array <br>";
												
												
												$subject 	= "OA: Message Alert";
												$body 		= $alert;
												$headers	= "From: Open Airport <airport@watertownsd.us>";
												
												for($i=0; $i<$tmp_emails_count; $i=$i+1) {
														
														if($tmp_by != $tmp_who_id_int) {
															
																//echo "email is [".$tmp_emails_array[$i]."] <br>";
															
																sendreportbyemail($tmp_emails_array[$i],$subject,$body,$headers);
															}
												
													}
											}
									}
							}


		
		$end_time = microtime();
		$all_time = ($end_time - $start_time);
		//echo "Function took [".$all_time."] milli seconds <br>";
	}
?>