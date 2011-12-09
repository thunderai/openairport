<?
/*	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
	
	Page Name						Purpose :
	NavFunctions.php					The purpose of this file is to allow for functions that can be used multiple times in many different files, cleaning up the apperence of the pages as well as increasing their usability.
	
								Usage:
								Just include this page in with your other page and the functions will be avilable to be used in that page.
								
								
								
								
	NOTE: THERE SHOULD BE NO NEED TO CHANGE ANY OF THE CODE ON THIS PAGE
	
	= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 
*/


// This function takes the supplied ID and developes a "Bread Crum Trail" from it
function buildbreadcrumtrail($menuitemidsupplied,$frmstartdate = '01/01/2000',$frmenddate = '12/31/2010') {
	// This is like doing the navigation menu but in reverse. Start with the ID of the menu item we know. We know 2 things: 1). The iD of the current Menu item and 2). What menu item it is slaved to.
	// we then do a search of the menu item it was slaved to looking at what menu items it is slaved to, repeaset until the slaved id is null.
		
	// Define Local Variables
		$layer4name 		= "";
		$layer4id 			= "";
		$layer4sid 		= "";
		$layer4url 		= "";
		$layer3name 		= "";
		$layer3id 			= "";
		$layer3sid 		= "";
		$layer3url 		= "";
		$layer2name 		= "";
		$layer2id 			= "";
		$layer2sid 		= "";
		$layer2url 		= "";
		$layer1name 		= "";
		$layer1id 			= "";
		$layer1sid 		= "";
		$layer1url 		= "";
	
	
	// Put HOME Menu Option In
	?>
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="cookietrail">
									<a href="index_new.php">Home</a> .\.
									</td>
	<?
	
	// Step 1, What is this menu item slaved to?
	$layer3menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
		
			$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$menuitemidsupplied."'";
			$layer3menures = mysqli_query($layer3menuconn, $sql);
			if ($layer3menures) {
					$number_of_rows = mysqli_num_rows($layer3menures);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
							$layer3id	= $layer3array['menu_item_slaved_to_id'];
							$layer3sid	= $layer3array['menu_item_id'];
							$layer3name	= $layer3array['menu_item_name_long'];
							$layer3url	= $layer3array['menu_item_location'];
							// We now have layer 3 information, we need layer 2 information
							
							// Get layer 2 information
							$layer2menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
							if (mysqli_connect_errno()) {
									// there was an error trying to connect to the mysql database
									printf("connect failed: %s\n", mysqli_connect_error());
									exit();
								}			
								else {
									$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$layer3id."'";
									$layer2menures = mysqli_query($layer2menuconn, $sql);
									if ($layer2menures) {
											$number_of_rows = mysqli_num_rows($layer2menures);
											//printf("result set has %d rows. \n", $number_of_rows);
											while ($layer2array = mysqli_fetch_array($layer2menures, MYSQLI_ASSOC)) {
													$layer2id	= $layer2array['menu_item_slaved_to_id'];
													$layer2sid	= $layer2array['menu_item_id'];
													$layer2name	= $layer2array['menu_item_name_long'];
													$layer2url	= $layer2array['menu_item_location'];
													// We now have layer 2 information, we need layer 1 information
													
													// Get layer 1 information
													$layer1menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
													if (mysqli_connect_errno()) {
															// there was an error trying to connect to the mysql database
															printf("connect failed: %s\n", mysqli_connect_error());
															exit();
														}			
														else {
															$sql = "select * from tbl_navigational_control where tbl_navigational_control.menu_item_id = '".$layer2id."'";
															$layer1menures = mysqli_query($layer1menuconn, $sql);
															if ($layer1menures) {
																	$number_of_rows = mysqli_num_rows($layer1menures);
																	//printf("result set has %d rows. \n", $number_of_rows);
																	while ($layer1array = mysqli_fetch_array($layer1menures, MYSQLI_ASSOC)) {
																			$layer1id	= $layer1array['menu_item_slaved_to_id'];
																			$layer1sid	= $layer1array['menu_item_id'];
																			$layer1name	= $layer1array['menu_item_name_long'];
																			$layer1url	= $layer1array['menu_item_location'];
																			// We now have layer 1 information, we are done.
						
																		}	// End of layer 1 while loop
																		mysqli_free_result($layer1menures);
																		mysqli_close($layer1menuconn);
																} 	// end of layer 1 active object if statement
															}	// end of layer 1 open connection
												}	// End of layer 2 while loop
												mysqli_free_result($layer2menures);
												mysqli_close($layer2menuconn);
										} 	// end of layer 2 active object if statement
									}	// end of layer 2 open connection
						}	// End of layer 3 while loop
						mysqli_free_result($layer3menures);
						mysqli_close($layer3menuconn);
				} 	// end of layer 3 active object if statement
			}	// end of layer 3 open connection
	
			if ($layer1url=="unslaved") {					
					?>
								<td class="cookietrail">
									<?=$layer1name?> .\\.
									</td>
					<?
				}
				else {
					if ($layer1name=="") {
							// There is nothing to display
						}
						else {
					?>				
								<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitemlayer1" method="POST" action="<?=$layer1url?>?frmstartdate=<?=$frmstartdate;?>&frmenddate=<?=$frmenddate;?>">
								<td class="cookietrail">
									<input type="hidden" name="menuitemid" value="<?=$layer1sid;?>">
									<a href="#" onclick="javascript:document.menuitemlayer1.submit()"><?=$layer1name?></a> .\\.
									</td>
									</form>
					<?
						}
				}
			if ($layer2url=="unslaved") {					
					?>
								<td class="cookietrail">
									<?=$layer2name?> .\\.
									</td>
					<?
				}
				else {
					if ($layer2name=="") {
							// There is nothing to display
						}
						else {
					?>				
								<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitemlayer2" method="POST" action="<?=$layer2url?>?frmstartdate=<?=$frmstartdate;?>&frmenddate=<?=$frmenddate;?>">
								<td class="cookietrail">
									<input type="hidden" name="menuitemid" value="<?=$layer2sid;?>">
									<a href="#" onclick="javascript:document.menuitemlayer2.submit()"><?=$layer2name?></a> .\\.
									</td>
									</form>
					<?
						}
				}
			if ($layer3url=="unslaved") {					
					?>
								<td class="cookietrail">
									<?=$layer3name?> .\\\.
									</td>
					<?
				}
				else {
						if ($layer3name=="") {
							// There is nothing to display
						}
						else {
					?>				
								<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitemlayer3" method="POST" action="<?=$layer3url?>?frmstartdate=<?=$frmstartdate;?>&frmenddate=<?=$frmenddate;?>">
								<td class="cookietrail">
									<input type="hidden" name="menuitemid" value="<?=$layer3sid;?>">
									<a href="#" onclick="javascript:document.menuitemlayer3.submit()"><?=$layer3name?></a> .\\\.
									</td>
									</form>
					<?
						}
				}
			if ($layer4url=="unslaved") {					
					?>
								<td class="cookietrail">
									<?=$layer4name?> .\\\\.
									</td>
					<?
				}
				else {
					if ($layer4name=="") {
							// There is nothing to display
						}
						else {
					?>				
								<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitemlayer4" method="POST" action="<?=$layer4url?>">
								<td class="cookietrail">
									<input type="hidden" name="menuitemid" value="<?=$layer4sid;?>">
									<a href="#" onclick="javascript:document.menuitemlayer4.submit()"><?=$layer4name?></a> .\\\\.
									</td>
									</form>
					<?
						}
				}
				?>
			</tr>
		</table>
	<?
}

