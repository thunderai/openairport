<?
//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//==============================================================================================
//	
//	oooo	o   o	 ooo	ooooo
//	o	o	o	o	o	o	  o
//	o	o	o	o	o	o	  o
//	oooo	o   o	ooooo	  o	
//	o  o	o	o	o	o	  o
//	o	o	o	o	o	o	  o
//	o	o	ooooo	o   o	  o
//
//	The "Are You a Terrorist?" (RUAT) system.
//
//	Designed, Coded, and Supported by Erick Alan Dahl
//
//	Copywrite 2008 - Erick Alan Dahl
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	nimba_adduser.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows Administrator to add a new User.
//							SERVER SIDE - Adds New user to the database.
//
//==============================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

// Prevent System From Timeing out while doing a search of the database	   
		set_time_limit(0);
		
// Include Files nessary to complete any tasks assigned.		
		include("includes/generalsettings.php");
		include("includes/functions.php");

// Establish Page Name			
		$pagename = 'RUAT - Fill out an Application';		
		?>
<HTML>
	<HEAD>
		<TITLE>
			Transportation Security Administration SSI - Manage your search query
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		<script type="text/javascript" src="scripts/password_validation.js"></script>
		<script>
		
				var emailpasswindow = null; //01102006
				validRegExp = /^[^@]+@[^@]+.[a-z]{2,}$/i;
	function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);

// control keys
if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;

// numbers
else if ((("0123456789").indexOf(keychar) > -1))
   return true;

// decimal point jump
else if (dec && (keychar == "."))
   {
   myfield.form.elements[dec].focus();
   return false;
   }
else
   return false;
}

		
		function checkform(form){

			strEmail = form.useremail.value;
			password = form.userpass.value;

			if(form.userfullname1.value.length ==0) {
				alert ('Please enter your First Name');
				return false;
			}			
			if(form.userfullname2.value.length ==0) {
				alert ('Please enter your Middle Initial.');
				return false;
			}	
			if(form.userfullname3.value.length ==0) {
				alert ('Please enter your Last Name.');
				return false;
			}		
						
			if(form.username.value.length == 0) {
				alert ('Please enter the name you you would like to use to log In to the system.');
				return false;
			}

			if(form.userorg.value.length == 0) {
				alert ('Please provide the organization you are working for.');
				return false;
			}			
			
			if(form.userpass.value.length ==0) {
				alert ('Please enter a Password.');
				return false;
			}
			if(form.userpass2.value.length ==0) {
				alert ('Please enter your password again for varification.');
				return false;
			}

			if(form.useremail.value.length ==0) {
				alert ('Please enter your office eMail.');
				return false;
			}
			
			if(form.useremailing1.value.length ==0) {
				alert ('Please enter your Street Address.');
				return false;
			}
			if(form.useremailing2.value.length ==0) {
				alert ('Please enter your State Address.');
				return false;
			}
			if(form.useremailing3.value.length ==0) {
				alert ('Please enter your Zip Code Address.');
				return false;
			}
			if(form.useremailing4.value.length ==0) {
				alert ('Please enter your Zip Code Address.');
				return false;
			}				
			if(form.userofficephone1.value.length ==0) {
				alert ('Please enter your Office Phone Number.');
				return false;
			}
			if(form.userofficephone2.value.length ==0) {
				alert ('Please enter your Office Phone Number.');
				return false;
			}			
			if(form.userofficephone3.value.length ==0) {
				alert ('Please enter your Office Phone Number.');
				return false;
			}
			if(form.userofficefax1.value.length ==0) {
				alert ('Please enter your Office Fax Number.');
				return false;
			}
			if(form.userofficefax2.value.length ==0) {
				alert ('Please enter your Office Fax Number.');
				return false;
			}			
			if(form.userofficefax3.value.length ==0) {
				alert ('Please enter your Office Fax Number.');
				return false;
			}			
			if(form.userwhere.value.length ==0) {
				alert ('Please enter where you heared about us.');
				return false;
			}
			
			var passed = validatePassword(password, {
					length:   [8, Infinity],
					lower:    1,
					upper:    1,
					numeric:  1,
					special:  1,
					badWords: ["password"],
					badSequenceLength: 4
				});
			
			if (passed == false) {
				alert('Your password does not meet requirements \n 1). Must have a special char \n 2). Must have a number \n 3). Must have a capital letter \n 4). Must have a lower case letter \n 5). Must be longer than 8 chars \n 6). Can not contain any numberline progression.');
				return false;
			}
			
			if (form.userpass2.value != form.userpass.value) {
				alert ('Your passwords do not match');
				return false;
			}	
			
			if (strEmail.search(validRegExp) == -1) {
				alert(" A valid e-mail address is required.\n Please check you have entered your details correctly.");
				return false;
				}
				
			if(form.iagree.checked == false) {
				alert ('You must agree to the License Terms of Use.');
				return false;
			}	
				
				
			return true;
		}

		</script>
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td colspan="2">
					<?
					breadcrumbs('global_addapplication.php', $pagename);
					?>
					</td>
				</tr>
			<tr>
				<td colspan="2" class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
