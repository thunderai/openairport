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
		include("includes/interface.php");

// Establish Page Name			
		$pagename = 'ADD New Person Entry';		
		
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
					breadcrumbs('_managelist.php', $pagename);
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
		<form action="_addnewlist.php" METHOD="POST" name="editform">
			<input type="hidden" name="formsubmit" value="1">
									<tr>
										<td class="newTopicNames">
											Persons Last Name
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_last" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons First Name
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_first" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Middle Name
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_middle" size="35">
											</td>
										</tr>										
									<tr>
										<td class="newTopicNames">
											Persons Type
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_type" size="35">
											</td>
										</tr>										
									<tr>
										<td class="newTopicNames">
											Persons Date of Birth (DOB)
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_dob" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Place of Birth (POB)
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_pob"  size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Citizenship
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_citizenship" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Passport
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_passport" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Persons Misc Information
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="person_misc" size="35">
											</td>
										</tr>
		<tr>
			<td colspan="2" class="newTopicNames">
				<input type="submit" name="submit" value="Add This User" class="button">
				</td>
			</tr>
	<?
	}
	else {
	

		$sql2 = "INSERT INTO tbl_users_lists (user_l_parent,user_l_last,user_l_first,user_l_middle,user_l_type,user_l_dob,user_l_pob,user_l_citizenship,user_l_passport,user_l_misc) 
				VALUES 
				( '".$_SESSION['user_id']."','".$_POST['person_last']."','".$_POST['person_first']."', '".$_POST['person_middle']."', '".$_POST['person_type']."', '".$_POST['person_dob']."', '".$_POST['person_pob']."','".$_POST['person_citizenship']."', '".$_POST['person_passport']."', '".$_POST['person_misc']."')";
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