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
//	Name of Document	:	_nimba_applicants.php
//
//	Purpose of Page		:	FORM SIDE 	- Links to Edit User and Add User
//							SERVER SIDE - Lists Users in the database
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
		$pagename = 'ADMIN - Resend eMail Application';		
		
// Check to see if a user is currently logged Into the System.  We do this to prevent direct linking
//	to the document. If someone tries to direct link to the page, the broweser will show a 404 error.
		//echo "Session ID is [".$_SESSION['user_id'],"]";
		if ($_SESSION['user_id'] == '') {
				//echo "There has been a request for this page outside of normal operating procedures<br>";
				send_404();
			}
			else {
				//echo "The request for this page seems to be in order, allow page to be displayed <br>";
				?>
<HTML>
	<HEAD>
		<TITLE>
			RUAT - User Controls
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td colspan="9">
					<?
					breadcrumbs('nimba_resendapplication.php', $pagename);
					?>
					</td>
				</tr>		
			<tr>
				<td colspan="9" class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
			<tr>
				<td colspan="9" class="newTopicBoxes">
					<p>
						A new email has been sent to this applicat for email varification
						</p>
					</td>
				</tr>
<?
	$sql = "SELECT * FROM tbl_users_applicants WHERE user_a_archived_yn = 0 AND user_a_id = ".$_POST['userid']."";
	$objconn_support = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					if ($number_of_rows == 0) {
							$failed = 1;
								?>
									<tr>
										<td class="newTopicNames" colspan="9" align="center">
											There was an error in your request
											</td>
										</tr>
									<?
						}
						else {
						?>
						<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
						$tmp_checkcode 	= $objfields['user_a_checkcode'];
						$tmp_username	= $objfields['user_a_name'];
						$tmp_useremail	= $objfields['user_a_email'];
	

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
					$HTML = $HTML.$tmp_username."
														</td>
													</tr>
												<tr>
													<td class='newTopicTitle'>
														Check code
														</td>			
													<td class='newTopicNames'> ";
					$HTML = $HTML.$tmp_checkcode."				
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
					sendreportbyemail($tmp_useremail,$subject,$HTML,$headers);
						}
				}
			?>
			<tr>
				<td colspan="9" class="newTopicEnder">
					&nbsp;
					</td>
				</tr>		
				<?
		}
		?>
			</table>
		</body>
	</html>
		<?
	}
?>	