// This function takes the supplied ID and prints out the Long name of the menu item
function getnameofmenuitemid($menuitemidsupplied,$displayfield,$fontsize,$fontcolor,$session_user) {

	$layer3menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
		$sql = "select tbl_systemusers.emp_record_id, tbl_systemusers.emp_firstname, tbl_systemusers.emp_lastname, tbl_systemusers.emp_initials, tbl_systemusers_ncga.navigational_access_id, tbl_systemusers_ncga.navigational_user_id_cb_int, tbl_systemusers_ncga.navigational_user_id_cb_txt, tbl_systemusers_ncga.navigational_group_id_cb_int, tbl_systemusers_ncga.navigational_group_id_cb_txt, tbl_navigational_control_g.navigational_groups_id, tbl_navigational_control_g.navigational_groups_name, tbl_navigational_control_g_a.navigational_access_id,
		tbl_navigational_control_g_a.navigational_groups_id_cb_int, tbl_navigational_control_g_a.navigational_groups_id_cb_txt, tbl_navigational_control_g_a.navigational_control_id_cb_int, tbl_navigational_control_g_a.navigational_control_id_cb_txt, tbl_navigational_control.menu_item_id, tbl_navigational_control.menu_item_location, tbl_navigational_control.menu_item_name_long, tbl_navigational_control.menu_item_name_short, tbl_navigational_control.menu_item_slaved_to_id, tbl_navigational_control.menu_item_archived_yn
		from tbl_navigational_control inner join ((tbl_navigational_control_g inner join (tbl_systemusers inner join tbl_systemusers_ncga on tbl_systemusers.emp_record_id = tbl_systemusers_ncga.navigational_user_id_cb_int) on tbl_navigational_control_g.navigational_groups_id = tbl_systemusers_ncga.navigational_group_id_cb_int) inner join tbl_navigational_control_g_a on tbl_navigational_control_g.navigational_groups_id = tbl_navigational_control_g_a.navigational_groups_id_cb_int) on tbl_navigational_control.menu_item_id = tbl_navigational_control_g_a.navigational_control_id_cb_int
		where tbl_navigational_control.menu_item_id = '".$menuitemidsupplied."' AND tbl_systemusers.emp_record_id = '".$session_user."'";
		
		$layer3menures = mysqli_query($layer3menuconn, $sql);
						
			if ($layer3menures) {
					$number_of_rows = mysqli_num_rows($layer3menures);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
							if ($displayfield == "long") {
									$tmpfieldname	= $layer3array['menu_item_name_long'];
								}
								else {
									$tmpfieldname	= $layer3array['menu_item_name_short'];
								}
							?>
							<font color="<?=$fontcolor;?>" face="arial narrow" size="<?=$fontsize;?>"><?=$tmpfieldname;?></font>
							<?
						}
						mysqli_free_result($layer3menures);
						mysqli_close($layer3menuconn);
				} 	
			}	
	}

