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
//	Name of Document	:	_hideallnotice.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows User to Hide all Notices
//							SERVER SIDE - Essentialy a function.  Just switchs archived_yn to 1.
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
		$pagename = 'Hide All System Notices';		
		
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
			Transportation Security Administration SSI - Delete all Search Queries
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td>
					<?
					breadcrumbs('_managenotice.php', $pagename);
					$function = "Accessed the Hide all System Notices Window";
					put_systemactivity($_SESSION["user_id"],$function);					
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

	$tmp_searchid 	= $_POST['searchid'];
	
// Load Saved Search Data
	$sql = "UPDATE tbl_users_notice SET user_n_archived_yn = 1 WHERE user_n_parent_id = '".$_SESSION["user_id"]."' ";
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
					The Notices have been deleted
					</td>
				</tr>
			<?
			//echo "The Query has been deleted<br><br>You may now close this window";
			//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
			//echo mysql_insert_id($mysqli);
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
		<body>
	</html>
			<?
	}
?>	