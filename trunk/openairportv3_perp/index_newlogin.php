<?php
Session_Start();
$_SESSION['user_id'] = '';
$_SESSION['process_login'] = '';
				
		include("includes/_template/template.list.php");				
				?>
<HTML>
	<HEAD>
		<TITLE>
			</TITLE>			
		<STYLE>
			#wrapper { 
				width:500px; 
				position:absolute; 
				left:50%; 
				maring-left:-250px; 
				}
div.rounded {
    clear:both;
    max-width:2400px;
    margin:5px auto;
    width:95%;
}

div.rounded div.top {
    background:url(images/tl.png) no-repeat bottom left;
    padding:0px;
    width:100%;
}

div.rounded div.top div.right {
    background:url(images/tr.png) no-repeat bottom right;
    height:12px;
    margin-left:12px;
}

div.rounded div.middle {
    background:url(images/l.png) repeat-y left;
    clear:both;
    width:100%;
}

div.rounded div.middle div.right {
    background:url(images/r.png) repeat-y right;
    margin-left:5px;
}

div.rounded div.middle div.right div.content {
    background:url(images/bg.png) repeat top left;
    color:#fff;
    font-family:"Trebuchet MS", Calibri, Tahoma, sans-serif;
    font-size:1.0em;
    line-height:1.3em;
    margin-right:5px;
    padding:0px 7px;
    text-align:justify;
}

div.rounded div.middle div.right div.content p {
    margin:0px;
    padding-top:15px;
}

div.rounded div.middle div.right div.content h2 {
    color:#0f2;
    font-size:1.75em;
    font-weight:bold;
    margin:0px;
    padding:7px 0px;
}

div.rounded div.bottom {
    background:url(images/bl.png) no-repeat top left;
    clear:both;
    padding:0px;
    width:100%;
}