// This function takes the supplied ID and prints out the purpose of the menu item
function getpurposeofmenuitemid($menuitemidsupplied,$fontsize,$fontcolor,$session_user) {

	$layer3menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
		$sql = "select tbl_systemusers.emp_record_id, tbl_systemusers.emp_firstname, tbl_systemusers.emp_lastname, tbl_systemusers.emp_initials, tbl_systemusers_ncga.navigational_access_id, tbl_systemusers_ncga.navigational_user_id_cb_int, tbl_systemusers_ncga.navigational_user_id_cb_txt, tbl_systemusers_ncga.navigational_group_id_cb_int, tbl_systemusers_ncga.navigational_group_id_cb_txt, tbl_navigational_control_g.navigational_groups_id, tbl_navigational_control_g.navigational_groups_name, tbl_navigational_control_g_a.navigational_access_id,
		tbl_navigational_control_g_a.navigational_groups_id_cb_int, tbl_navigational_control_g_a.navigational_groups_id_cb_txt, tbl_navigational_control_g_a.navigational_control_id_cb_int, tbl_navigational_control_g_a.navigational_control_id_cb_txt, tbl_navigational_control.menu_item_id, tbl_navigational_control.menu_item_location, tbl_navigational_control.menu_item_name_long, tbl_navigational_control.menu_item_name_short, tbl_navigational_control.menu_item_slaved_to_id, tbl_navigational_control.menu_item_archived_yn, tbl_navigational_control.menu_item_purpose
		from tbl_navigational_control inner join ((tbl_navigational_control_g inner join (tbl_systemusers inner join tbl_systemusers_ncga on tbl_systemusers.emp_record_id = tbl_systemusers_ncga.navigational_user_id_cb_int) on tbl_navigational_control_g.navigational_groups_id = tbl_systemusers_ncga.navigational_group_id_cb_int) inner join tbl_navigational_control_g_a on tbl_navigational_control_g.navigational_groups_id = tbl_navigational_control_g_a.navigational_groups_id_cb_int) on tbl_navigational_control.menu_item_id = tbl_navigational_control_g_a.navigational_control_id_cb_int
		where tbl_navigational_control.menu_item_id = '".$menuitemidsupplied."' AND tbl_systemusers.emp_record_id = '".$session_user."'";
		
		$layer3menures = mysqli_query($layer3menuconn, $sql);
						
			if ($layer3menures) {
					$number_of_rows = mysqli_num_rows($layer3menures);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
						$tmpfieldname	= $layer3array['menu_item_purpose'];
							?>
							<font color="<?=$fontcolor;?>" face="arial narrow" size="<?=$fontsize;?>"><?=$tmpfieldname;?></font>
							<?
						}
						mysqli_free_result($layer3menures);
						mysqli_close($layer3menuconn);
				} 	
			}	
	}
	

