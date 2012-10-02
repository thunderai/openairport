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
		$pagename = 'ADMIN - Add New System User';		
		
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
					breadcrumbs('nimba_users.php', $pagename);
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
		<form action="nimba_adduser.php" METHOD="POST" name="editform">
			<input type="hidden" name="formsubmit" value="1">
		<tr>
			<td class="newTopicNames">
				User's Full Name
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="text" name="userfullname" size="35">
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				User'sd Login Name
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="text" name="username" size="35">
				</td>
			</tr>
		<tr>
			<td class="newTopicNames">
				User's Password
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="text" name="userpass" size="35">
				</td>
			</tr>										
		<tr>
			<td class="newTopicNames">
				User's eMail Address
				</td>
			<td class="newTopicBoxes">
				<input class="newTopicInput" type="text" name="useremail" size="35">
				</td>
			</tr>
		<tr>
			<td colspan="2" class="newTopicNames">
				<input type="submit" name="submit" value="Add This User" class="button">
				</td>
			</tr>
		</table>
	<?
	}
	else {
	
		$sql2 = "INSERT INTO tbl_users (user_fullname,user_name,user_pass,user_email) VALUES ( '".$_POST['userfullname']."','".$_POST['username']."', '".$_POST['userpass']."', '".$_POST['useremail']."')";
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
				?>
			<tr>
				<td colspan="12" class="newTopicBoxes">
					User Information has been updated. You may now continue on your way.
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