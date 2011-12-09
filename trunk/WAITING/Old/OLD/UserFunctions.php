<?
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	UserFunctions.php
//
//	Purpose of Page		:	This document contains the functions required to allow access into
//							the system as well as functions used to create comboboxes dealing
//							with people who have access to the system (tbl_system_users)
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		

/* FUNCTION flogheader()	====================================================================

	Purpose	:	Checks to see if there is a value in the session variable ["user_id"], and 
				depending on if there is or not displayes different header buttons associated
				for that user.
*/
function flogheader($user) {

	if ($_SESSION["user_id"] == "") {
			// There is no value in the session variable
			?>
			<?
			}
		else {
			?>
<table border="0" id="table3" cellspacing="2" cellpadding="0" width="100%">
	<tr>
		<td id="login" 		onMouseOver="this.bgColor='#6D84B4' " onMouseOut="this.bgColor='#3B5998'" onclick="window.location='newlogin.php'" 										style="cursor:hand;"><img src="stylesheets/_cssimages/icon_logout.gif" 		height="25" alt="Logout!"></td>
		<td id="lregister" 	onMouseOver="this.bgColor='#6D84B4' " onMouseOut="this.bgColor='#3B5998'" onclick="loadintoIframe('layouttableiframecontent', '_suc_usersettings.php')" style="cursor:hand;"><img src="stylesheets/_cssimages/icon_settings.gif" 	height="25" alt="Settings!"></td>
		<td id="help" 		onMouseOver="this.bgColor='#6D84B4' " onMouseOut="this.bgColor='#3B5998'" onclick="loadintoIframe('layouttableiframecontent', '_suc_help.php')"			style="cursor:hand;"><img src="stylesheets/_cssimages/icon_help.gif" 		height="25" alt="Help!"></td>
		</tr>
	</table>
			<?
		}
	}



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
				$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
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
											$tmpuserlastname		= $objfields['emp_lastname'];
											$tmppassword 		= $objfields['emp_password'];
											$tmpuserid 		= $objfields['emp_record_id'];
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
														$tmpsqlauthor		= $tmpuserid;
														$dutylogevent		= "".$tmpuserfirstname." ".$tmpuserlastname." logged into the Openairport system";
														
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
		
	

function fwelcomebox($user) {

	if ($_SESSION["user_id"] == "") {
			?>
			<font color="#ffffff" face="arial narrow" size="2">welcome to the open airport record keeping system</font>
			<?
			}
		else {
			
				$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
				if (mysqli_connect_errno()) {
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					else {
						$sql = "select * from tbl_systemusers where emp_record_id = '".$_SESSION["user_id"]."'";
						$objrs_support = mysqli_query($objconn_support, $sql);
						
						if ($objrs_support) {
								$number_of_rows = mysqli_num_rows($objrs_support);
								//printf("result set has %d rows. \n", $number_of_rows);
								while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
									$tmpfirstname = $objfields['emp_firstname'];
									$tmplastname = $objfields['emp_lastname'];
									$tmpusername = $objfields['emp_username'];
									$tmppassword = $objfields['emp_password'];
									$tmpuserid   = $objfields['emp_record_id'];
								}
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								?>
<font color="#ffffff" face="arial narrow" size="2">welcome, <?=$tmpfirstname;?>&nbsp;<?=$tmplastname;?></font>
								<?
							
								}
							}
}							
}

