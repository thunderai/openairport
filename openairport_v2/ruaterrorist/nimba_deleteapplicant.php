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
//	Name of Document	:	_nimba_deleteapplicant.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows User to upload a new file CSV
//							SERVER SIDE - Uploads file to users file location and saves info to database.
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
		$pagename = 'ADMIN - Hide an Applicant';		
		
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
			Transportation Security Administration SSI - Delete =Search Query
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td>
					<?
					breadcrumbs('nimba_applicants.php', $pagename);
					?>
					</td>
				</tr>		
			<tr>
				<td class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
	<?

// RUN SEARCH

	$tmp_searchid 	= $_POST['userid'];
	
// Load Saved Search Data
	$sql = "UPDATE tbl_users_applicants SET user_a_archived_yn = 1 WHERE user_a_id = '".$tmp_searchid."' ";
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
			</table>
		<body>
	</html>
	<?
	}
	?>