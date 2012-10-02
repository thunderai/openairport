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
//	Name of Document	:	_changeuser.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows User to change certain aspects of their user profile
//							SERVER SIDE - Takes the users input and changes information in the database.
//
//==============================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

// Prevent System From Timeing out while doing a search of the database	   
		set_time_limit(0);
		
// Include Files nessary to complete any tasks assigned.		
		include("includes/generalsettings.php");
		include("includes/functions.php");
		include("includes/interface.php");

// Establish Page Name			
		$pagename = 'Change Your User Profile Information';		
		
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
				<td>
					<?
					breadcrumbs('_options.php', $pagename);
					$function = "Accessed Page: ".$pagename;
					put_systemactivity($_SESSION["user_id"],$function);
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
		// Not submited
		$sql = "SELECT * FROM tbl_users WHERE user_id = '".$_SESSION["user_id"]."' ";
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
								?>
			<tr>
				<td colspan="2" class="newTopicNames">
					There was a problem with your request. Please try again or contact the administrator
					</td>
				</tr>
								<?
							}
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {		
								?>
			<form action="_changeuser.php" METHOD="POST" name="editform">
				<input type="hidden" name="formsubmit" value="1">
				<input type="hidden" name="userid" value="<?=$objfields['user_id'];?>">
									<tr>
										<td class="newTopicNames">
											User's Full Name
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="userfullname" value="<?=$objfields['user_fullname'];?>" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											User'sd Login Name
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="username" value="<?=$objfields['user_name'];?>" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											User's Password
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="userpass" value="<?=$objfields['user_pass'];?>" size="35">
											</td>
										</tr>										
									<tr>
										<td class="newTopicNames">
											User's eMail Address
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="useremail" value="<?=$objfields['user_email'];?>" size="35">
											</td>
										</tr>										
									<tr>
										<td class="newTopicNames">
											Mark Deleted
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="checkbox" name="userdelete" value="1">
											</td>
										</tr>
									<tr>
										<td colspan="2" class="newTopicNames">
											<input type="submit" name="submit" value="Make Changes" class="button">
											</td>
										</tr>
									<?
							}
					}
			}
	}
	else {
			// Form has been submited
			if ($_POST['userdelete']==1) {
					$markdelete = 1;
				}
				else {
					$markdelete = 0;
				}
				
			$sql = "UPDATE tbl_users SET 
					user_fullname 		= '".$_POST['userfullname']."', 
					user_name 			= '".$_POST['username']."', 
					user_email			= '".$_POST['useremail']."', 
					user_pass			= '".$_POST['userpass']."', 
					user_archived_yn 	= ".$markdelete." 
					WHERE user_id 		= ".$_POST['userid']." ";
			
			//echo "SQL Statement :".$sql;
			
			$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}		
				else {
					$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
					//echo "The Query has been deleted<br><br>You may now close this window";
					//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
					//echo mysql_insert_id($mysqli);
				}
				//$function = "Chaned User Settings with the following SQL Statement [ ".$sql." ]";
				//put_systemactivity($_SESSION["user_id"],$function);
				?>
			<tr>
				<td colspan="12" class="newTopicBoxes">
					User Information has been updated. You may now continue on your way.
					</td>
				</tr>
	<?
	}
?>
			<tr>
				<td colspan="12" class="newTopicEnder">
					&nbsp;
					<?
					display_copywrite_footer();
					?>
					</td>
				</tr>	
			</table>
		</body>
	</html>
	<?
	}
	?>