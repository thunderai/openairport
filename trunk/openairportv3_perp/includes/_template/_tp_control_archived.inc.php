<?php
//
// The purpose of this code is to display the Archived Code
function _tp_control_archived($tblkeyfield, $settingsarray, $functionpage) {

$icons_width = '25';
$icons_height = '25';
//$settingsarray 	= array("SELECT * FROM tbl_139_327_sub_d_a WHERE discrepancy_archeived_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_archived.php");
//$functionpage	= "part139327_discrepancy_report_archieved.php";	

		if ($settingsarray == '') {
				// No information about this control, do not display it
			}
			else {
				// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
				// ARCHIEVED CONTROLS ($settingsarray)
				// -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - -= DC = - 
				
				$sql2 = $settingsarray[0]."'".$tblkeyfield."' ";
				$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$objrs2 = mysqli_query($objconn2, $sql2);

						if ($objrs2) {
								$number_of_rows = mysqli_num_rows($objrs2);
								if ($number_of_rows == 0) {
										// There are no records to display, display NRF
										$button_name 	= 'Mark Archieved';	
										$image_name		= 'icon_archit';
										$form_name		= 'AchievedOrderReportForm';
										$active			= 1;
										$value			= $button_name;
										$random_element = rand(0,10000);
										$window_name	= preg_replace('/\s+/', '', $button_name);
										$window_name	= $window_name."_".$form_name."_".$random_element;
										$button_name	= $button_name."_".$random_element."";
										$window_command	= 'open_new_littleform_window';
										$form_action	= $functionpage;
										$disid			= $tblkeyfield;
										
										include('includes/_template/_tp_blockform_work_button.binc.php');

									}
									else {
										// There are records to display, display control.
										while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {
												$tmpid = $objarray2[$settingsarray[1]."_archeived_id"];
												$button_name 	= 'Archived History';	
												$image_name		= 'icon_archhistory';
												$form_name		= 'ArchivedHistoryReportForm';
												$active			= 1;
												$value			= $button_name;
												$random_element = rand(0,10000);
												$window_name	= preg_replace('/\s+/', '', $button_name);
												$window_name	= $window_name."_".$form_name."_".$random_element;
												$button_name	= $button_name."_".$random_element."";
												$window_command	= 'open_new_report_window';
												$form_action	= $settingsarray[2];
												$disid			= $tblkeyfield;
										
												include('includes/_template/_tp_blockform_work_button.binc.php');									
											}
									}
							}
					}
			}	// End of Archived Controls	
	}