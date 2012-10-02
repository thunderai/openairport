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
//	Name of Document	:	_nimba_users.php
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
		$pagename = 'ADMIN - Manage Current System Users';		
		
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
				<td colspan="5">
					<?
					breadcrumbs('nimba_options.php', $pagename);
					?>
					</td>
				</tr>		
			<tr>
				<td colspan="5" class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
			<tr>
				<td colspan="5" class="newTopicBoxes">
					<p>
						Listed below are each of your saved queries. You will notice a query for 
						each row in your CSV for each list you have searched. You may click the Run 
						button to rerun this query and show any results. You may also edit this query 
						by pressing the Edit button, or you may delete just this query by pressing 
						the delete button.
						</p>
					</td>
				</tr>
			<tr>
				<td colspan="5" class="newTopicBoxes">
					<table>
						<tr>						
							<form action="nimba_adduser.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_SESSION["user_id"];?>">
								<input type="submit" name="submit"	value="Add New User" class="button">
								</td>
								</form>
							</tr>
						</table>
					</td>
				</tr>				
<?
	$sql = "SELECT * FROM tbl_users WHERE user_archived_yn = 0 ";
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
						?>
			<tr>
				<td class="newTopicTitle">
					Controls
					</td>
				<td class="newTopicTitle">
					User Full Name
					</td>
				<td class="newTopicTitle">
					User Login Name
					</td>					
				<td class="newTopicTitle">
					User Password
					</td>
				<td class="newTopicTitle">
					User eMail
					</td>
				</tr>
						<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							?>
			<tr>
				<td class="newTopicBoxes">
					<table>
						<tr>
							<form action="nimba_edituser.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
								<td>
								<input type="hidden" name="userid" 		value="<?=$objfields['user_id'];?>">
								<input type="submit" name="submit" 		value="Edit" class="button">
								</td>
								</form>
							<form action="nimba_deleteuser.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
								<td>
								<input type="hidden" name="userid" 		value="<?=$objfields['user_id'];?>">
								<input type="submit" name="submit" 		value="Delete" class="button">
								</td>
								</form>
							<form action="nimba_activityuser.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
								<td>
								<input type="hidden" name="userid" 		value="<?=$objfields['user_id'];?>">
								<input type="submit" name="submit" 		value="Activity" class="button">
								</td>
								</form>	
							<form action="nimba_noticeuser.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
								<td>
								<input type="hidden" name="userid" 		value="<?=$objfields['user_id'];?>">
								<input type="submit" name="submit" 		value="Notices" class="button">
								</td>
								</form>										
							</tr>
						</table>
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_fullname'];?>
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_name'];?>
					</td>				
				<td class="newTopicBoxes">
					<?=$objfields['user_pass'];?>
					</td>				
				<td class="newTopicBoxes">
					<?=$objfields['user_email'];?>
					</td>						
							<?
						}
						?>
			<tr>
				<td colspan="5" class="newTopicEnder">
					&nbsp;
					</td>
				</tr>		
				<?
				}
		}
		?>
			</table>
		</body>
	</html>
		<?
	}
?>	