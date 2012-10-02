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
//	Name of Document	:	_editsearch.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows User to Edit searches saved by '_addnewsearch.php'
//							SERVER SIDE - Takes the users input and Edits the data as supplied.
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
		$pagename = 'Change Selected Search Query Settings';		
		
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
				<td colspan="5">
					<?
					breadcrumbs('_editsearch.php', $pagename);
					$function = "Accessed the Edit Search Query Window";
					put_systemactivity($_SESSION["user_id"],$function);
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
					<table>
						<tr>						
							<form action="_managesearch.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_SESSION["user_id"];?>">
								<input type="hidden" name="displaylist" value="<?=$_POST['displaylist'];?>">
								<input type="hidden" name="displaypage" value="<?=$_POST['displaypage'];?>">
								<input type="submit" name="submit"	value="<<< Back" class="button">
								</td>
								</form>
							</tr>
						</table>
					</td>
				</tr>					
				
<?

if ($_POST['formsubmit']!="1") {
		// Not submited
		$sql = "SELECT * FROM tbl_users_searchs WHERE user_s_id = '".$_POST['searchid']."' ";
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
			<form action="_editsearch.php" METHOD="POST" name="editform">
				<input type="hidden" name="formsubmit" value="1">
				<input type="hidden" name="searchid" value="<?=$objfields['user_s_id'];?>">
									<tr>
										<td class="newTopicNames">
											Search Name
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="text" name="searchname" value="<?=$objfields['user_s_name'];?>" size="35">
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Search for
											</td>
										<td class="newTopicBoxes">
											<?=$objfields['user_s_who'];?>
											</td>
										</tr>																			
									<tr>
										<td class="newTopicNames">
											Search SQL
											</td>
										<td class="newTopicBoxes">
											<?
											$newsql = urldecode($objfields['user_s_sql']);
											?>
											<?=$newsql;?>
											</td>
										</tr>
									<tr>
										<td class="newTopicNames">
											Send eMail Alert
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="checkbox" name="searchemail" value="1" 
											<?
											if ($objfields['user_s_send_email']==1) {
													?>
																								CHECKED
													<?
											}
											?>
											>
											</td>
										</tr>											
									<tr>
										<td class="newTopicNames">
											Mark Deleted
											</td>
										<td class="newTopicBoxes">
											<input class="newTopicInput" type="checkbox" name="searchdelete" value="1">
											</td>
										</tr>
									<tr>
										<td colspan="2" class="newTopicNames">
											<input type="submit" name="submit" value="Make Changes" class="button">
											</td>
										</tr>
									</table>
									<?
							}
					}
			}
	}
	else {
			// Form has been submited
			if ($_POST['searchdelete']==1) {
					$markdelete = 1;
				}
				else {
					$markdelete = 0;
				}
			if ($_POST['searchemail']==1) {
					$markemail = 1;
				}
				else {
					$markemail = 0;
				}
				
			$sql = "UPDATE tbl_users_searchs SET user_s_name = '".$_POST['searchname']."', user_s_send_email = ".$markemail.", user_s_archived_yn = ".$markdelete." WHERE user_s_id = '".$_POST['searchid']."' ";
			
			//echo "SQL Statement :".$sql;
			
			$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");				
			if (mysqli_connect_errno()) {
					// there was an error trying to connect to the mysql database
					printf("connect failed: %s\n", mysqli_connect_error());
					exit();
				}		
				else {
					$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
					echo "The Query has been deleted<br><br>You may now close this window";
					//printf("Last inserted record has id %d\n", LAST_INSERT_ID());
					//echo mysql_insert_id($mysqli);
				}
				$function = "Chaned Saved Search Settings with the following SQL Statement [ ".$sql." ]";
				put_systemactivity($_SESSION["user_id"],$function);
				?>
			<tr>
				<td colspan="2" class="newTopicNames">
					Your Saved Search has been updated
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