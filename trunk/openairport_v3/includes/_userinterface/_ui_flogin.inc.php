<?php
/* FUNCTION flogin()	========================================================================

	Purpose	:	Checks the login form to see if it has been submitted and if so, checks to see 
				if there are any errors in the information and diplay any information correctly.
	
*/	
function flogin($username, $password,$process_login) {

	// Clear Values
	
		$displayform 	= "";
		$tmpusername 	= "";
		$tmppassword 	= "";
		$tmpuserid	 	= "";
		$tmpusernotf 	= "";
		$tmppassnotf 	= "";
		$tmp_showads	= "1";

	// Check to see if the form has been submitted
	
		$tmp_formsubmitted	= $_POST['formsubmited'];		
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
								
								if ($objrs_support) {															// There is a connection to the DB established
										$number_of_rows = mysqli_num_rows($objrs_support);								// Get the number of records that match the search critera
										//printf("result set has %d rows. \n", $number_of_rows);
										while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {			// get information from the record
											$tmpusername 		= $objfields['emp_username'];
											$tmpuserfirstname	= $objfields['emp_firstname'];
											$tmpuserlastname	= $objfields['emp_lastname'];
											$tmppassword 		= $objfields['emp_password'];
											$tmpuserid 			= $objfields['emp_record_id'];
											}
										mysqli_free_result($objrs_support);							// Clear Connection Values
										mysqli_close($objconn_support);								// Clear Connection Values

										if ($_POST['username'] == $tmpusername) {
												// The Users name was found in the database
												$tmpusernotf = "1";
												if ($_POST['password'] == $tmppassword ) {
														// password supplied matches the record found
														$tmppassnotf = "1";
														// both username and password match found record
														$_SESSION["user_id"] = $tmpuserid;
														//echo $_SESSION["user_id"];
														//Tell the system that you have logged in.
														$tmpsqldate		= AmerDate2SqlDateTime(date('m/d/Y'));
														$tmpsqltime		= date("H:i:s");
														$tmpsqlauthor	= $tmpuserid;
														$dutylogevent	= "".$tmpuserfirstname." ".$tmpuserlastname." logged into the Openairport system";
														
														autodutylogentry($tmpsqldate,$tmpsqltime,$tmpsqlauthor,$dutylogevent);
														//Load Navigational Control Menu
														loadnavmenu_3();
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
						<div id="loginbox2">
							<form action="index.php" method="post" name="edittable">
								<input type="hidden" name="formsubmited" value="1">
								<table class="table">
									<tr>
										<td width="90" class="tableheadercenter">
											Try Again
											</td>
										</tr>
									<tr>
										<td>
											<font color="#ff0000" face="arial" size="2"><b>Username / Password not found</b></font>
											</td>
										</tr>						
							<tr>
								<td align="left">					
									<font color="#FFFFFF" face="arial" size="2"><b>username:</b></font><br>
									<input class="commonfieldbox" type="text" 		size="10"	name="username"><br>
									<font color="#FFFFFF" face="arial" size="2"><b>password:</b></font><br>
									<input class="commonfieldbox" type="password"	size="10"	name="password"><br>
									</td>
								</tr>
							<tr>
								<td align="right">
									&nbsp;
									</td>
								</tr>
							<tr>
								<td align="right">
									<input class="formsubmit" type="button" name="button" value="Login" onclick="javascript:document.edittable.submit()">
									</td>
								</tr>
							</table>
						</form>
					</div>
								<?
							}	
					}	// End of Form Submitted Test		
			else {
				// There has been no attempt to submit the login form
				// Allow the user to see the login box as well as the other important information as allowed.
				?>
				<div id="loginbox2" style="z-index:2000;">
					<form action="index.php" method="post" name="edittable">
						<input type="hidden" name="formsubmited" value="1">
						<table class="table">	
							<tr>
								<td width="90" class="tableheadercenter">
									Log In
									</td>
								</tr>						
							<tr>
								<td align="left">					
									<font color="#FFFFFF" face="arial" size="2"><b>username:</b></font><br>
									<input class="commonfieldbox" type="text" 		size="10"	name="username"><br>
									<font color="#FFFFFF" face="arial" size="2"><b>password:</b></font><br>
									<input class="commonfieldbox" type="password"	size="10"	name="password"><br>
									</td>
								</tr>
							<tr>
								<td align="right">
									&nbsp;
									</td>
								</tr>
							<tr>
								<td align="right">
									<input type="submit" class="formsubmit" value="Login">
									<!-- Hidden to allow I.E. to save user name and password, and to allow the use of hitting the enter key to submit form-->
									<!--<input class="formsubmit" type="button" name="button" value="Login" onclick="javascript:document.edittable.submit()">-->
									</td>
								</tr>
							</table>
						</form>
					</div>
				<?
				if ($tmp_showads == "1") {
						?>
						<div style="z-index:1;" >
							<table class="table">
								<tr>
									<td width="90" class="tableheadercenter">
										Learn More 
										</td>
									</tr>
								<tr>
									<td>
										<div class="menu">
											<ul>
												<li class="menuitemselect">
													<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="Info_about" method="POST" action="moreinfo_about.php" target="layouttableiframecontent">
														<a href="#" onclick="javascript:document.Info_about.submit()">About OpenAirport</a>
														</form>
													</li>
												<li class="menuitemselect">
													<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="Info_code" method="POST" action="moreinfo_code.php" target="layouttableiframecontent">
														<a href="#" onclick="javascript:document.Info_code.submit()">Get your Code</a>
														</form>
													</li>
												<li class="menuitemselect">
													<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="Info_forms" method="POST" action="moreinfo_forms.php" target="layouttableiframecontent">
														<a href="#" onclick="javascript:document.Info_forms.submit()">Forms / ScreenShots</a>
														</form>
													</li>
												</ul>
											</div>
										</td>
									</tr>
								</table>
							</div>
						<?						
					}
			}
	}
	?>