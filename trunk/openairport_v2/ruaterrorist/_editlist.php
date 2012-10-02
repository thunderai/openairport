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
		$pagename = 'Change Airport Person';		
		
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
					breadcrumbs('_managelist.php', $pagename);
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
		$sql = "SELECT * FROM tbl_users_lists WHERE user_l_id = '".$_POST["userid"]."' ";
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
			<form action="_editlist.php" METHOD="POST" name="editform">
				<input type="hidden" name="formsubmit" value="1">
				<input type="hidden" name="user_l_id" value="<?=$objfields['user_l_id'];?>">
									<tr>
										<td class="newTopicNames">
											Persons Last Name
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_last" value="<?=$objfields['user_l_last'];?>" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons First Name
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_first" value="<?=$objfields['user_l_first'];?>" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Middle Name
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_middle" value="<?=$objfields['user_l_middle'];?>" size="35">
											</td>
										</tr>										
									<tr>
										<td class="newTopicNames">
											Persons Type
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_type" value="<?=$objfields['user_l_type'];?>" size="35">
											</td>
										</tr>										
									<tr>
										<td class="newTopicNames">
											Persons Date of Birth (DOB)
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_dob" value="<?=$objfields['user_l_dob'];?>" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Place of Birth (POB)
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_pob" value="<?=$objfields['user_l_pob'];?>" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Citizenship
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_citizenship" value="<?=$objfields['user_l_citizenship'];?>" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Passport
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_passport" value="<?=$objfields['user_l_passport'];?>" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Misc Information
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_misc" value="<?=$objfields['user_l_misc'];?>" size="35">
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
			
			$markdelete = 0;
				
			$sql = "UPDATE tbl_users_lists SET 
					user_l_last 		= '".$_POST['person_last']."', 
					user_l_first 		= '".$_POST['person_first']."', 
					user_l_middle		= '".$_POST['person_middle']."', 
					user_l_type			= '".$_POST['person_type']."', 
					user_l_dob 			= '".$_POST['person_dob']."', 
					user_l_pob 			= '".$_POST['person_pob']."', 
					user_l_citizenship	= '".$_POST['person_citizenship']."', 
					user_l_passport		= '".$_POST['person_passport']."', 					
					user_l_misc 		= '".$_POST['person_misc']."', 	
					user_l_archived_yn 	= ".$markdelete."  
					WHERE user_l_id 	= ".$_POST['user_l_id']." ";
			
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
				$function = "Chaned Person List Settings with the following SQL Statement";
				put_systemactivity($_SESSION["user_id"],$function);
				?>
			<tr>
				<td colspan="12" class="newTopicBoxes">
					Person Information has been updated. You may now continue on your way.
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