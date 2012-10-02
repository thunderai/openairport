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
//	Name of Document	:	nimba_approveapplicant.php
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
		$pagename = 'ADMIN - Approve an Applicant';		
		
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
			Transportation Security Administration SSI - Manage your search query
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td colspan="2">
					<?
					breadcrumbs('nimba_applicants.php', $pagename);
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
	//echo "Lier, Lier, Pants on Fire <br>";
	}
	else {
		// Get information about this applicant based on the id provided.
		$sql = "SELECT * FROM tbl_users_applicants WHERE user_a_id = ".$_POST['userid']." LIMIT 1";
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
												There is a problem with the request
												</td>
											</tr>
										<?
							}
							else {
							
							}
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
								$tmp_fullname 	= $objfields['user_a_fullname'];
								$tmp_name		= $objfields['user_a_name'];
								$tmp_password	= $objfields['user_a_pass'];
								$tmp_email		= $objfields['user_a_email'];
							}
					}
					mysqli_free_result($objrs_support);
					mysqli_close($objconn_support);				
					
			}
							
	
	
		$sql2 = "INSERT INTO tbl_users (user_fullname,user_name,user_pass,user_email) VALUES ( '".$tmp_fullname."','".$tmp_name."', '".$tmp_password."', '".$tmp_email."')";
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

		
		$sql2 = "INSERT INTO tbl_users_queries (user_q_number,user_q_parentid) VALUES ( '0','".$tmp_newuserid."')";
		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				$objrs = mysqli_query($mysqli, $sql2) or die(mysqli_error($mysqli));
				//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
				//$tmp_newuserid = mysql_insert_id($mysqli);
				}

		$sql = "UPDATE tbl_users_applicants SET user_a_archived_yn = 1 WHERE user_a_id = '".$_POST['userid']."' ";
		$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}		
			else {
				$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
				?>
				<tr>
					<td class="newTopicNames">
						Selected Applicant has been deleted. You may continue on your way.
						</td>
					</tr>
				<?
				//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
				//echo mysql_insert_id($mysqli);
				}				
				?>
			<tr>
				<td colspan="12" class="newTopicBoxes">
					The Selected User was approved and an email was sent to the user telling them they have been approved
					</td>
				</tr>
		<?
		$headers 	= 'MIME-Version: 1.0' . "\r\n";
		$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$subject 	= "*SSI* You have been approved for the RUAT System *SSI*";
		$HTML		= "You may log into the system using the username and password you provided in your application";
		sendreportbyemail($tmp_email,$subject,$HTML,$headers);
		}
		?>
			</table>
		</body>
	</html>
	<?
	}
?>