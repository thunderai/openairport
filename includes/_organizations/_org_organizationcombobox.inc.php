<?php

function organizationcombobox($org_id, $archived, $nameofinput, $showcombobox, $default) {
	// This function is called when you need to make a combo box which lists the susyem users for selection. 
	// you may limit the search to a specific userid, or archived or non archived system users
	// you also need to specify the name of the input
	$sql	= "";
	$nsql 	= "";
	
	$sql = "SELECT * FROM `tbl_organization_main` ";

	if ($org_id=="all") {
			// do not add any employee ID information to the SQL String
			$tmp_flagger = 0;
		}
		else {
			$nsql = "WHERE `Organizations_id` = ".$org_id." ";
			$sql = $sql.$nsql;
			$tmp_flagger = 1;
		}

	if ($archived == "all") {
			// Do not add any systemuser archived information to the SQL string
		}
		else {
			if ($archived=="yes") {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_organization_main.org_archieved_yn = -1 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_organization_main.org_archieved_yn = -1 ";
							$sql = $sql.$nsql;
						}
				}
				else {
					if ($tmp_flagger==0) {
							$nsql = "WHERE tbl_organization_main.org_archieved_yn = 0 ";
							$sql = $sql.$nsql;
							$tmp_flagger = 1;
						}
						else {
							$nsql = "AND tbl_organization_main.org_archieved_yn = 0 ";
							$sql = $sql.$nsql;
						}
				}
		}
	$sql = $sql."ORDER BY org_name";
	//echo $sql;
	
	$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else {
			$objrs_support = mysqli_query($objconn_support, $sql);
			if ($objrs_support) {
					$number_of_rows = mysqli_num_rows($objrs_support);
					//printf("result set has %d rows. \n", $number_of_rows);
					if ($showcombobox=="show") {
							?>
	<SELECT class="Commonfieldbox" name="<?php echo $nameofinput?>">
					<?php
						}
					while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
							$tmporgname 	= $objfields['org_name'];
							$tmporgtypeid 	= $objfields['org_type_cb_int'];
							$tmporgid		= $objfields['Organizations_id'];
						if ($showcombobox=="show") {
								?>
		<option 
								<?php
							}
							if ($org_id = "all") {
									$intorgid	= (double) $default;
									if ($tmporgid == $intorgid) {
											if ($showcombobox=="show") {
													?>
				SELECTED
													<?php
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
				value="<?php echo $tmporgid;?>"><?php echo $tmporgname;?></option>
										<?php
									}
									else {
										?>
				<?php echo $tmporgname;?>
										<?php
									}
								}	// End of while loop
								mysqli_free_result($objrs_support);
								mysqli_close($objconn_support);
								if ($showcombobox=="show") {
										?>
		</SELECT>
										<?php
									}
						}	// end of Res Record Object						
				}
	return $tmporgname;
	}