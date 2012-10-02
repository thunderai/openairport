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
//	Name of Document	:	global_confirmapplication.php
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
		$pagename = 'RUAT - Confirm your Application';		
		?>
		
<HTML>
	<HEAD>
		<TITLE>
			<?=$pagename;?>
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		<script>
				var emailpasswindow = null; //01102006
		function checkform(form){


			if(form.username.value.length == 0) {
				alert ('Please enter your username.');
				return false;
			}

			if(form.userpass.value.length ==0) {
				alert ('Please enter your Password.');
				return false;
			}
			
			if(form.usercheckcode.value.length ==0) {
				alert ('Please enter the checkcode you received in your eMail varification.');
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
		<form action="global_confirmapplication.php" METHOD="POST" name="editform" onsubmit="return checkform(this)">
			<input type="hidden" name="formsubmit" value="1">
		<tr>
			<td class="newTopicNames">
				Your Login Name
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="text" name="username" size="35">
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				Your Password
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="password" name="userpass" size="35">
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				Checkcode
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="text" name="usercheckcode" size="35">
				</td>
			</tr>			
		<tr>
			<td colspan="2" class="newTopicNames">
				<input type="submit" name="submit" value="Submit" class="button">
				</td>
			</tr>
		</table>	
	<?
	}
	else {
	
		$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
			
			
		// Is this username already in use?
		
		$frm_username			= check_input($objconn_support,$_POST['username']);
		$frm_userpassword		= check_input($objconn_support,$_POST['userpass']);
		$frm_usercheckcode		= check_input($objconn_support,$_POST['usercheckcode']);
		
		$sql = "SELECT * FROM tbl_users_applicants WHERE user_a_name = ".$frm_username." AND user_a_pass = ".$frm_userpassword." AND user_a_checkcode = ".$frm_usercheckcode."";
		//echo $sql;			
			
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						if ($number_of_rows == 0) {
								// There are no usernames like this one
								$fail 		= 1;
							}
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								$fail 		= 0;
								$userid 	= $objfields['user_a_id'];
								$username 	= $objfields['user_a_fullname'];
								//echo "<br><br>User Name ".$userid." <br><br><br>";
							}
					}
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);
			}
		if ($fail == 1) {
				?>
				There is a problem with your application.  Either the username, password, or check code are incorrect.
				<?
			}
			else {	
				$checkcode = generatecheckcode();
				$sql2 = "UPDATE tbl_users_applicants SET user_a_complete_yn = 1 WHERE user_a_id = '".$userid."' ";
				//echo $sql2;
				$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						$objrs = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));
						//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
						$tmp_newuserid = mysqli_insert_id($mysqli);
					}	
					?>
			<tr>
				<td colspan="12" class="newTopicBoxes">
					Your Application for using the RUAT has been accepted. Someone will be in contact with you soon.
					</td>
				</tr>
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
														An applicant has completed the email varification process.</p>
														</td>
													</tr>
												<tr>
													<td class='newTopicTitle'>
														User Name
														</td>			
													<td class='newTopicNames'> ";
					$HTML = $HTML.$username."
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
					$subject 	= "*SSI* RUAT system ".$username." Has Completed Authorization *SSI*";
					sendreportbyemail('airport@watertownsd.us',$subject,$HTML,$headers);
					?>
				 <script language="javascript" type="text/javascript">
				     <!--
				     window.setTimeout('window.location="index.php"; ',7000);
				     // -->
				 </script>
				 <?
			}
	}
			?>
			</table>
		</body>
	</html>