function loadnavmenu($whoareyou) {

	if ($whoareyou == '') {
			// No User, force relogin
			?>
																<form name="redirect" action="newlogin.php" method="POST">
																<input class="combobox" type="hidden" size="1" name="redirect2">
																<script>
																	<!--
																		var targetURL="newlogin.php"
																		var countdownfrom=1
																		var currentsecond=document.redirect.redirect2.value=countdownfrom+1
																		function countredirect(){
																			if (currentsecond!=1){
																				currentsecond-=1
																				document.redirect.redirect2.value=currentsecond
																				}
																				else{
																					document.redirect.submit();
																			return
																			}
																			setTimeout("countredirect()",0)
																			}
																			countredirect()
																	//-->
																	</script>
																	</form>			
			<?
		}
		else {
	
?>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="100%" class="tableheadercenter">
					Menu Items
					</td>
				</tr>
			</table>
<?
// set a variable to null;
$tmpnull = "200";

$tmpmenuitemidl1 = "";
$tmpmenuitemidl2 = "";
$tmpmenuitemidl3 = "";
$tmpmenuitemidl4 = "";


//get current user id and place it into a temporary variable
$tmpuserid = $_SESSION["user_id"];

	// start main code for navigational control and menu system 
	
	// start layer 1 search, look for menu items that are not slaved to any other menu item.
	
	$layer1menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			// load sql syntax with search criteria
			$sql = 	"SELECT 
							tbl_systemusers.emp_record_id, 
							tbl_systemusers_ncga.navigational_user_id_cb_int, 
							tbl_systemusers_ncga.navigational_group_id_cb_int, 
							tbl_navigational_control.menu_item_id, 
							tbl_navigational_control.menu_item_location, 
							tbl_navigational_control.menu_item_slaved_to_id, 
							tbl_navigational_control.menu_item_name_long, 
							tbl_navigational_control.menu_item_name_short, 
							tbl_navigational_control.menu_item_archived_yn, 
							tbl_navigational_control_g.navigational_groups_id, 
							tbl_navigational_control_g.navigational_groups_id, 
							tbl_navigational_control_g_a.navigational_archived_yn, 
							tbl_navigational_control_g_a.navigational_groups_id_cb_int,
							tbl_navigational_control_g_a.navigational_control_id_cb_int 
					FROM tbl_systemusers			
					INNER JOIN tbl_systemusers_ncga 		ON tbl_systemusers.emp_record_id 								= tbl_systemusers_ncga.navigational_user_id_cb_int
					INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
					INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
					INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
					WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' and tbl_navigational_control.menu_item_root_yn = 1 and tbl_navigational_control.menu_item_name_long <> 'Root' and tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
					ORDER BY tbl_navigational_control.menu_item_name_short asc";
			$layer1menures = mysqli_query($layer1menuconn, $sql);
							
			if ($layer1menures) {
					?>
		<div class="menu">
			<ul>
					<?
					// put the number of rows found into a new variable
					$number_of_rows = mysqli_num_rows($layer1menures);
					
					//printf("result set has %d rows. \n", $number_of_rows);
					
					while ($layer1array = mysqli_fetch_array($layer1menures, MYSQLI_ASSOC)) {
						ob_flush();
						flush();
						$tmpfirstnamel1 	= $layer1array['emp_firstname'];
						$tmplastnamel1 	   	= $layer1array['emp_lastname'];
						$tmpmenuitemlocl1	= $layer1array['menu_item_location'];
						$tmpuseridl1 		= $layer1array['emp_record_id'];
						$tmpmenuslaveidl1	= $layer1array['menu_item_slaved_to_id'];
						$tmpmenusshortnl1  	= $layer1array['menu_item_name_short'];
						$tmpmenuitemidl1	= $layer1array['menu_item_id'];
						$tmpmenulongl1		= $layer1array['menu_item_name_long'];
					?>
				<li class="sub" style="margin-top: 0px;"><a href="javascript:call_server_menuitem_feeder(<?=$tmpmenuitemidl1;?>,'<?=$tmpmenuitemlocl1;?>')" onMouseover="ddrivetip('<?php echo $tmpmenulongl1; ?>')"; onMouseout="hideddrivetip()"><?=$tmpmenusshortnl1;?>
				<!--[if IE 7]><!--></a><!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
					<?
					ob_flush();
					flush();
					//-----[ start layer 2 menu search]-------------------------------------------------
					
						$layer2menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}
							else {
								$sql = 	"SELECT 
												tbl_systemusers.emp_record_id, 
												tbl_systemusers_ncga.navigational_user_id_cb_int, 
												tbl_systemusers_ncga.navigational_group_id_cb_int, 
												tbl_navigational_control.menu_item_id, 
												tbl_navigational_control.menu_item_location, 
												tbl_navigational_control.menu_item_slaved_to_id, 
												tbl_navigational_control.menu_item_name_long, 
												tbl_navigational_control.menu_item_name_short, 
												tbl_navigational_control.menu_item_archived_yn, 
												tbl_navigational_control_g.navigational_groups_id, 
												tbl_navigational_control_g.navigational_groups_id, 
												tbl_navigational_control_g_a.navigational_archived_yn, 
												tbl_navigational_control_g_a.navigational_groups_id_cb_int,
												tbl_navigational_control_g_a.navigational_control_id_cb_int 
										FROM tbl_systemusers			
										INNER JOIN tbl_systemusers_ncga 		ON tbl_systemusers.emp_record_id 								= tbl_systemusers_ncga.navigational_user_id_cb_int
										INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
										INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
										INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
										WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' and tbl_navigational_control.menu_item_slaved_to_id = '".$tmpmenuitemidl1."' AND tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
										ORDER BY tbl_navigational_control.menu_item_name_short asc";	
								$layer2menures = mysqli_query($layer2menuconn, $sql);
						
								if ($layer2menures) {
										?>
					<ul>
										<?
										$number_of_rows = mysqli_num_rows($layer2menures);
										//printf("result set has %d rows. \n", $number_of_rows);
										while ($layer2array = mysqli_fetch_array($layer2menures, MYSQLI_ASSOC)) {
											ob_flush();
											flush();
											$tmpfirstnamel2 	= $layer2array['emp_firstname'];
											$tmplastnamel2 	    = $layer2array['emp_lastname'];
											$tmpmenuitemlocl2	= $layer2array['menu_item_location'];
											$tmpuseridl2 		= $layer2array['emp_record_id'];
											$tmpmenuslaveidl2	= $layer2array['menu_item_slaved_to_id'];
											$tmpmenusshortnl2   = $layer2array['menu_item_name_short'];
											$tmpmenuitemidl2	= $layer2array['menu_item_id'];
											$tmpmenulongl2		= $layer2array['menu_item_name_long'];
											
											if ($tmpmenuitemlocl2=="unslaved") {
													?>
						<!--maybe-->	<li class="menuitem" style="<!--[if lte IE 6]>margin-top:-4px;<![endif]-->"><a href="javascript:call_server_menuitem_feeder(<?=$tmpmenuitemidl2;?>,'<?=$tmpmenuitemlocl2;?>' onMouseover="ddrivetip('<?php echo $tmpmenulongl2; ?>')"; onMouseout="hideddrivetip()"><?=$tmpmenusshortnl2;?>
													<?
												}
												else {
													?>
						<!--maybe-->	<li class="menuitemselect" style="<!--[if lte IE 6]>margin-top:-3px;<![endif]-->">
									<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?=$tmpmenuitemidl2;?>" method="POST" action="<?=$tmpmenuitemlocl2;?>" target="layouttableiframecontent">
										<input type="hidden" name="menuitemid" value="<?=$tmpmenuitemidl2;?>">
										<a href="#" onclick="javascript:document.menuitem<?=$tmpmenuitemidl2;?>.submit()" onMouseover="ddrivetip('<?php echo $tmpmenulongl2; ?>')"; onMouseout="hideddrivetip()"><?=$tmpmenusshortnl2;?></a>
										</form>
													<?
												}	
											//-----[ start layer 3 menu search]-------------------------------------------------
					
											$layer3menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
											if (mysqli_connect_errno()) {
													// there was an error trying to connect to the mysql database
													printf("connect failed: %s\n", mysqli_connect_error());
													exit();
													}
												else {
													$sql = 	"SELECT 
																	tbl_systemusers.emp_record_id, 
																	tbl_systemusers_ncga.navigational_user_id_cb_int, 
																	tbl_systemusers_ncga.navigational_group_id_cb_int, 
																	tbl_navigational_control.menu_item_id, 
																	tbl_navigational_control.menu_item_location, 
																	tbl_navigational_control.menu_item_slaved_to_id, 
																	tbl_navigational_control.menu_item_name_long, 
																	tbl_navigational_control.menu_item_name_short, 
																	tbl_navigational_control.menu_item_archived_yn, 
																	tbl_navigational_control_g.navigational_groups_id, 
																	tbl_navigational_control_g.navigational_groups_id, 
																	tbl_navigational_control_g_a.navigational_archived_yn, 
																	tbl_navigational_control_g_a.navigational_groups_id_cb_int,
																	tbl_navigational_control_g_a.navigational_control_id_cb_int 
															FROM tbl_systemusers			
															INNER JOIN tbl_systemusers_ncga 			ON tbl_systemusers.emp_record_id 							= tbl_systemusers_ncga.navigational_user_id_cb_int
															INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
															INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
															INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
															WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' and tbl_navigational_control.menu_item_slaved_to_id = '".$tmpmenuitemidl2."' AND tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
															ORDER BY tbl_navigational_control.menu_item_name_short asc";		
													$layer3menures = mysqli_query($layer3menuconn, $sql);
						
													if ($layer3menures) {
															?>
						<!--[if IE 7]><!--></a><!--<![endif]-->
						<!--[if lte IE 6]><table><tr><td><![endif]-->
							<ul>
															<?
															$number_of_rows = mysqli_num_rows($layer3menures);
															//printf("result set has %d rows. \n", $number_of_rows);
															while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
																ob_flush();
																flush();
																$tmpfirstnamel3 	= $layer3array['emp_firstname'];
																$tmplastnamel3 	    = $layer3array['emp_lastname'];
																$tmpmenuitemlocl3	= $layer3array['menu_item_location'];
																$tmpuseridl3 		= $layer3array['emp_record_id'];
																$tmpmenuslaveidl3	= $layer3array['menu_item_slaved_to_id'];
																$tmpmenusshortnl3   = $layer3array['menu_item_name_short'];
																$tmpmenuitemidl3	= $layer3array['menu_item_id'];
																$tmpmenulongl3		= $layer3array['menu_item_name_long'];
																
																if ($tmpmenuitemlocl3=="unslaved") {
																		?>
						<!--maybe-->	<li class="menuitem" style="<!--[if lte IE 6]>margin-top:-3px;<![endif]-->"><a href="javascript:call_server_menuitem_feeder(<?=$tmpmenuitemidl3;?>,'<?=$tmpmenuitemlocl3;?>')" onMouseover="ddrivetip('<?php echo $tmpmenulongl3; ?>')"; onMouseout="hideddrivetip()"><?=$tmpmenusshortnl3;?>
																		<?
																	}
																	else {
																		?>
						<!--maybe-->	<li class="menuitemselect" style="<!--[if lte IE 6]>margin-top:-3px;<![endif]-->">
									<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?=$tmpmenuitemidl3;?>" method="POST" action="<?=$tmpmenuitemlocl3;?>" target="layouttableiframecontent">
										<input type="hidden" name="menuitemid" value="<?=$tmpmenuitemidl3;?>">
										<a href="#" onclick="javascript:document.menuitem<?=$tmpmenuitemidl3;?>.submit()" onMouseover="ddrivetip('<?php echo $tmpmenulongl3; ?>')"; onMouseout="hideddrivetip()"><?=$tmpmenusshortnl3;?></a>
										</form>
																		<?
																	}	
																//-----[ start layer 4 menu search]-------------------------------------------------
					
																$layer4menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
																if (mysqli_connect_errno()) {
																		// there was an error trying to connect to the mysql database
																		printf("connect failed: %s\n", mysqli_connect_error());
																		exit();
																	}
																	else {
																		$sql = 	"SELECT 
																						tbl_systemusers.emp_record_id, 
																						tbl_systemusers_ncga.navigational_user_id_cb_int, 
																						tbl_systemusers_ncga.navigational_group_id_cb_int, 
																						tbl_navigational_control.menu_item_id, 
																						tbl_navigational_control.menu_item_location, 
																						tbl_navigational_control.menu_item_slaved_to_id, 
																						tbl_navigational_control.menu_item_name_long, 
																						tbl_navigational_control.menu_item_name_short, 
																						tbl_navigational_control.menu_item_archived_yn, 
																						tbl_navigational_control_g.navigational_groups_id, 
																						tbl_navigational_control_g.navigational_groups_id, 
																						tbl_navigational_control_g_a.navigational_archived_yn, 
																						tbl_navigational_control_g_a.navigational_groups_id_cb_int,
																						tbl_navigational_control_g_a.navigational_control_id_cb_int 
																				FROM tbl_systemusers			
																				INNER JOIN tbl_systemusers_ncga 			ON tbl_systemusers.emp_record_id 							= tbl_systemusers_ncga.navigational_user_id_cb_int
																				INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
																				INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
																				INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
																				WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' and tbl_navigational_control.menu_item_slaved_to_id = '".$tmpmenuitemidl3."' AND tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
																				ORDER BY tbl_navigational_control.menu_item_name_short asc";	
																		$layer4menures = mysqli_query($layer4menuconn, $sql);
						
																		if ($layer4menures) {
																				?>
						<!--[if IE 7]><!--></a><!--<![endif]-->
						<!--[if lte IE 6]><table><tr><td><![endif]-->
							<ul>
																				<?
																				$number_of_rows = mysqli_num_rows($layer3menures);
																				//printf("result set has %d rows. \n", $number_of_rows);
																				while ($layer4array = mysqli_fetch_array($layer4menures, MYSQLI_ASSOC)) {
																						ob_flush();
																						flush();
																						$tmpfirstnamel4 	= $layer4array['emp_firstname'];
																						$tmplastnamel4 	    = $layer4array['emp_lastname'];
																						$tmpmenuitemlocl4	= $layer4array['menu_item_location'];
																						$tmpuseridl4 		= $layer4array['emp_record_id'];
																						$tmpmenuslaveidl4	= $layer4array['menu_item_slaved_to_id'];
																						$tmpmenusshortnl4   = $layer4array['menu_item_name_short'];
																						$tmpmenuitemidl4	= $layer4array['menu_item_id'];
																						$tmpmenulongl4		= $layer4array['menu_item_name_long'];
															
																						if ($tmpmenuitemlocl4=="unslaved") {
																								?>
						<!--maybe-->	<li class="menuitem" style="<!--[if lte IE 6]>margin-top:-3px;<![endif]-->"><a href="javascript:call_server_menuitem_feeder(<?=$tmpmenuitemidl4;?>,'<?=$tmpmenuitemlocl4;?>')" onMouseover="ddrivetip('<?php echo $tmpmenulongl4; ?>')"; onMouseout="hideddrivetip()"><?=$tmpmenusshortnl4;?>
																								<?
																							}
																							else {
																								?>
						<!--maybe-->	<li class="menuitemselect" style="<!--[if lte IE 6]>margin-top:-3px;<![endif]-->">
									<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?=$tmpmenuitemidl4;?>" method="POST" action="<?=$tmpmenuitemlocl4;?>" target="layouttableiframecontent">
										<input type="hidden" name="menuitemid" value="<?=$tmpmenuitemidl4;?>">
										<a href="#" onclick="javascript:document.menuitem<?=$tmpmenuitemidl4;?>.submit()" onMouseover="ddrivetip('<?php echo $tmpmenulongl4; ?>')"; onMouseout="hideddrivetip()"><?=$tmpmenusshortnl4;?></a>
										</form>
																								<?
																							}	
																					}	// end of layer 4 while statement
																					mysqli_free_result($layer4menures);
																					mysqli_close($layer4menuconn);																					
																					?>
								</ul>
																					<?
																			} 	// end of layer 4 if statement
																			?>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
																			<?
																		}	// end of layer 4 else statement
																}	// end of layer 3 while statement
																mysqli_free_result($layer3menures);
																mysqli_close($layer3menuconn);
																?>
								</ul>
																<?
														} 	// end of layer 3 if statement
													?>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
													<?
													
												
													}	//-----[ end of layer 3 menu search]-------------------------------------------------	
										
										
											}	// end of layer 2 while statement
											mysqli_free_result($layer2menures);
											mysqli_close($layer2menuconn);
										?>
						</ul>
						<!--[if lte IE 6]></td></tr></table></a><![endif]-->
					</li>
										<?
									} 	// end of layer 2 if statement
								}	//-----[ end of layer 2 menu search]-------------------------------------------------	
						}	// end of the while loop for layer 1 menu structure
						mysqli_free_result($layer1menures);
						mysqli_close($layer1menuconn);
								?>
				</ul>
			</div>
								<?
				}
			}
		}	
	}	// End of Function

