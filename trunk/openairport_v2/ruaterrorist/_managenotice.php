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
//	Name of Document	:	_managenotice.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows User to Manage their NOTICES
//							SERVER SIDE - Lists all NOTICES for the session user
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
		$pagename = 'Manage Your System NOTICES';		
		
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
			Transportation Security Administration SSI - Manage Your Saved Searchs
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">			
		</HEAD>
	<BODY bgcolor="#FFFFFF">
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td colspan="5" >
					<?
					breadcrumbs('_managenotice.php', $pagename);
					$function = "Accessed Page :".$pagename;
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
					<p>
						Listed below are the notices the system found for you during the night. Each 
						one of these notices is based on one of your search queries. Only search 
						queries which found a match are displayed below.
						</p>
					</td>
				</tr>				
			<tr>
				<td colspan="5" class="newTopicBoxes">
					<table>
						<tr>						
							<form action="_hideallnotice.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_SESSION["user_id"];?>">
								<input type="submit" name="submit"	value="Clear all Notices" class="button">
								</td>
								</form>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td width="50" class="newTopicTitle">
					Controls
					</td>
				<td class="newTopicTitle">
					Date
					</td>
				<td class="newTopicTitle">
					Notice Name
					</td>
				<td class="newTopicTitle">
					on Watch List
					</td>
				<td class="newTopicTitle">
					while Searching For
					</td>
				</tr>
			<?
			$sql = "SELECT * FROM tbl_users_notice 
					WHERE user_n_parent_id = '".$_SESSION["user_id"]."' AND user_n_archived_yn = 0";
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
										<td class="newTopicNames" colspan="5" align="center">
											You currently have no Notices. You probably Cleared them all.
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
													<form action="_runsearch.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
														<td>
														<input type="hidden" name="userid" 		value="<?=$_SESSION["user_id"];?>">
														<input type="hidden" name="searchid" 	value="<?=$objfields['user_n_sub_id'];?>">
														<input type="submit" name="submit" 		value="Run" class="button">
														</td>
														</form>
													<form action="_editsearch.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
														<td>
														<input type="hidden" name="userid" 		value="<?=$_SESSION["user_id"];?>">
														<input type="hidden" name="searchid" 	value="<?=$objfields['user_n_sub_id'];?>">
														<input type="submit" name="submit" 		value="Edit" class="button">
														</td>
														</form>
													<form action="_hidesearch.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
														<td>
														<input type="hidden" name="userid" 		value="<?=$_SESSION["user_id"];?>">
														<input type="hidden" name="searchid" 	value="<?=$objfields['user_n_sub_id'];?>">
														<input type="submit" name="submit" 		value="Delete" class="button">
														</td>
														</form>
													</tr>
												</table>
											</td>
										<td class="newTopicNames">
											<?=$objfields['user_n_date'];?>
											</td>											
										<td class="newTopicNames">
											<?=$objfields['user_n_type'];?>
											</td>
										<?
										// Now get information about the search that was done.
										$sql2 = "SELECT * FROM tbl_users_searchs WHERE user_s_id = '".$objfields['user_n_sub_id']."' AND user_s_archived_yn = 0";
										$objconn_support2 = mysqli_connect("localhost", "webuser", "limitaces", "tsa_ruat");
										if (mysqli_connect_errno()) {
												printf("connect failed: %s\n", mysqli_connect_error());
												exit();
											}
											else {
												$objrs_support2 = mysqli_query($objconn_support2, $sql2);
												if ($objrs_support2) {
														$number_of_rows2 = mysqli_num_rows($objrs_support2);
														if ($number_of_rows2 == 0) {
																?>
																<tr>
																	<td class="newTopicNames" colspan="5" align="center">
																		There is an Error
																		</td>
																	</tr>
																<?
															}
														while ($objfields2 = mysqli_fetch_array($objrs_support2, MYSQLI_ASSOC)) {	
																?>
										<td class="newTopicNames">
											<?=$objfields2['user_s_table'];?>
											</td>
										<td class="newTopicNames">
											<?=$objfields2['user_s_who'];?>
											</td>
																<?
															}
													}
													mysqli_free_result($objrs_support2);
													mysqli_close($objconn_support2);
											}
											?>
										</tr>
									<?
								}
						}
						mysqli_free_result($objrs_support);
						mysqli_close($objconn_support);
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
		</BODY>
	</HTML>
			<?
	}
?>	