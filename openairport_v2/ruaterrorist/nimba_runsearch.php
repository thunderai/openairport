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
//	Name of Document	:	_runsearch.php
//
//	Purpose of Page		:	FORM SIDE 	- No form functions
//							SERVER SIDE - Lists the results from the selected saved search.
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
		$pagename = 'Run Selected Saved Search';		
		
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
			Transportation Security Administration SSI - Run a Search Query
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<!--
		// NOTICE DIV LAYER
		-->
		<div id="myDiv" style="display:none; position:absolute; z-index:9; left:0; top:0; width:302;">
			<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
				<tr>
					<td class="newTopicTitle">Search Query Progress</td>
					</tr>
				<tr>
					<td class="newTopicBoxes">
						<div id="myDiv_bar" style="display:none; width:0; background-color: #7198BF;background-image:url('images/animated_timer_bar.gif'); background-repeat:no-repeat;background-position: left center;">
							<table>
								<tr>
									<td class="newTopicTitle" id="percent" align="center" valign="middle">
										&nbsp;
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>				
				<tr>
					<td colspan="2" class="newTopicEnder">&nbsp;</td>
					</tr>
				</table>
			</div>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td colspan="11">
					<?
					breadcrumbs('_nimba_runsearch.php', $pagename);
					$function = "Accessed Page: ".$pagename;
					put_systemactivity($_SESSION["user_id"],$function);
					?>
					</td>
				</tr>
			<tr>
				<td colspan="11" class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
			<tr>
				<td colspan="11" class="newTopicBoxes">
					<p>
						Listed here are matches that have been found according to your search critera 
						for just the selected member in your CSV file in the selected watch list.
						</p>
					</td>
				</tr>	
			<tr>
				<td colspan="11" class="newTopicBoxes">
					<table>
						<tr>						
							<form action="nimba_noticeuser.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_POST['userid'];?>">
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

// RUN SEARCH

	//$tmp_userid		= $_SESSION["user_id"];
	
	$userid 	= $_POST['userid'];
	$searchid 	= $_POST['searchid'];	
	
	
	//echo "USER ID ".$_SESSION["user_id"]."<br>";
	//echo "Search ID ".$tmp_searchid."<br>";
	
// Load Saved Search Data
// Load Saved Search Data
	$sql = "SELECT * FROM tbl_users 
			INNER JOIN tbl_users_files 		ON tbl_users_files.user_f_parent_id = tbl_users.user_id 
			INNER JOIN tbl_users_searchs 	ON tbl_users_searchs.user_s_parent_id = tbl_users.user_id 
			WHERE user_id = ".$userid." AND user_s_id = ".$searchid." ";
	
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
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							// Get information about this search
							$tmp_search_name 		= $objfields['user_s_name'];
							$tmp_search_who 		= $objfields['user_s_who'];
							$tmp_search_sql			= $objfields['user_s_sql'];
							$tmp_search_table		= $objfields['user_s_table'];
							$filename 				= $objfields['user_f_name'];
							$fcontents 				= file ($filename); 
							$tmp_sizeoffile			= sizeof($fcontents);
						//	echo "Temp Size of File ".$tmp_sizeoffile." <br>";
							$known_sids 			= 0;
							$nsql					= '';
							$scobby					= 1;
							$array_tables[0] 		= $tmp_search_table;
							//echo "Table to Search ".$array_tables[0]. "<br>";
							$totalsize				= getnumberoflistrows($array_tables[0]);
							//echo "Total Size of search table ".$totalsize." <br>";
							$totalexpectedcycles 	= ($tmp_sizeoffile * $totalsize); 
							//echo "Total Expected Cycles ".$totalexpectedcycles. " <BR>";
						}
				}
				mysqli_free_result($objrs_support);
				mysqli_close($objconn_support);
		}
		
//$function = "Ran a Saved Search Query with the following SQL Statement [ ".$sql." ] ";
//put_systemactivity($_SESSION["user_id"],$function);