div.rounded div.bottom div.right {
    background:url(images/br.png) no-repeat top right;
    height:12px;
    margin-left:12px;
}
			</STYLE>				
		</HEAD>
	<BODY>
		<?
			// Add Required Includes for Login
		
				include("includes/_globals.inc.php");
				
			// Test to see if this is a cencelled connection from a previouse login
			
				//echo "Default userstate".$_SESSION["user_id"];
			
				if ($_SESSION["user_id"] <> '') {
						// This is not the initial load of this document
						?>
						<table width="80%" align="center" cellpadding="4" cellspacing="4">
							<tr>
								<td align="center" valign="middle">
									<div class="rounded">
										<div class="top">
											<div class="right">
												</div>
											</div>
										<div class="middle">
											<div class="right">
												<div class="content" align="center">						
													<font size="4" color="#FFFFFF" face="arial">
														<p align="center">
														<?
														$tmpsqldate			= AmerDate2SqlDateTime(date('m/d/Y'));
														$tmpsqltime			= date("H:i:s");
														$tmpsqlauthor		= $_SESSION['user_id'];
														$tmpvalue			= systemusercombobox($tmpsqlauthor, "all", "NA", "hide", "no");
														$dutylogevent		= $tmpvalue." logged OUT of the Openairport system";

														autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
														Session_destroy();
														?>
														You have been logged out of the OpenAirport System
														</font>
														</p>
													</div>
												</div>
											</div>
										<div class="bottom">
											<div class="right">
												</div>
											</div>
										</div>
									</td>
								</tr>
							</table>
							<br><br>
						<?
					}
		
			// Clear Values
	
					$displayform 	= "";
					$tmpusername 	= "";
					$tmppassword 	= "";
					$tmpuserid	 	= "";
					$tmpusernotf 	= "";
					$tmppassnotf 	= "";
					$tmp_showads	= "1";
		
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
										// Display error found information
										?>	
		<table border="0" width="80%" id="table1" cellpadding="0" cellspacing="0" align="center" valign="middle">
			<tr>
				<td bgcolor="#00295A" height="40">
					</td>
				<td bgcolor="#00295A" height="40" align="right" valign="middle">
					<font size="3" color="#FFFFFF" face="arial">
						Help
						</font>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			<tr>
				<td bgcolor="#316BAD" height="32" colspan="2" align="left" valign="middle">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<font size="3" color="#FFFFFF" face="arial">
						<b>
							Welcome to OpenAirport.org (Watertown Regional Airport)
							</b>
						</font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="center" valign="middle">
					<br>
					<br>
					<form action="index_newlogin.php" method="post" name="edittable">
					<input type="hidden" name="formsubmited" value="1">
					<table width="80%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td bgcolor="#EFEFF7" height="32" colspan="2" align="left" valign="middle">
								<font size="4" color="#00295A" face="arial">
									&nbsp;&nbsp;Login
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF" height="32" colspan="2" align="left" valign="middle">
								&nbsp;
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF">
								<font size="3" color="#000000" face="arial">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username
									</font>
								</td>
							<td bgcolor="#F7F7FF">
								<font size="3"color="#FF0000" face="arial">
									* <input class="commonfieldbox" type="text" 		size="20"	name="username">
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF" height="32" colspan="2" align="right" valign="middle">
								<font size="3"color="#FF0000" face="arial">
									Your username or password was entered incorrectly&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF">
								<font size="3" color="#000000" face="arial">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password
									</font>
							<td bgcolor="#F7F7FF">
								<font size="3"color="#FF0000" face="arial">
									* <input class="commonfieldbox" type="password"	size="20"	name="password">
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF" height="32" colspan="2" align="right" valign="middle">
								<font size="3"color="#FF0000" face="arial">
									Your username or password was entered incorrectly&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#EFEFF7" height="32" colspan="2" align="right" valign="middle">
								<input type="submit" class="formsubmit" value="Login >>">
								</td>
							</tr>
						</table>
						</form>
					<br>
					<br>
					</td>
				</tr>
			<tr>
				<td bgcolor="#00295A" height="40" colspan="1">
					<font size="3" color="#94ADC6" face="arial">
						&nbsp;&nbsp;&nbsp;Powered by the OpenAirport.org system - Erick Alan Dahl, Version 2.0
						</font>
					</td>
				<td bgcolor="#00295A" height="40" colspan="1">
					<font size="3" color="#94ADC6" face="arial">
						Contact
						</font>
					</td>
				</tr>
			</table>
										<?
									}	
					}	// End of Form Submitted Test		
			else {
				// There has been no attempt to submit the login form
				// Allow the user to see the login box as well as the other important information as allowed.
				?>
		<table border="0" width="80%" id="table1" cellpadding="0" cellspacing="0" align="center" valign="middle">
			<tr>
				<td bgcolor="#00295A" height="40" background="images/header_roller.gif">
					</td>
				<td bgcolor="#00295A" height="40" align="right" valign="middle" background="images/header_roller.gif">
					<a href="help.php">
						<font size="3" color="#94ADC6" face="arial">
							Help
							</font>
						</a>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			<tr>
				<td bgcolor="#316BAD" height="32" colspan="2" align="left" valign="middle">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<font size="3" color="#FFFFFF" face="arial">
						<b>
							Welcome to OpenAirport.org (Watertown Regional Airport)
							</b>
						</font>
					</td>
				</tr>
			<tr>
				<td colspan="2" align="center" valign="middle">
					<br>
					<br>
					<form action="index_newlogin.php" method="post" name="edittable">
					<input type="hidden" name="formsubmited" value="1">
					<table width="80%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td bgcolor="#EFEFF7" height="32" colspan="2" align="left" valign="middle" style="border-width: thin;border-top-style: solid; border-top-color: #B5CEE7;border-bottom-style: solid; border-bottom-color: #B5CEE7">
								<font size="4" color="#00295A" face="arial">
									&nbsp;&nbsp;Login
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF" height="32" colspan="2" align="left" valign="middle">
								&nbsp;
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF">
								<font size="3" color="#000000" face="arial">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username
									</font>
								</td>
							<td bgcolor="#F7F7FF">
								<font size="3"color="#FF0000" face="arial">
									* <input class="commonfieldbox" type="text" 		size="20"	name="username">
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF" height="32" colspan="2" align="left" valign="middle">
								<font size="3"color="#FF0000" face="arial">
									&nbsp;
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF">
								<font size="3" color="#000000" face="arial">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password
									</font>
							<td bgcolor="#F7F7FF">
								<font size="3"color="#FF0000" face="arial">
									* <input class="commonfieldbox" type="password"	size="20"	name="password">
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#F7F7FF" height="32" colspan="2" align="left" valign="middle">
								<font size="3"color="#FF0000" face="arial">
									&nbsp;
									</font>
								</td>
							</tr>
						<tr>
							<td bgcolor="#EFEFF7" height="40" colspan="2" align="right" valign="middle" style="border-width: thin;border-top-style: solid; border-top-color: #B5CEE7;border-bottom-style: solid; border-bottom-color: #B5CEE7">
								<input type="submit" class="formsubmit" value="Login >>">
								</td>
							</tr>
						</table>
						</form>
					<br>
					<br>
					</td>
				</tr>
			<tr>
				<td bgcolor="#00295A" height="40" colspan="1" background="images/header_roller.gif">
					<font size="3" color="#94ADC6" face="arial">
						&nbsp;&nbsp;&nbsp;Powered by the OpenAirport.org system - Erick Alan Dahl, Version 2.0
						</font>
					</td>
				<td bgcolor="#00295A" height="40" colspan="1" align="right" valign="middle" background="images/header_roller.gif">
					<a href="mailto:erick_dahl@hotmail.com">
						<font size="3" color="#94ADC6" face="arial">
							Contact
							</font>
						</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			</table>
			<?
			}
			?>
				
				
		</body>
	</HTML>