function loadnavmenu2() {

// set a variable to null;
$tmpnull = "200";

$tmpmenuitemidl1 = "";
$tmpmenuitemidl2 = "";
$tmpmenuitemidl3 = "";
$tmpmenuitemidl4 = "";


//get current user id and place it into a temporary variable
$tmpuserid = $_SESSION["user_id"];

	// start main code for navigational control and menu system 
	
	// start layer 1 search, look for menu items that are not slaved to any other menu item.
	
	$layer1menuconn = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			// load sql syntax with search criteria
			$sql = 	"SELECT 
							tbl_systemusers.emp_record_id, 
							tbl_systemusers_ncga.navigational_user_id_cb_int, 
							tbl_systemusers_ncga.navigational_group_id_cb_int, 
							tbl_navigational_control.menu_item_id, 
							tbl_navigational_control.menu_item_location, 
							tbl_navigational_control.menu_item_slaved_to_id, 
							tbl_navigational_control.menu_item_name_long, 
							tbl_navigational_control.menu_item_name_short, 
							tbl_navigational_control.menu_item_archived_yn, 
							tbl_navigational_control_g.navigational_groups_id, 
							tbl_navigational_control_g.navigational_groups_id, 
							tbl_navigational_control_g_a.navigational_archived_yn, 
							tbl_navigational_control_g_a.navigational_groups_id_cb_int,
							tbl_navigational_control_g_a.navigational_control_id_cb_int 
					FROM tbl_systemusers			
					INNER JOIN tbl_systemusers_ncga 			ON tbl_systemusers.emp_record_id 							= tbl_systemusers_ncga.navigational_user_id_cb_int
					INNER JOIN tbl_navigational_control_g 	ON tbl_navigational_control_g.navigational_groups_id 			= tbl_systemusers_ncga.navigational_group_id_cb_int
					INNER JOIN tbl_navigational_control_g_a	ON tbl_navigational_control_g_a.navigational_groups_id_cb_int	= tbl_navigational_control_g.navigational_groups_id
					INNER JOIN tbl_navigational_control		ON tbl_navigational_control.menu_item_id						= tbl_navigational_control_g_a.navigational_control_id_cb_int
					WHERE tbl_systemusers.emp_record_id = '".$tmpuserid."' AND tbl_navigational_control.menu_item_archived_yn = 0 AND tbl_navigational_control_g_a.navigational_archived_yn = 0  
					ORDER BY tbl_navigational_control.menu_item_name_short asc";
			$layer1menures = mysqli_query($layer1menuconn, $sql);
							
			if ($layer1menures) {
					?>
					<?
					// put the number of rows found into a new variable
					$number_of_rows = mysqli_num_rows($layer1menures);
					
					//printf("result set has %d rows. \n", $number_of_rows);
					
					while ($layer1array = mysqli_fetch_array($layer1menures, MYSQLI_ASSOC)) {
						//ob_flush();
						//flush();
						$tmpfirstnamel1 		= $layer1array['emp_firstname'];
						$tmplastnamel1 	    	= $layer1array['emp_lastname'];
						$tmpmenuitemlocl1	= $layer1array['menu_item_location'];
						$tmpuseridl1 		= $layer1array['emp_record_id'];
						$tmpmenuslaveidl1	= $layer1array['menu_item_slaved_to_id'];
						$tmpmenusshortnl1   	= $layer1array['menu_item_name_short'];
						$tmpmenuitemidl1		= $layer1array['menu_item_id'];
					?>
				<?=$tmpmenuitemidl1;?><?=$tmpmenuitemlocl1;?><?=$tmpmenusshortnl1;?>
				<br>
					<?
						}	// end of the while loop for layer 1 menu structure
						mysqli_free_result($layer1menures);
						mysqli_close($layer1menuconn);
								?>
								<?
				}
			}
	}	// End of Function
	