<?

if ($_POST['formsubmit']!="1") {
		?>
		<form action="global_addapplication.php" METHOD="POST" name="editform" onsubmit="return checkform(this)" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
			<input type="hidden" name="formsubmit" value="1">
		<tr>
			<td class="newTopicNames">
				Your Name
				</td>
			<td class="newTopicBoxes">
				<table width="425" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
					<tr>
						<td align="center" valign="middle">						
							<input class="newTopicInput" type="text" name="userfullname1" size="25">
							</td>
						<td align="center" valign="middle">								
							<input class="newTopicInput" type="text" name="userfullname2" size="2" MAXLENGTH="1">
							</td>
						<td align="center" valign="middle">								
							<input class="newTopicInput" type="text" name="userfullname3" size="25">
							</td>
						</tr>
					<tr>
						<td class="attachmentCategory">						
							First Name
							</td>
						<td class="attachmentCategory">						
							Middle Initial
							</td>
						<td class="attachmentCategory">						
							Last Name
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				Your Organization
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="text" name="userorg" size="31">
				</td>
			</tr>			
		<tr>
			<td class="newTopicNames">
				Your Login Name
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="text" name="username" size="31">
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				Your Password
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="password" name="userpass" size="31">
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				Your Password (repeat)
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="password" name="userpass2" size="31">
				</td>
			</tr>				
		<tr>
			<td class="newTopicNames">
				Your eMail Address
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="text" name="useremail" size="31">
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				Your Office Phone #
				</td>
			<td class="newTopicBoxes">
				(&nbsp;
				<input class="newTopicInput" type="text" name="userofficephone1" id="userofficephone1" size="3" MAXLENGTH="3" onKeyPress="return numbersonly(this, event)">&nbsp;)&nbsp;&nbsp;
				<input class="newTopicInput" type="text" name="userofficephone2" id="userofficephone2" size="3" MAXLENGTH="3" onKeyPress="return numbersonly(this, event)">&nbsp;&nbsp;-&nbsp;&nbsp;
				<input class="newTopicInput" type="text" name="userofficephone3" id="userofficephone3" size="5" MAXLENGTH="4" onKeyPress="return numbersonly(this, event)">
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				Your Office Fax #
				</td>
			<td class="newTopicBoxes">
				(&nbsp;
				<input class="newTopicInput" type="text" name="userofficefax1" id="userofficefax1" size="3" MAXLENGTH="3" onKeyPress="return numbersonly(this, event)">&nbsp;)&nbsp;&nbsp;
				<input class="newTopicInput" type="text" name="userofficefax2" id="userofficefax2" size="3" MAXLENGTH="3" onKeyPress="return numbersonly(this, event)">&nbsp;&nbsp;-&nbsp;&nbsp;
				<input class="newTopicInput" type="text" name="userofficefax3" id="userofficefax3" size="5" MAXLENGTH="4" onKeyPress="return numbersonly(this, event)">
				</td>
			</tr>	
		<tr>
			<td class="newTopicNames">
				Your Mailing Address
				</td>
			<td class="newTopicBoxes">
				<table width="425" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
					<tr>
						<td align="center" valign="middle">						
							<input class="newTopicInput" type="text" name="useremailing1" size="20">
							</td>
						<td align="center" valign="middle">								
							<input class="newTopicInput" type="text" name="useremailing2" size="10">
							</td>
						<td align="center" valign="middle">								
							<input class="newTopicInput" type="text" name="useremailing3" size="2" MAXLENGTH="2">
							</td>
						<td align="center" valign="middle">								
							<input class="newTopicInput" type="text" name="useremailing4" size="5" MAXLENGTH="5" onKeyPress="return numbersonly(this, event)">
							</td>
						<td align="center" valign="middle">								
							- 
							</td>
						<td align="center" valign="middle">								
							<input class="newTopicInput" type="text" name="useremailing5" size="3" MAXLENGTH="4" onKeyPress="return numbersonly(this, event)">
							</td>
						</tr>
					<tr>
						<td class="attachmentCategory">						
							Street
							</td>
						<td class="attachmentCategory">						
							City
							</td>
						<td class="attachmentCategory">						
							State
							</td>
						<td colspan="3" class="attachmentCategory">						
							Zip
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				Where did you hear about us?
				</td>
			<td class="newTopicBoxes">
				<textarea name="userwhere" rows="10" cols="50"></textarea>
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				License / Terms of Use
				</td>
			<td class="newTopicBoxes">
				<iframe id="layouttableiframecontent" name="termsofuse" SRC="termsofuse.txt" width="420" scrolling="yes" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" ></iframe>
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				I agree to the License and Terms of Use
				</td>
			<td class="newTopicBoxes">
				<input type="checkbox" class="newTopicInput" name="iagree" value="1">
				</td>
			</tr>
		<tr>
			<td colspan="2" class="newTopicNames">
				<input type="submit" name="submit" value="Apply" class="button">
				</td>
			</tr>
		</table>
		</form>
	<?
	}
	else {
		// Is this username already in use?
		
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				//echo "We have made a sucessfull connection to the database. Now process the connection <bR>";
				//echo "Checking User Input <br>";
				$frm_user = check_input($objconn_support,$_POST['username']);
				//echo "Form : Username [".$frm_user."] <br>";			
				$sql = "SELECT * FROM tbl_users WHERE user_name = ".$frm_user;			
				//echo "SQL Statement is [ ".$sql." ] <br>";
				//echo " now submit our SQL statement to the database <br>";
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						if ($number_of_rows == 0) {
								// There are no usernames like this one
								$fail = 0;
							}
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								$fail = 1;
							}
					}
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
			}
		if ($fail == 1) {
				?>
				There is a problem with your application.  The username you entered is probably already taken
				<?
			}
			else {
				//echo "Username provided has not been taken, allow user to submit their application <br>";				
				$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						//echo "We have made a sucessfull connection to the database. Now process the connection <bR>";
						//echo "Checking User Input <br>";
						$frm_userfullname		= $_POST['userfullname1']." ".$_POST['userfullname2'].". ".$_POST['userfullname3']."";
						$frm_userfullname		= check_input($mysqli,$frm_userfullname);
						$frm_userorg			= check_input($mysqli,$_POST['userorg']);
						$frm_userloginname		= check_input($mysqli,$_POST['username']);
						$frm_userpassword		= check_input($mysqli,$_POST['userpass']);
						$frm_useremail			= check_input($mysqli,$_POST['useremail']);
						$frm_useremailing		= $_POST['useremailing1'].",".$_POST['useremailing2'].",".$_POST['useremailing3'].",".$_POST['useremailing4']." - ".$_POST['useremailing5'];
						$frm_useremailing		= check_input($mysqli,$frm_useremailing);
						$frm_userephonenumber1	= check_input($mysqli,$_POST['userofficephone1']);
						$frm_userephonenumber2	= check_input($mysqli,$_POST['userofficephone2']);
						$frm_userephonenumber3	= check_input($mysqli,$_POST['userofficephone3']);
						$frm_userephonenumber	= "(".$frm_userephonenumber1.") ".$frm_userephonenumber2." - ".$frm_userephonenumber3." ";
						$frm_userefaxnumber1	= check_input($mysqli,$_POST['userofficefax1']);
						$frm_userefaxnumber2	= check_input($mysqli,$_POST['userofficefax2']);
						$frm_userefaxnumber3	= check_input($mysqli,$_POST['userofficefax3']);
						$frm_userefaxnumber		= "(".$frm_userefaxnumber1.") ".$frm_userefaxnumber2." - ".$frm_userefaxnumber3." ";
						$frm_userewherehear		= check_input($mysqli,$_POST['userwhere']);
						$checkcode = generatecheckcode();
						
						//echo "Generating SQL Statement <br>";
						$sql2 = "INSERT INTO tbl_users_applicants 
								(user_a_fullname,user_a_org,user_a_name,user_a_pass,user_a_email,user_a_mailing,user_a_phone,user_a_fax,user_a_where,user_a_checkcode) 
								VALUES 
								( ".$frm_userfullname.",".$frm_userorg.",".$frm_userloginname.",".$frm_userpassword.",".$frm_useremail.",".$frm_useremailing.",'".$frm_userephonenumber."','".$frm_userefaxnumber."',".$frm_userewherehear.",'".$checkcode."')";
						//echo "SQL Statement is [ ".$sql2." ] <br>";
						//echo " now submit our SQL statement to the database <br>";	
						$objrs = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));
						$tmp_newuserid = mysqli_insert_id($mysqli);
						//echo "The ID of the created application is ".$tmp_newuserid." <br>";
					}	
					?>
			<tr>
				<td colspan="12" class="newTopicBoxes">
					Your Application for using the RUAT has been accepted. Someone will be in contact with you soon.
					</td>
				</tr>
			 <script language="javascript" type="text/javascript">
				     <!--
				     window.setTimeout('window.location="index.php"; ',1000);
				     // -->
				 </script>
					<?
					$HTML		= "<HTML>
										<HEAD>
											<TITLE>
												RUAT System eMail Varification
												</TITLE>
											<link rel='stylesheet' href='scripts/style.css' type='text/css'>
											</HEAD>
										<BODY>
											<table width='100%' Class='windowMain' CELLSPACING=1 CELLPADDING=2>
												<tr>
													<td colspan='2' class='newTopicTitle'>
														RUAT System eMail Varification
														</td>
													</tr>
												<tr>
													<td colspan='2' class='newTopicBoxes'>
														<p>
														RUAT has received your application, but now you must authorize your email account. Please 
														follow the steps provided below.<br>
														<br>
														1). Direct your internet browser to <a href='http://www.watertownsdairport.com/openairport_php/ruaterrorist/global_confirmapplication.php' target='_new'>RUAT</a><br>
														2). On the screen, enter your username and checkcode, then click submit <br>
														3). If your information is correct your application will be completed and someone will be with you shortly. <br>
														<br>
														</p>
														</td>
													</tr>
												<tr>
													<td class='newTopicTitle'>
														User Name
														</td>			
													<td class='newTopicNames'> ";
					$HTML = $HTML.$_POST['username']."
														</td>
													</tr>
												<tr>
													<td class='newTopicTitle'>
														Check code
														</td>			
													<td class='newTopicNames'> ";
					$HTML = $HTML.$checkcode."				
														</td>
													</tr>
												<tr>
													<td colspan='2' class='newTopicEnder'>
														&nbsp;
														</td>
													</tr>
												</table>
											</body>
										</html>";
					$headers 	= 'MIME-Version: 1.0' . "\r\n";
					$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$subject 	= "*SSI* RUAT system User Verification *SSI*";
					sendreportbyemail($_POST['useremail'],$subject,$HTML,$headers);
			}
	}
			?>
			</table>
		</body>
	</html>