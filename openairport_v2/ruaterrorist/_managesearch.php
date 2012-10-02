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
//	Name of Document	:	_managesearch.php
//
//	Purpose of Page		:	FORM SIDE 	- Allows User to Manage all of their saved searchs
//							SERVER SIDE - Lists all saved searchs for the current session user.
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

		// Stuff moved to 'Interface.php'
	
		
		
		$pagename = 'Manage Your Saved Searchs'.$displaytext;		
		
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
					breadcrumbs('_managesearch.php', $pagename);
					$function = "Accessed Page: ".$pagename;
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
							<form action="_addnewsearch.php" 		METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_SESSION["user_id"];?>">
								<input type="hidden" name="displaylist" 	value="<?=$displaylist;?>">
								<input type="hidden" name="displaypage" 	value="<?=$displaypage;?>">
								<input type="submit" name="submit"	value="Add New SD Search" class="button">
								</td>
								</form>
							<form action="_addnewcustomsearch.php" 	METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_SESSION["user_id"];?>">
								<input type="hidden" name="displaylist" 	value="<?=$displaylist;?>">
								<input type="hidden" name="displaypage" 	value="<?=$displaypage;?>">
								<input type="submit" name="submit"	value="Custom Search" class="button">
								</td>
								</form>								
							<form action="_hideallsearch.php" 		METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_SESSION["user_id"];?>">
								<input type="hidden" name="displaylist" 	value="<?=$displaylist;?>">
								<input type="hidden" name="displaypage" 	value="<?=$displaypage;?>">
								<input type="submit" name="submit"	value="Clear all Searchs" class="button">
								</td>
								</form>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
				<td colspan="5" class="newTopicBoxes">
					<table>
						<tr>
							<form action="_managesearch.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes" width="200" align="center" valign="middle">
								<input type="hidden" name="userid" 			value="<?=$_SESSION["user_id"];?>">
								<select name="displaylist" class="button" onchange="this.form.submit();">
									<option value="NULL"					>-Please Select a List- </option>
									<option value="all"						>Display All Records	</option>
									<option value="tbl_nofly_add_list"		>No Fly List (Recent)	</option>
									<option value="tbl_nofly_list"			>No Fly List (Total)	</option>
									<option value="tbl_selectee_add_list"	>Selectee List (Recent)	</option>
									<option value="tbl_selectee_list"		>Selectee List (Total)	</option>
									<option value="tbl_cleared_add_list"	>Cleared List (Recent)	</option>
									<option value="tbl_cleared_list"		>Cleared List (Total)	</option>
									</select>
								</td>
							</form>
							<?
							$num_to_display_per_page	= 15;
							$tmp_amount					= get_totalsavedqueries_bytype($_SESSION["user_id"],$displaylist);
							$dbl_num_pages				= ($tmp_amount / $num_to_display_per_page);
							$int_num_pages				= ($dbl_num_pages + 1);
							$int_num_pages				= (int)$int_num_pages;
							echo $tmp_amount." records have been found. ";
							$tmp_minrecord 				= ($displaypage * $num_to_display_per_page - $num_to_display_per_page);
							$tmp_maxrecord				= ($tmp_minrecord + $num_to_display_per_page);
							echo " You are displaying records ".$tmp_minrecord." through ".$tmp_maxrecord." ";
							?>
							<form action="_managesearch.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes" width="200" align="center" valign="middle">
								<input type="hidden" name="userid" 			value="<?=$_SESSION["user_id"];?>">
								<input type="hidden" name="displaylist" 	value="<?=$displaylist;?>">
								<select name="displaypage" class="button" onchange="this.form.submit();">
								<?
								for($i=1; $i<($int_num_pages+1); $i++) {
										?>
										<option value="<?=$i;?>" 
										<?
										if ($i==$displaypage) {
												?>
												SELECTED 
												<?
											}
										?>
										
										
										> Page <?=$i;?> </option>
										<?
									}
									?>
									</select>
								
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
					Watch List
					</td>
				<td class="newTopicTitle">
					Saved Name
					</td>
				<td width="200" class="newTopicTitle">
					Search for
					</td>					
				<td class="newTopicTitle">
					Send eMail alert
					</td>
				</tr>
			<?
			if ($displaylist == "all") {
					$sql = "SELECT * FROM tbl_users_searchs WHERE user_s_parent_id = '".$_SESSION["user_id"]."' AND user_s_archived_yn = 0";
				}
				else {
					$sql = "SELECT * FROM tbl_users_searchs WHERE user_s_parent_id = '".$_SESSION["user_id"]."' AND user_s_archived_yn = 0 AND user_s_table = '".$displaylist."' ";
					//echo "<font size='1'> SQL is ".$sql."<bR>";
				}
					$sql = $sql." ORDER BY user_s_who ";
					// 	Determine Limit Ranges
						$form_startcountat	= ($num_to_display_per_page * ($displaypage-1));			
						//echo $form_startcountat."<br>";
						$form_endcountat	= ($form_startcountat + $num_to_display_per_page);
						//echo $form_endcountat."<br>";
					// 	$sql2 = "SELECT * FROM ig_gallery WHERE is_visible = 'on' AND cat = ".$category." LIMIT ".$form_startcountat.",".$imagestoshowatatime."";
					
					$sql = $sql."LIMIT ".$form_startcountat.",".$num_to_display_per_page." ";
					
					$tmp_end = ($num_to_display_per_page+$form_startcountat);
					
					
					//echo "<font size='1'> SQL is ".$sql."<bR>";
					
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
											You currently have no saved searchs
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
														<input type="hidden" name="searchid" 	value="<?=$objfields['user_s_id'];?>">
														<input type="hidden" name="displaylist" value="<?=$displaylist;?>">
														<input type="hidden" name="displaypage" value="<?=$displaypage;?>">
														<input type="submit" name="submit" 		value="Run" class="button">
														</td>
														</form>
													<form action="_editsearch.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
														<td>
														<input type="hidden" name="userid" 		value="<?=$_SESSION["user_id"];?>">
														<input type="hidden" name="searchid" 	value="<?=$objfields['user_s_id'];?>">
														<input type="hidden" name="displaylist" value="<?=$displaylist;?>">
														<input type="hidden" name="displaypage" value="<?=$displaypage;?>">
														<input type="submit" name="submit" 		value="Edit" class="button">
														</td>
														</form>
													<form action="_hidesearch.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
														<td>
														<input type="hidden" name="userid" 		value="<?=$_SESSION["user_id"];?>">
														<input type="hidden" name="searchid" 	value="<?=$objfields['user_s_id'];?>">
														<input type="hidden" name="displaylist" value="<?=$displaylist;?>">
														<input type="hidden" name="displaypage" value="<?=$displaypage;?>">
														<input type="submit" name="submit" 		value="Delete" class="button">
														</td>
														</form>
													</tr>
												</table>
											</td>
										<td class="newTopicNames">
											<?
											switch ($objfields['user_s_table']) {
													case "tbl_nofly_list":
															?>
															NO FLY
															<?
															break;
													case "tbl_cleared_list":
															?>
															CLEARED
															<?
															break;
													case "tbl_selectee_list":
															?>
															SELECTEE
															<?
															break;
													default:
															?>
															<?=$objfields['user_s_table'];?>
															<?
															break;
												}
											?>
											</td>											
										<td class="newTopicNames">
											<?=$objfields['user_s_name'];?>
											</td>
										<td class="newTopicNames">
											<?=$objfields['user_s_who'];?>
											</td>
										<td class="newTopicNames">
											<?
											switch ($objfields['user_s_send_email']) {
													case "1":
															?>
															Send eMail
															<?
															break;
													case "0":
															?>
															Dont Send
															<?
															break;
													default:
															?>
															<?=$objfields['user_s_send_email'];?>
															<?
															break;
												}
											?>										
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
		</BODY>
	</HTML>
		<?
	}
?>