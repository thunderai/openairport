<?php

// This function takes the supplied ID and prints out the purpose of the menu item
function getpurposeofmenuitemid_return_nohtml($menuitemidsupplied,$fontsize,$fontcolor,$session_user) {

	$layer3menuconn = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
				
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$sql = "select tbl_systemusers.emp_record_id, tbl_systemusers.emp_firstname, tbl_systemusers.emp_lastname, tbl_systemusers.emp_initials, tbl_systemusers_ncga.navigational_access_id, tbl_systemusers_ncga.navigational_user_id_cb_int, tbl_systemusers_ncga.navigational_user_id_cb_txt, tbl_systemusers_ncga.navigational_group_id_cb_int, tbl_systemusers_ncga.navigational_group_id_cb_txt, tbl_navigational_control_g.navigational_groups_id, tbl_navigational_control_g.navigational_groups_name, tbl_navigational_control_g_a.navigational_access_id,
			tbl_navigational_control_g_a.navigational_groups_id_cb_int, tbl_navigational_control_g_a.navigational_groups_id_cb_txt, tbl_navigational_control_g_a.navigational_control_id_cb_int, tbl_navigational_control_g_a.navigational_control_id_cb_txt, tbl_navigational_control.menu_item_id, tbl_navigational_control.menu_item_location, tbl_navigational_control.menu_item_name_long, tbl_navigational_control.menu_item_name_short, tbl_navigational_control.menu_item_slaved_to_id, tbl_navigational_control.menu_item_archived_yn, tbl_navigational_control.menu_item_purpose
			from tbl_navigational_control inner join ((tbl_navigational_control_g inner join (tbl_systemusers inner join tbl_systemusers_ncga on tbl_systemusers.emp_record_id = tbl_systemusers_ncga.navigational_user_id_cb_int) on tbl_navigational_control_g.navigational_groups_id = tbl_systemusers_ncga.navigational_group_id_cb_int) inner join tbl_navigational_control_g_a on tbl_navigational_control_g.navigational_groups_id = tbl_navigational_control_g_a.navigational_groups_id_cb_int) on tbl_navigational_control.menu_item_id = tbl_navigational_control_g_a.navigational_control_id_cb_int
			where tbl_navigational_control.menu_item_id = '".$menuitemidsupplied."'";
			
			//echo "Purpose SQL :".$sql;
			
			$layer3menures = mysqli_query($layer3menuconn, $sql);
							
				if ($layer3menures) {
						$number_of_rows = mysqli_num_rows($layer3menures);
						//printf("result set has %d rows. \n", $number_of_rows);
						while ($layer3array = mysqli_fetch_array($layer3menures, MYSQLI_ASSOC)) {
								$tmpfieldname	= $layer3array['menu_item_purpose'];
							
								$returnHTML	= $tmpfieldname;
							}
					}
							mysqli_free_result($layer3menures);
							mysqli_close($layer3menuconn);
		}

	return $returnHTML;	
	}
?>