function newnavigationalmenusystem() {
	?>
<div class="menu">
<ul>
<li><a href="#nogo">Item 1</a></li>
<li><a href="#nogo">Item 2</a></li>
<li><a href="#nogo">Item 3 &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
<!--[if lte IE 6]><table><tr><td><![endif]-->
	<ul>
	<li><a href="#nogo">Item 3a</a></li>
	<li><a href="#nogo">Item 3b &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
	<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li><a href="#nogo">Item 3bi</a></li>
			<li><a href="#nogo">Item 3bii &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="#nogo">Item 3bii-1</a></li>
					<li><a href="#nogo">Item 3bii-2</a></li>
					<li><a href="#nogo">Item 3bii-3</a></li>
					<li><a href="#nogo">Item 3bii-4</a></li>
					<li><a href="#nogo">Item 3bii-5</a></li>
					<li><a href="#nogo">Item 3bii-6</a></li>
					<li><a href="#nogo">Item 3bii-7</a></li>
					<li><a href="#nogo">Item 3bii-8</a></li>
				</ul>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			<li><a href="#nogo">Item 3biii &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="#nogo">Item 3biii-1</a></li>
					<li><a href="#nogo">Item 3biii-2</a></li>
					<li><a href="#nogo">Item 3biii-3</a></li>
					<li><a href="#nogo">Item 3biii-4</a></li>
				</ul>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
		</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li><a href="#nogo">Item 3c</a></li>
	<li><a href="#nogo">Item 3d</a></li>
	<li><a href="#nogo">Item 3e</a></li>
	<li><a href="#nogo">Item 3f</a></li>
	<li><a href="#nogo">Item 3g &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
	<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li><a href="#nogo">Item 3gi &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="#nogo">Item 3gi-1</a></li>
					<li><a href="#nogo">Item 3gi-2</a></li>
					<li><a href="#nogo">Item 3gi-3</a></li>
					<li><a href="#nogo">Item 3gi-4</a></li>
					<li><a href="#nogo">Item 3gi-5</a></li>
					<li><a href="#nogo">Item 3gi-6</a></li>
				</ul>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			<li><a href="#nogo">Item 3gii</a></li>
			<li><a href="#nogo">Item 3giii &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="#nogo">Item 3giii-1</a></li>
					<li><a href="#nogo">Item 3giii-2</a></li>
					<li><a href="#nogo">Item 3giii-3</a></li>
					<li><a href="#nogo">Item 3giii-4</a></li>
				</ul>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			<li><a href="#nogo">Item 3giv</a></li>
			<li><a href="#nogo">Item 3gv</a></li>
		</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li><a href="#nogo">Item 3h</a></li>
	<li><a href="#nogo">Item 3i</a></li>
	</ul>
<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
<li><a href="#nogo">Item 4</a></li>
<li><a href="#nogo">Item 5</a></li>
<li><a href="#nogo">Item 6 &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
<!--[if lte IE 6]><table><tr><td><![endif]-->
	<ul>
	<li><a href="#nogo">Item 6a</a></li>
	<li><a href="#nogo">Item 6b &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
	<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li><a href="#nogo">Item 6bi</a></li>
			<li><a href="#nogo">Item 6bii &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="#nogo">Item 6bii-1</a></li>
					<li><a href="#nogo">Item 6bii-2</a></li>
					<li><a href="#nogo">Item 6bii-3</a></li>
					<li><a href="#nogo">Item 6bii-4</a></li>
				</ul>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
		</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li><a href="#nogo">Item 6c</a></li>
	<li><a href="#nogo">Item 6d</a></li>
	<li><a href="#nogo">Item 6e</a></li>
	<li><a href="#nogo">Item 6f</a></li>
	<li><a href="#nogo">Item 6g &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
	<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			<li><a href="#nogo">Item 6gi &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="#nogo">Item 6gi-1</a></li>
					<li><a href="#nogo">Item 6gi-2</a></li>
					<li><a href="#nogo">Item 6gi-3</a></li>
				</ul>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			<li><a href="#nogo">Item 6gii</a></li>
			<li><a href="#nogo">Item 6giii &#187;<!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
				<ul>
					<li><a href="#nogo">Item 6giii-1</a></li>
					<li><a href="#nogo">Item 6giii-2</a></li>
					<li><a href="#nogo">Item 6giii-3</a></li>
					<li><a href="#nogo">Item 6giii-4</a></li>
					<li><a href="#nogo">Item 6giii-5</a></li>
					<li><a href="#nogo">Item 6giii-6</a></li>
					<li><a href="#nogo">Item 6giii-7</a></li>
					<li><a href="#nogo">Item 6giii-8</a></li>
					<li><a href="#nogo">Item 6giii-9</a></li>
				</ul>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
		</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
	<li><a href="#nogo">Item 6h</a></li>
	<li><a href="#nogo">Item 6i</a></li>
	</ul>
<!--[if lte IE 6]></td></tr></table></a><![endif]-->
</li>
<li><a href="#nogo">Item 7</a></li>
</ul>
</div>	
	
	
	
	<?
	
	}	// End of Function
	
