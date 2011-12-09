<?php
	
function loadquickaccessmenu($user) {
?>
<table border="0" height="20" border="0" id="quickaccessitem" cellpadding="2" cellspacing="2" background="stylesheets/_cssimages/layoutheaderbackground.gif">
	<Tr>
<?php 

	$sql = "SELECT * FROM tbl_systemusers 
			INNER JOIN tbl_quickaccess_control ON tbl_quickaccess_control.tbl_qac_systemuser_id = tbl_systemusers.emp_record_id 
			INNER JOIN tbl_navigational_control ON tbl_navigational_control.menu_item_id = tbl_quickaccess_control.tbl_qac_navigation_id 
			WHERE tbl_systemusers.emp_record_id = ".$user." AND tbl_quickaccess_control.tbl_qac_hidden_yn = 0 
			ORDER BY tbl_navigational_control.menu_item_name_long";

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
					//printf("result set has %d rows. \n", $number_of_rows);
					while ($newarray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
							$tmpmenuitemid 	= $newarray['menu_item_id'];
							$tmpmenuurl 	= $newarray['menu_item_location'];
							$tmpmenuitemloc	= $newarray['menu_item_name_long'];
							$tmpmenusshortnl= $newarray['menu_item_name_short'];
							$tmpmenupurp	= $newarray['menu_item_purpose'];
							$tmpmenuslaved	= $newarray['menu_item_slaved_to_id'];
							?>
	<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;display:inline;" name="qac_menuitem<?php echo $tmpmenuitemid;?>" method="POST" action="<?php echo $tmpmenuurl;?>" target="layouttableiframecontent">
		<td width="50" class="formresults" onclick="javascript:document.menuitem<?php echo $tmpmenuitemid;?>.submit()" style="cursor:hand" onMouseover="ddrivetip('<?php echo $tmpmenuitemloc;?>')"; onMouseout="hideddrivetip()">
			<input type="hidden" name="menuitemid" value="<?php echo $tmpmenuitemid;?>"></font>
			<?php echo $tmpmenusshortnl;?><br>
			</td>
		</form>
							<?php 
						}	// End of while loop
					mysqli_free_result($res);
					mysqli_close($mysqli);
				}	// end of Res Record Object						
		}
		?>
		</tr>
	</table>
		<?php 
	}	
?>