if ($failed == 1) {
		// Did query fail?
		?>
			<tr>
				<td class="newTopicNames">
					There was a problem with your search query, Please try again or contact the system administrator
					</td>
				</tr>
		<?
	}
	else {
			?>
			<tr>
				<td colspan="11" class="newTopicBoxes">
					<table border="0" cellpadding=2 cellspacing=1>
						<tr>
							<td class="newTopicNames">
								Searching For 
								</td>
							<td class="newTopicBoxes">
								<?=$tmp_search_who;?>
								</td>	
							<tr>
						<tr>
							<td class="newTopicNames">
								Syntax Used 
								</td>
							<td class="newTopicBoxes">
								<?=$tmp_search_sql;?>
								</td>	
							<tr>
						<tr>
							<td class="newTopicNames">
								Syntax Used (decoded)
								</td>
							<td class="newTopicBoxes">
								<?
								$sql = urldecode($tmp_search_sql);	
								?>
								<?=$sql;?>
								</td>	
							<tr>
						</table>
					</td>
				</tr>
			<?
			$totalrowsprocessed = 0;
			$sql = urldecode($tmp_search_sql);	
			//echo "SQL Statement is ".$sql."<br>";
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
											updateuserqueries($userid);
											$totalcellsblanks = ( $totalcellsblanks + 1 );
											?>
			<tr>
				<td colspan="11" class="newTopicNames">
					There are no matches for <?=$tmp_search_who;?>
					</td>
				</tr>
											<?
										}
										else {
											$totalcellsfound = ($totalcellsfound + 1);
											?>
			<tr>
				<td class="newTopicTitle">
					SID
					</td>
				<td class="newTopicTitle">
					CLEARED
					</td>
				<td class="newTopicTitle">	
					LAST NAME
					</td>
				<td class="newTopicTitle">
					FIRST NAME
					</td>
				<td class="newTopicTitle">
					MIDDLE NAME
					</td>
				<td class="newTopicTitle">
					TYPE
					</td>
				<td class="newTopicTitle">
					DOB
					</td>
				<td class="newTopicTitle">
					POB
					</td>
				<td class="newTopicTitle">
					Citizanship
					</td>
				<td class="newTopicTitle">
					PASSPORT
					</td>
				<td class="newTopicTitle">
					MISC
					</td>
				</tr>
											<?
											//echo "At least one match was found for ".$arr[0].", ".$arr[1]." <br><br><br>";
										}
									//echo "number of rows ".$number_of_rows."<br>";
									//printf("result set has %d rows. \n", $number_of_rows);
									while ($newarray = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
											//echo "Main Loop Counter is ".$counter." - ";
											$tmp_id = $newarray['ruat_tsa_sid'];
											updateuserqueries($userid);
																		
											
											// Future Home of Debug Information
											
											
											if ($idarray[$tmp_id] == '') {
													//echo "Value does not exisit - Display Row";
													$idarray[$tmp_id] = $tmp_id;
													?>
													<tr>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_sid'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_cleared'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_last_name'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_first_name'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_middle_name'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_type'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_DOB'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_last_POB'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_citizanship'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_passport'];?>
															</td>
														<td class="newTopicNames">
															<?=$newarray['ruat_tsa_misc'];?>
															</td>
														</tr>											
														<?
												}
												else {
													//echo "Repeat Row<br>";
												}
										$counter = $counter + 1;
										}
										//echo "Number of Rows Found Across all Cycles ".$totalcellsfound." <br>";
										//echo "Number of Empty Returns Across all Cycles ".$totalcellsblanks." <br>";
										//echo "There are ".$totalsize." rows in each cycle <br>";
										//echo "Increase tmp_a by the totalsize <br>";
										$tmp_a	= ( $tmp_a + $totalsize );
										//echo ">>> a > The Value is ".$tmp_a." <br>";
										//echo "The DIV layer is 300 pixels wide, what percent of the pixel is completed? <br>";
										$tmp_b	= ( (300 / 1) / $totalexpectedcycles );
										//echo ">>> b >The Vlaue is ".$tmp_b." <br>";
										//echo "Take the percentage times the amount of records completed, and round the result <br>";
										$tmp_c	= round(( $tmp_b * $tmp_a ),0);
										//echo ">>> c > The Value is ".$tmp_c." <br>";
										//echo "What percent of the progress bar is completed? <br>";
										$tmp_d	= ( round( ( $tmp_c / 300 ), 4 ) * 100 );
										//echo ">>> d > The value is ".$tmp_d." <br>";
										//echo "--------------------------------------------------------------------- <br>";										
										?>
													<script>														
														document.getElementById("myDiv").style.display 		= "block";
														document.getElementById("myDiv_bar").style.display 	= "block";
														document.getElementById("myDiv_bar").style.width 	= "<?=$tmp_c;?>";
														document.getElementById("percent").innerHTML 		= "<font color='#FFFFFF'><?=$tmp_d;?>%</font>";
														//alert('You have unread messages \n Please check them by clicking the Notice Button');
														</script>
										<?	
								}
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
						}
	}
	?>
			<script>														
				document.getElementById("myDiv").style.display 		= "none";
				document.getElementById("myDiv_bar").style.display 	= "none";
				//alert('You have unread messages \n Please check them by clicking the Notice Button');
				</script>
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