function navigationalcombobox($menu_id, $archived, $nameofinput, $showcombobox, $default) {
	// $menu_id		, is the number of the menu item to do the search for ;
	// $archived		, do you want to list all menu items, or just the archived ones;
	// $nameofinout		, what is the name of the select box that 'could' be ceated by this function;
	// $showcombobox	, Do you want to show the combo box select input style or just the text without the input box;
	// $default			, What is the default menu item to display in the combobox when it is displayed;

	// Examples
	
	//	$adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
	// This example will only show one record, and it will not be in a combobox input box, but rather be displayed as text.
	
	
	$sql	= "";																				// Define the sql variable, just in case
	$nsql 	= "";																				// Define the nsql variable, just in case
	
	$sql = "SELECT * FROM tbl_navigational_control ";											// start the SQL Statement with the common syntax

	if ($menu_id=="all") {																		// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `menu_item_id` = ".$menu_id." ";										// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_navigational_control.menu_item_archived_yn = -1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_navigational_control.menu_item_archived_yn = -1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_navigational_control.menu_item_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_navigational_control.menu_item_archived_yn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	
	$nsql = " ORDER BY tbl_navigational_control.menu_item_name_long ";
	$sql = $sql.$nsql;
	//echo $sql;
	
	$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
					<?
						}
					while ($newarray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							$tmpmenuid 		= $newarray['menu_item_id'];
							$tmpmenuurl 	= $newarray['menu_item_location'];
							$tmpmenulocl	= $newarray['menu_item_name_long'];
							$tmpmenulocs	= $newarray['menu_item_name_short'];
							$tmpmenupurp	= $newarray['menu_item_purpose'];
							$tmpmenuslaved	= $newarray['menu_item_slaved_to_id'];
							
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($menu_id = "all") {
									$intmenuid	= (double) $default;
									if ($tmpmenuid == $intmenuid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?=$tmpmenuid;?>"><?=$tmpmenulocl;?>&nbsp;&nbsp;(<?=$tmpmenulocs;?>)</option>
										<?
									}
									else {
										?>
				<?=$tmpmenulocl?>&nbsp;&nbsp;(<?=$tmpmenulocs;?>)
										<?
									}
								}	// End of while loop
								mysqli_free_result($res);
								mysqli_close($mysqli);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	}

function navigationalgroupbox($group_id, $archived, $nameofinput, $showcombobox, $default) {
	// $group_id		, is the number of the group to do the search for ;
	// $archived		, do you want to list all menu items, or just the archived ones;
	// $nameofinout		, what is the name of the select box that 'could' be ceated by this function;
	// $showcombobox	, Do you want to show the combo box select input style or just the text without the input box;
	// $default			, What is the default group to display in the combobox when it is displayed;

	// Examples
	
	//	$adataselect[$i]($objarray[$adatafieldid[$i]], "all", $adatafield[$i], "hide", "");
	// This example will only show one record, and it will not be in a combobox input box, but rather be displayed as text.
	
	
	$sql	= "";																				// Define the sql variable, just in case
	$nsql 	= "";																				// Define the nsql variable, just in case
	
	$sql = "SELECT * FROM tbl_navigational_control_g ";											// start the SQL Statement with the common syntax

	if ($group_id=="all") {																		// if supplied 'all' for the menu_id so the following
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;																	// important to tell the procedures below this happened
		}
		else {
			$nsql = "WHERE `navigational_groups_id` = ".$group_id." ";										// if supplied a menu_id, then add it to the SQL Statement
			$sql = $sql.$nsql;																	// combine the nsql and sql strings
			$tmp_flagger = 1;																	// important to tell the procedures below this happened
		}

	if ($archived == "all") {																	// if supplied 'all' for the archived variable do the following
																								// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {																// If archived is 'yes' then
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_navigational_control_g.navigational_groups_archived_yn = -1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_navigational_control_g.navigational_groups_archived_yn = -1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_navigational_control_g.navigational_groups_archived_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_navigational_control_g.navigational_groups_archived_yn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	//echo $sql;
	
	$mysqli = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?=$nameofinput?>">
					<?
						}
					while ($newarray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							$tmpgroupid 	= $newarray['navigational_groups_id'];
							$tmpgroupname 	= $newarray['navigational_groups_name'];
							$tmpgrouparch	= $newarray['navigational_groups_archived_yn'];
							
						if ($showcombobox=="show") {
								?>
		<option 
								<?
							}
							if ($group_id = "all") {
									$intgroupid	= (double) $default;
									if ($tmpgroupid == $intgroupid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?
												}
										}
										else {
											// There is no user specified so we dont need to set a defualt value
										}
								}
								else {
								
								}
								if ($showcombobox=="show") {
										?>
				value="<?=$tmpgroupid;?>"><?=$tmpgroupname;?></option>
										<?
									}
									else {
										?>
				<?=$tmpgroupname?>
										<?
									}
								}	// End of while loop
								mysqli_free_result($res);
								mysqli_close($mysqli);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?
									}
						}	// end of Res Record Object						
				}
	}
	
function displaytxtonreport($txtdisplay, $bsize, $fsize,$hsize, $jsize, $wpost, $xpost, $ypost, $zpost) {
	//xpost = (xpost + displayfiedx_offset)
	?>
	<div style="position:absolute; width:<?=($wpost);?>; left:<?=($xpost);?>; top:<?=($ypost);?>; z-index:<?=($zpost);?>; align="center">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#000000" width="<?=($wpost)?>" height="<?=($hsize)?>">
			<tr>
				<td align="<?=($jsize)?>">
					<font size="<?=($fsize)?>">
						<?
						if ($bsize==1) {
								?>
						<b>
								<?
							}
						?>								
							<?=$txtdisplay;?>
						<?
						if ($bsize==1) {
								?>
							</b>
								<?
							}
						?>
						</font>
					</td>
				</tr>
			</table>
		</div>
		<?
	}	
	?>
