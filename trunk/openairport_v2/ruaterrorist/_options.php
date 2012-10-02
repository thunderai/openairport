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
//	Name of Document	:	_options.php
//
//	Purpose of Page		:	FORM SIDE 	- Links to Add New CSV, and Change Settings
//							SERVER SIDE - Lists user data.
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
		$pagename = 'User Profile Information';		
		
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
			RUAT - System Options
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
			<tr>
				<td colspan="5" class="newTopicBoxes">
					<table>
						<tr>						
							<form action="_changeuser.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_SESSION["user_id"];?>">
								<input type="submit" name="submit"	value="Change Your Settings" class="button">
								</td>
								</form>
							<form action="_uploadnewfile.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
							<td class="newTopicBoxes">		
								<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
								<input type="submit" value="Upload New List" name="submit" class="button">
								</td>
								</form>
							<form action="_managelist.php" target="layouttableiframecontent" METHOD="POST" style="margin: 0px; margin-bottom:0px; margin-top:-1px;" >
							<td class="newTopicBoxes">		
								<input type="hidden" name="userid" value="<?=$_SESSION["user_id"];?>">
								<input type="submit" value="Manage Lists" name="submit" class="button">
								</td>
								</form>								
							</tr>
						</table>
					</td>
				</tr>
<?
	$sql = "SELECT * FROM tbl_users 
			INNER JOIN tbl_users_files 		ON tbl_users_files.user_f_parent_id = tbl_users.user_id 
			INNER JOIN tbl_users_queries	ON tbl_users_queries.user_q_parentid = tbl_users.user_id 
			WHERE user_id = ".$_SESSION['user_id']." ";
			
	//echo "SQL is ".$sql;
			
			//INNER JOIN tbl_users_searchs 	ON tbl_users_searchs.user_s_parent_id = tbl_users.user_id ";

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
						}
						else {
						
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							?>
			<tr>
				<td class="newTopicNames">
					Full Name
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_fullname'];?>
					</td>
				</tr>
			<tr>
				<td class="newTopicNames">
					Name
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_name'];?>
					</td>
				</tr>
			<tr>
				<td class="newTopicNames">
					eMail
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_email'];?>
					</td>
				</tr>
			<tr>
				<td class="newTopicNames">
					Password
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_pass'];?>
					</td>
				</tr>
			<tr>
				<td class="newTopicNames">
					CSV
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_f_name'];?>
					</td>
				</tr>			
							<?
						}
				}
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