<?php
	
function loadquickaccessmenu($user,$start=0,$end=5) {

	$ary_colors 	= array('table_button_side_top_dark1_qac','table_button_side_top_light2_qac','table_button_side_top_light1_qac');
	$ary_types		= array('Browse','Monitor','New');
	
	//$start = $start + 1;
	
	//include("stylesheets/_css.inc.php");
	
	//echo "Start: ".$start." <br>";
	//echo "End : ".$end." <br>";
?>
<table border="0" cellpadding="0" cellspacing="0" id="quickaccessitem" width="100%" style="border:0px;margin:0px;padding:0px;z-index:20;" />
<?php 
	$sql = "SELECT * FROM tbl_systemusers 
			INNER JOIN tbl_quickaccess_control ON tbl_quickaccess_control.tbl_qac_systemuser_id = tbl_systemusers.emp_record_id 
			INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_quickaccess_control.tbl_qac_navigation_id 
			WHERE tbl_systemusers.emp_record_id = ".$user." AND tbl_quickaccess_control.tbl_qac_hidden_yn = 0 
			ORDER BY tbl_navigational_control.menu_item_name_short";

	//echo "The SQL Statement is :".$sql;
	
	$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//echo "rows ".$number_of_rows;
				}
		}

	//echo "There are [ ".$number_of_rows." ] quick access menu items <br>";	
	
	//echo "Limiting Factor is ".$end." <br>";
	
	if($number_of_rows <= $end) {
			// Just display everything
			//echo "Display All Rows <br>";
			$start_to_use 	= 0;
			$end_to_use		= $number_of_rows;
		} else {
			//echo "Limit Search Results <br>";
			//echo "Start: [".$start."] <br>";
			//echo "End : [".$end."] <br>";
			//echo "There are [".$number_of_rows."] qua <br>";
			
			$start_to_use 	= $start;
			$end_to_use		= $start + $end;
			
			//echo "Limiter [".$end_to_use."] qua <br>";
			
			if($end_to_use > $end) {
					// Counts messed up, reset it to $end
					//echo "End is larger than End. Reset <br>";
					$end_to_use = $end;
					
					//$spread = $end_to_use - $start_to_use;
					
					//echo "Spread ".$spread." <br>";
				}
			
		}
	

	$sql = "SELECT * FROM tbl_systemusers 
			INNER JOIN tbl_quickaccess_control ON tbl_quickaccess_control.tbl_qac_systemuser_id = tbl_systemusers.emp_record_id 
			INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_quickaccess_control.tbl_qac_navigation_id 
			WHERE tbl_systemusers.emp_record_id = ".$user." AND tbl_quickaccess_control.tbl_qac_hidden_yn = 0 
			ORDER BY tbl_navigational_control.menu_item_name_short 
			LIMIT ".$start_to_use.",".$end_to_use." ";

	//echo "The SQL Statement is :".$sql;
	
	?>
	<script>
		document.getElementById('qa_start').value 	= '<?php echo $start;?>';
		</script>
	<?php
	
	$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$res = mysqli_query($mysqli, $sql);
			if ($res) {
					$number_of_rows = mysqli_num_rows($res);
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($newarray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							$tmpmenuitemid 	= $newarray['menu_item_id'];
							$tmpmenuurl 	= $newarray['menu_item_location'];
							$tmpmenuitemloc	= $newarray['menu_item_name_long'];
							$tmpmenusshortnl= $newarray['menu_item_name_short'];
							$tmpmenupurp	= $newarray['menu_item_purpose'];
							$tmpmenuslaved	= $newarray['menu_item_slaved_to_id'];
							
							$random	= rand(0,2);		
							
							for($i=0;$i<=count($ary_types);$i++) {
								
								$findme = $ary_types[$i];
								$pos	= strpos($tmpmenusshortnl, $findme);
								
								if($pos === false) {
										// No match found
									} else {
										$style = $ary_colors[$i];
									}
								
								}
							
							?>
	<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;display:inline;" name="qac_menuitem<?php echo $tmpmenuitemid;?>" method="POST" action="<?php echo $tmpmenuurl;?>" target="layouttableiframecontent" />						
	<tr>
		<td>
			<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
				<tr>
					<td class="<?php echo $style;?>" onclick="javascript:document.qac_menuitem<?php echo $tmpmenuitemid;?>.submit();" style="cursor:hand;" />
						<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemid;?>" />
						<?php echo $tmpmenusshortnl;?>
						</td>
					<td class="<?php echo $style;?>_gap" />
						&nbsp;
						</td>	
					<td class="<?php echo $style;?>_help" onMouseover="ddrivetip('<?php echo $tmpmenupurp;?>');" onMouseout="hideddrivetip();" />
						&nbsp;
						</td>
					</tr>
				</table>
			</td>
		</tr>
		</form>
							<?php 
						}	// End of while loop
					mysqli_free_result($res);
					mysqli_close($mysqli);
				}	// end of Res Record Object						
		}
		?>
	</table>
		<?php 
	}	
?>