<?
$sql 	= 
		"SELECT * FROM tbl_leases_main
		INNER JOIN tbl_leases_terms ON tbl_leases_main.lease_terms_cb_int = tbl_leases_terms.leases_terms_id
		INNER JOIN tbl_general_tblrlshp ON tbl_leases_main.leases_lease_type_cb_int = tbl_general_tblrlshp.tbl_gtr_t_id ";

		// Step 1). Conduct initital SQL Startement to get the value in tbl_gtr_t_tablename
		//			Assume tbl_maintenance_sub_p_p
		
		// Step 2). Create SQL Statement that lists all types and the applicable sub parts for that type
		
$sql 	= 
		"SELECT * FROM ".$tmptablename." 
		
		";
		
$sql 	= 
		"SELECT * FROM tbl_general_tblrlshp
		
		
		
?>
