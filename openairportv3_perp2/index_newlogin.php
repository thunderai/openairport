<?php
Session_Start();
$_SESSION['user_id'] 		= '';
$_SESSION['process_login'] 	= '';
$errorfound					= 0;
			
include('includes/_template/template.list.php');				
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
	<HEAD>
		<TITLE>
			OpenAirport: User Login
			</TITLE>
		<?php
		include('stylesheets/_css.inc.php');
		include('includes/gs_config.php');
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		</HEAD>
	<BODY style="margin:0px;" />
		<?
		// Add Required Includes for Login
	
			include('includes/_globals.inc.php');
		
			if ($_SESSION["user_id"] <> '') {
					// echo "This is not the initial load of this document <br>";
					// echo "Destroy the session variables and log the user out <bR>";
					$tmpsqldate			= AmerDate2SqlDateTime(date('m/d/Y'));
					$tmpsqltime			= date("H:i:s");
					$tmpsqlauthor		= $_SESSION['user_id'];
					$tmpvalue			= systemusercombobox($tmpsqlauthor, "all", "NA", "hide", "no");
					$dutylogevent		= $tmpvalue." logged OUT of the Openairport system";

					autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
					Session_destroy();
					
					$errorfound = 1;
					$message 	= $dutylogevent;
					include('includes/_userinterface/_ui_bloginscreen.binc.php');
				}
		
			// Clear Values
	
					$displayform 	= '';
					$tmpusername 	= '';
					$tmppassword 	= '';
					$tmpuserid	 	= '';
					$tmpusernotf 	= '';
					$tmppassnotf 	= '';
					$tmp_showads	= '1';
		
			// Check to see if the form has been submitted
				
				if (!isset($_POST["formsubmited"])) {
						// There is no POST information....It does not exist!
						$tmp_formsubmitted = 0;
					} else {
						$tmp_formsubmitted	= $_POST['formsubmited'];
					}
					
				//echo "form submitted |".$tmp_formsubmitted."|";
				
				if ($tmp_formsubmitted=="1") {
						// Form has been submitted, now do the dirty work of checking the information 
						// that was entered by the user.

						// Create Connection to Database
						$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
								if (mysqli_connect_errno()) {
										printf("connect failed: %s\n", mysqli_connect_error());
										exit();
									}
									else {
										$sql = "SELECT * FROM tbl_systemusers WHERE emp_username = '".$_POST['username']."'";
										$objrs_support = mysqli_query($objconn_support, $sql);
										
										if ($objrs_support) {																	// There is a connection to the DB established
												$number_of_rows = mysqli_num_rows($objrs_support);								// Get the number of records that match the search critera
												//printf("result set has %d rows. \n", $number_of_rows);
												while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {			// get information from the record
													$tmpusername 			= $objfields['emp_username'];
													$tmpuserfirstname		= $objfields['emp_firstname'];
													$tmpuserlastname		= $objfields['emp_lastname'];
													$tmppassword 			= $objfields['emp_password'];
													$tmpuserid 				= $objfields['emp_record_id'];
													}
												mysqli_free_result($objrs_support);												// Clear Connection Values
												mysqli_close($objconn_support);													// Clear Connection Values

												if ($_POST['username'] == $tmpusername) {
														// The Users name was found in the database
														$tmpusernotf = "1";
														if ($_POST['password'] == $tmppassword ) {
																// password supplied matches the record found
																$tmppassnotf = "1";
																// both username and password match found record
																$_SESSION["user_id"] = $tmpuserid;
																echo "Session ID: ".$_SESSION["user_id"]."<br>";
																//Tell the system that you have logged in.
																$tmpsqldate			= AmerDate2SqlDateTime(date('m/d/Y'));
																$tmpsqltime			= date("H:i:s");
																$tmpsqlauthor		= $tmpuserid;
																$dutylogevent		= "".$tmpuserfirstname." ".$tmpuserlastname." logged into the Openairport system";
																autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
																//Load Navigational Control Menu
																//loadnavmenu();
																
																// Forward user to the correct page since they have passed the required tests
																?>
																<form name="redirect" action="index.php" method="POST">
																<input class="combobox" type="hidden" size="1" name="redirect2">
																<input class="combobox" type="hidden" size="1" name="systemuserid" value="<?php echo $tmpuserid;?>">
																<script>
																	<!--
																		var targetURL="index.php"
																		var countdownfrom=1
																		var currentsecond=document.redirect.redirect2.value=countdownfrom+1
																		function countredirect(){
																			if (currentsecond!=1){
																				currentsecond-=1
																				document.redirect.redirect2.value=currentsecond
																				}
																				else{
																					document.redirect.submit();
																			return
																			}
																			setTimeout("countredirect()",0)
																			}
																			countredirect()
																	//-->
																	</script>
																	</form>
																<?
															}
															else {													// Password suplied was not correct
																$errorfound	= 1;			
															}					
													}
													else {															// Username was not found in records
														$errorfound	= 1;
													}
											}	//	End of active connection object
									}	//	End of Connection Established									
								if ($errorfound==1) {
										// echo "There were errors found in the user's name or password <br>";
										// echo "Notify the user there were errors and ask for login information again <br>";
										$message = 'There was an error with the information you provided for your username or password <br>
													Please check your information and login. If you continue to have problems please contact the system administrator';
										include('includes/_userinterface/_ui_bloginscreen.binc.php');

									}	
					}	// End of Form Submitted Test		
			else {
				// echo "There has been no attempt to submit the login form <br>";
				// echo "Allow the user to see the login box as well as the other important information as allowed.<br>";
				$message = '';
				include('includes/_userinterface/_ui_bloginscreen.binc.php');
			}
			?>
		</body>
	</HTML>