function systemusercombobox($user_id, $archived, $nameofinput, $showcombobox, $default) {
	// This function is called when you need to make a combo box which lists the susyem users for selection. 
	// you may limit the search to a specific userid, or archived or non archived system users
	// you also need to specify the name of the input
	$sql	= "";
	$nsql 	= "";
	
	$sql = "SELECT * FROM `tbl_systemusers` ";

	if ($user_id=="all") {
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;
		}
		else {
			$nsql = "WHERE `emp_record_id` = ".$user_id." ";
			$sql = $sql.$nsql;
			$tmp_flagger = 1;
		}

	if ($archived == "all") {
			// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_systemusers.emp_archieved = -1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND Table_employee_listing.emp_archieved = -1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_systemusers.emp_archieved = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_systemusers.emp_archieved = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpfirstname 	= $objfields['emp_firstname'];
							$tmplastname 	= $objfields['emp_lastname'];
							$tmpinitials	= $objfields['emp_initials'];
							$tmpuserid 		= $objfields['emp_record_id'];
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($user_id = "all") {
									$intuserid	= (double) $default;
									if ($tmpuserid == $intuserid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?=$tmpuserid;?>"><?=$tmpfirstname;?>&nbsp;&nbsp;<?=$tmplastname;?>&nbsp;&nbsp;(<?=$tmpinitials;?>)</option>
										<?
									}
									else {
										?>
				<?=$tmpfirstname;?>&nbsp;&nbsp;<?=$tmplastname;?>&nbsp;&nbsp;(<?=$tmpinitials;?>)
										<?
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	return $tmpfirstname." ".$tmplastname." ".$tmpinitials;
	}
	
function systemusercomboboxwall($user_id, $archived, $nameofinput, $showcombobox, $default) {
	// This function is called when you need to make a combo box which lists the susyem users for selection. 
	// you may limit the search to a specific userid, or archived or non archived system users
	// you also need to specify the name of the input
	$sql	= "";
	$nsql 	= "";
	
	$sql = "SELECT * FROM `tbl_systemusers` ";

	if ($user_id=="all") {
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;
		}
		else {
			$nsql = "WHERE `emp_record_id` = ".$user_id." ";
			$sql = $sql.$nsql;
			$tmp_flagger = 1;
		}

	if ($archived == "all") {
			// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_systemusers.emp_archieved = -1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND Table_employee_listing.emp_archieved = -1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_systemusers.emp_archieved = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_systemusers.emp_archieved = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
		<option value="">Select someone from the list if applicable</option>
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmpfirstname 	= $objfields['emp_firstname'];
							$tmplastname 	= $objfields['emp_lastname'];
							$tmpinitials	= $objfields['emp_initials'];
							$tmpuserid 		= $objfields['emp_record_id'];
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($user_id = "all") {
									$intuserid	= (double) $default;
									if ($tmpuserid == $intuserid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?=$tmpuserid;?>"><?=$tmpfirstname;?>&nbsp;&nbsp;<?=$tmplastname;?>&nbsp;&nbsp;(<?=$tmpinitials;?>)</option>
										<?
									}
									else {
										?>
				<?=$tmpfirstname;?>&nbsp;&nbsp;<?=$tmplastname;?>&nbsp;&nbsp;(<?=$tmpinitials;?>)
										<?
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	return $tmpfirstname." ".$tmplastname." ".$tmpinitials;
	}

function organizationcombobox($org_id, $archived, $nameofinput, $showcombobox, $default) {
	// This function is called when you need to make a combo box which lists the susyem users for selection. 
	// you may limit the search to a specific userid, or archived or non archived system users
	// you also need to specify the name of the input
	$sql	= "";
	$nsql 	= "";
	
	$sql = "SELECT * FROM `tbl_organization_main` ";

	if ($org_id=="all") {
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;
		}
		else {
			$nsql = "WHERE `Organizations_id` = ".$org_id." ";
			$sql = $sql.$nsql;
			$tmp_flagger = 1;
		}

	if ($archived == "all") {
			// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_organization_main.org_archieved_yn = -1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_organization_main.org_archieved_yn = -1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_organization_main.org_archieved_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_organization_main.org_archieved_yn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	$sql = $sql."ORDER BY org_name";
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmporgname 	= $objfields['org_name'];
							$tmporgtypeid 	= $objfields['org_type_cb_int'];
							$tmporgid		= $objfields['Organizations_id'];
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($org_id = "all") {
									$intorgid	= (double) $default;
									if ($tmporgid == $intorgid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?=$tmporgid;?>"><?=$tmporgname;?></option>
										<?
									}
									else {
										?>
				<?=$tmporgname;?>
										<?
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	return $tmporgname;
	}
function organizationtypescombobox($org_id, $archived, $nameofinput, $showcombobox, $default) {
	// This function is called when you need to make a combo box which lists the susyem users for selection. 
	// you may limit the search to a specific userid, or archived or non archived system users
	// you also need to specify the name of the input
	$sql	= "";
	$nsql 	= "";
	
	$sql = "SELECT * FROM `tbl_organization_sub_t` ";

	if ($org_id=="all") {
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;
		}
		else {
			$nsql = "WHERE `org_types_id` = ".$org_id." ";
			$sql = $sql.$nsql;
			$tmp_flagger = 1;
		}

	if ($archived == "all") {
			// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {
					if ($tmp_flagger==0) {
							$nsql = "WHERE org_types_archived_yn = 1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND org_types_archived_yn = 1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE org_types_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND org_types_archived_yn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	$sql = $sql."ORDER BY org_types_name";
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmporgname 	= $objfields['org_types_name'];
							$tmporgtypeid 	= $objfields['org_types_id'];
							$tmparchived	= $objfields['org_types_archived_yn'];
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($org_id = "all") {
									$intorgid	= (double) $default;
									if ($tmporgtypeid == $intorgid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?=$tmporgtypeid;?>"><?=$tmporgname;?></option>
										<?
									}
									else {
										?>
				<?=$tmporgname;?>
										<?
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	}
function organizationcomboboxgettype($org_id, $archived, $nameofinput, $showcombobox, $default) {
	// This function is called when you need to make a combo box which lists the susyem users for selection. 
	// you may limit the search to a specific userid, or archived or non archived system users
	// you also need to specify the name of the input
	$sql	= "";
	$nsql 	= "";
	
	$sql = "SELECT * FROM `tbl_organization_main` INNER JOIN tbl_organization_sub_t ON tbl_organization_main . org_type_cb_int = tbl_organization_sub_t . org_types_id ";

	if ($org_id=="all") {
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;
		}
		else {
			$nsql = "WHERE `org_types_id` = '".$org_id."' ";
			$sql = $sql.$nsql;
			$tmp_flagger = 1;
		}

	if ($archived == "all") {
			// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {
					if ($tmp_flagger==0) {
							$nsql = "WHERE org_types_archived_yn = 1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND org_types_archived_yn = 1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE org_types_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND org_types_archived_yn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	
	//echo $sql;
	
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
					<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmporgid			= $objfields['Organizations_id'];
							$tmporgname 		= $objfields['org_name'];
							$tmporgtypename 		= $objfields['org_types_name'];
							$tmporgtypeid 		= $objfields['org_types_id'];
							$tmparchived		= $objfields['org_types_archived_yn'];
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($org_id = "all") {
									$intorgid	= (double) $default;
									if ($tmporgtypeid == $intorgid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?=$tmporgid;?>"><?=$tmporgname;?>&nbsp;&nbsp;(<?=$tmporgtypename;?>)</option>
										<?
									}
									else {
										?>
				<?=$tmporgname;?>
										<?
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	}
	
function loadquickaccessmenu($user) {
?>
<table border="0" height="20" border="0" id="quickaccessitem" cellpadding="2" cellspacing="2" background="stylesheets/_cssimages/layoutheaderbackground.gif">
	<Tr>
<?php

	$sql = "SELECT * FROM tbl_systemusers 
			INNER JOIN tbl_quickaccess_control ON tbl_quickaccess_control.tbl_qac_systemuser_id = tbl_systemusers.emp_record_id 
			INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_quickaccess_control.tbl_qac_navigation_id 
			WHERE tbl_systemusers.emp_record_id = ".$user." AND tbl_quickaccess_control.tbl_qac_hidden_yn = 0 
			ORDER BY tbl_navigational_control.menu_item_name_long";

	//echo "The SQL Statement is :".$sql;
	
	$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($newarray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							$tmpmenuitemid 	= $newarray['menu_item_id'];
							$tmpmenuurl 	= $newarray['menu_item_location'];
							$tmpmenuitemloc	= $newarray['menu_item_name_long'];
							$tmpmenusshortnl= $newarray['menu_item_name_short'];
							$tmpmenupurp	= $newarray['menu_item_purpose'];
							$tmpmenuslaved	= $newarray['menu_item_slaved_to_id'];
							?>
	<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;display:inline;" name="qac_menuitem<?php echo $tmpmenuitemid;?>" method="POST" action="<?php echo $tmpmenuurl;?>" target="layouttableiframecontent">
		<td width="50" class="formresults" onclick="javascript:document.menuitem<?php echo $tmpmenuitemid;?>.submit()" style="cursor:hand" onMouseover="ddrivetip('<?php echo $tmpmenuitemloc;?>')"; onMouseout="hideddrivetip()">
			<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemid;?>"></font>
			<?php echo $tmpmenusshortnl;?><br>
			</td>
		</form>
							<?php
						}	// End of while loop
					mysqli_free_result($res);
					mysqli_close($mysqli);
				}	// end of Res Record Object						
		}
		?>
		</tr>
	</table>
		<?php
	}	
?>
