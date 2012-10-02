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
		include("includes/interface.php");

// Establish Page Name			
		$pagename = 'Manage Airport List';		
		
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
				<td colspan="10">
					<?
					breadcrumbs('_managelist.php', $pagename);
					?>
					</td>
				</tr>		
			<tr>
				<td colspan="10" class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
			<tr>
				<td colspan="10" class="newTopicBoxes">
					<p>
						Listed below is an entry for each person on your list. You may make changes to any one of 
						them and you may use any of the option buttons provided below.
						</p>
					</td>
				</tr>
			<tr>
				<td colspan="10" class="newTopicBoxes">
					<table>
						<tr>						
							<form action="_addnewlist.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_SESSION["user_id"];?>">
								<input type="submit" name="submit"	value="Add New Person" class="button">
								</td>
								</form>
							<form action="_runnewlist.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_SESSION["user_id"];?>">
								<input type="submit" name="submit"	value="Create New File" class="button">
								</td>
								</form>
							</tr>
						</table>
					</td>
				</tr>				
<?
	$sql = "SELECT * FROM tbl_users_lists WHERE user_l_archived_yn = 0 AND user_l_parent = ".$_SESSION['user_id']." ";
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
				<td colspan="10" class="newTopicNames">
					</b>No Records Found, Please use the 'Add New Person' Button to add an entry</b>
					</td>
				</tr>
				<?
						}
						else {
						?>
			<tr>
				<td class="newTopicTitle">
					Controls
					</td>
				<td class="newTopicTitle">
					Last Name
					</td>
				<td class="newTopicTitle">
					First Name
					</td>					
				<td class="newTopicTitle">
					Middle Name
					</td>
				<td class="newTopicTitle">
					Type
					</td>
				<td class="newTopicTitle">
					DOB
					</td>
				<td class="newTopicTitle">
					POB
					</td>					
				<td class="newTopicTitle">
					Citizenship
					</td>
				<td class="newTopicTitle">
					Passport
					</td>
				<td class="newTopicTitle">
					MISC
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
							<form action="_editlist.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
								<td>
								<input type="hidden" name="userid" 		value="<?=$objfields['user_l_id'];?>">
								<input type="submit" name="submit" 		value="Edit" class="button">
								</td>
								</form>
							<form action="_hidelist.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
								<td>
								<input type="hidden" name="userid" 		value="<?=$objfields['user_l_id'];?>">
								<input type="submit" name="submit" 		value="Delete" class="button">
								</td>
								</form>
							</tr>
						</table>
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_l_last'];?>
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_l_first'];?>
					</td>				
				<td class="newTopicBoxes">
					<?=$objfields['user_l_middle'];?>
					</td>				
				<td class="newTopicBoxes">
					<?=$objfields['user_l_type'];?>
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_l_dob'];?>
					</td>
				<td class="newTopicBoxes">
					<?=$objfields['user_l_pob'];?>
					</td>				
				<td class="newTopicBoxes">
					<?=$objfields['user_l_citizenship'];?>
					</td>				
				<td class="newTopicBoxes">
					<?=$objfields['user_l_passport'];?>
					</td>		
				<td class="newTopicBoxes">
					<?=$objfields['user_l_misc'];?>
					</td>					
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