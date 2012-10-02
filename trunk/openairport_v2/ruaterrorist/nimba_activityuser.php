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
//	Name of Document	:	_nimba_activityuser.php
//
//	Purpose of Page		:	FORM SIDE 	- no form settings
//							SERVER SIDE - Lists Admins track system activity
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
		$pagename = 'ADMIN - Manage Current System Activity';		
		
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
			RUAT - Activity Controls
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td colspan="3">
					<?
					breadcrumbs('nimba_activityuser.php', $pagename);
					?>
					</td>
				</tr>		
			<tr>
				<td colspan="3" class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="newTopicBoxes">
					<p>
						Listed below is the system activity for the RUAT system for the given period of time.
						</p>
					</td>
				</tr>
			<tr>
				<td colspan="3" class="newTopicBoxes">
					<table>
						<tr>						
							<form action="nimba_hideactivity.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes">
								<input type="hidden" name="userid" 	value="<?=$_POST['userid'];?>">
								<input type="submit" name="submit"	value="Hide System Activity" class="button">
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
							<?
							$num_to_display_per_page	= 15;
							$tmp_amount					= get_systemactivity_byuser($_POST['userid']);
							$dbl_num_pages				= ($tmp_amount / $num_to_display_per_page);
							$int_num_pages				= ($dbl_num_pages + 1);
							$int_num_pages				= (int)$int_num_pages;
							echo $tmp_amount." records have been found. ";
							$tmp_minrecord 				= ($displaypage * $num_to_display_per_page - $num_to_display_per_page);
							$tmp_maxrecord				= ($tmp_minrecord + $num_to_display_per_page);
							echo " You are displaying records ".$tmp_minrecord." through ".$tmp_maxrecord." ";
							?>
							<form action="nimba_activityuser.php" METHOD="POST" target="layouttableiframecontent" style="margin: 0px; margin-bottom:0px; margin-top:-1px;">
							<td class="newTopicBoxes" width="200" align="center" valign="middle">
								<input type="hidden" name="userid" 			value="<?=$_POST['userid'];?>">
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
				
<?
	$sql = "SELECT * FROM tbl_system_activity WHERE activity_user_id = ".$_POST['userid']."";
	
	$sql = $sql." ORDER BY activity_timestamp DESC ";
					// 	Determine Limit Ranges
						//echo "Display Page is ".$displaypage."<br>";
						$form_startcountat	= ($num_to_display_per_page * ($displaypage-1));			
						//echo $form_startcountat."<br>";
						$form_endcountat	= ($form_startcountat + $num_to_display_per_page);
						//echo $form_endcountat."<br>";
					// 	$sql2 = "SELECT * FROM ig_gallery WHERE is_visible = 'on' AND cat = ".$category." LIMIT ".$form_startcountat.",".$imagestoshowatatime."";
					
					$sql = $sql."LIMIT ".$form_startcountat.",".$num_to_display_per_page." ";
					
					//echo $sql;
					
					$tmp_end = ($num_to_display_per_page+$form_startcountat);
	
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
					Date / Time
					</td>
				<td class="newTopicTitle">
					User ID
					</td>					
				<td class="newTopicTitle">
					Function Performed
					</td>
				</tr>
						<?
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							?>
			<tr>
				<td class="newTopicBoxes">
					<?=$objfields['activity_timestamp'];?>
					</td>
				<td class="newTopicBoxes">
					<?
					$tmp_userid = getuseridname($objfields['activity_user_id']);
					?>
					<?=$tmp_userid;?>
					</td>				
				<td class="newTopicBoxes">
					<?=$objfields['activity_function'];?>
					</td>					
							<?
						}
						?>
			<tr>
				<td colspan="3" class="newTopicEnder">
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