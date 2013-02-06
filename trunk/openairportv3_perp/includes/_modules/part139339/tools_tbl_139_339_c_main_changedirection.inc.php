<?php

function swapmuvalues($from,$to,$recordid) {
	
	$sql = "SELECT * FROM tbl_139_339_main 
	INNER JOIN tbl_139_339_sub_c_c	ON tbl_139_339_sub_c_c.139339_cc_ficon_cb_int = tbl_139_339_main.139339_main_id 
	INNER JOIN tbl_139_339_sub_c 	ON tbl_139_339_sub_c.139339_c_id = 139339_cc_c_cb_int  
	INNER JOIN tbl_139_339_sub_c_f 	ON tbl_139_339_sub_c_f.139339_f_id = 139339_c_facility_cb_int 
	WHERE 139339_main_id = '".$recordid."' AND 139339_c_name = '".$to."'
	ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
	
	$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	//echo "TO SQL :".$sql." <br>";
	
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}		
		else {
			//mysql_insert_id();
			$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
			
			while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
	
					$to_id 		= $objfields['139339_cc_id'];
					$to_value 	= $objfields['139339_cc_d_yn'];
					$to_name	= $objfields['139339_c_name'];
					
					//echo ">> To ID :".$to_id." <br>";
					//echo ">> To Value :".$to_value." <br>";
					//echo ">> To Name :".$to_name." <br>";
					
				}
		}
		
	$sql = "SELECT * FROM tbl_139_339_main 
	INNER JOIN tbl_139_339_sub_c_c	ON tbl_139_339_sub_c_c.139339_cc_ficon_cb_int = tbl_139_339_main.139339_main_id 
	INNER JOIN tbl_139_339_sub_c 	ON tbl_139_339_sub_c.139339_c_id = 139339_cc_c_cb_int  
	INNER JOIN tbl_139_339_sub_c_f 	ON tbl_139_339_sub_c_f.139339_f_id = 139339_c_facility_cb_int 
	WHERE 139339_main_id = '".$recordid."' AND 139339_c_name = '".$from."'
	ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
	
	$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	//echo "FROM SQL :".$sql." <br>";
	
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}		
		else {
			//mysql_insert_id();
			$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
			
			while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
	
					$from_id 		= $objfields['139339_cc_id'];
					$from_value 	= $objfields['139339_cc_d_yn'];
					$from_name		= $objfields['139339_c_name'];
					
					//echo ">> From ID :".$from_id." <br>";
					//echo ">> From Value :".$from_value." <br>";
					//echo ">> From Name :".$from_name." <br>";
					
				}
		}		

// UPDATE RECORDS

	// Move from too to

	$sql2 = "UPDATE tbl_139_339_sub_c_c SET 139339_cc_d_yn='".$to_value."' WHERE 139339_cc_id = '".$from_id."' ";
	
	//echo "UPDATE FROM SQL : ".$sql2." <br>";
	
	$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}		
		else {
			$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));										
			$lastchkid = mysqli_insert_id($objcon2);
			
		}

	// Move to too from

	$sql2 = "UPDATE tbl_139_339_sub_c_c SET 139339_cc_d_yn='".$from_value."' WHERE 139339_cc_id = '".$to_id."' ";
	
	//echo "UPDATE TO SQL : ".$sql2." <br>";
	
	$objcon2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

	if (mysqli_connect_errno()) {
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}		
		else {
			$objrs2 = mysqli_query($objcon2, $sql2) or die(mysqli_error($objcon2));										
			$lastchkid = mysqli_insert_id($objcon2);
			
		}		
		
} 

function tools_tbl_139_339_c_main_changedirection($recordid) {
	// What this tool does it look into a 339 inspection record, looking for what direction
	//		the tests where conducted in and changes the mu values to agree with the direction
	
	// Step One: Look for the 139.339_c Inspection given in the recordid

	$sql = "SELECT * FROM tbl_139_339_main 
	INNER JOIN tbl_139_339_sub_c_c	ON tbl_139_339_sub_c_c.139339_cc_ficon_cb_int = tbl_139_339_main.139339_main_id 
	INNER JOIN tbl_139_339_sub_c 	ON tbl_139_339_sub_c.139339_c_id = 139339_cc_c_cb_int  
	INNER JOIN tbl_139_339_sub_c_f 	ON tbl_139_339_sub_c_f.139339_f_id = 139339_c_facility_cb_int 
	WHERE 139339_main_id = '".$recordid."' AND 139339_c_name = 'isfrom17' 
	ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
	
	$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}		
		else {
			//mysql_insert_id();
			$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
			
			while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {

					$from17 = $objfields['139339_cc_d_yn'];
					
					if($from17 == 1) {
							//echo "Direction on 17 is from 17 <br>";
									
						} else {
							//echo "Direction on 17 is from 35 <br>";
							
							// Numbers on runway Mu value must be rearranged
							
							// Get Mu Values...
						
							swapmuvalues('x1735MuT 1','z1735MuR 3',$recordid);
							swapmuvalues('x1735MuT 2','z1735MuR 2',$recordid);
							swapmuvalues('x1735MuT 3','z1735MuR 1',$recordid);
							swapmuvalues('y1735MuM 1','y1735MuM 3',$recordid);
							//swapmuvalues('y1735MuM 2','y1735MuM 2',$recordid);	<-- Skipped
							//swapmuvalues('y1735MuM 3','y1735MuM 1',$recordid);
							//swapmuvalues('z1735MuR 1','x1735MuT 3',$recordid);
							//swapmuvalues('z1735MuR 2','x1735MuT 2',$recordid);
							//swapmuvalues('z1735MuR 3','x1735MuT 1',$recordid);
							
							// Numbers on runway Mu value are correct
						}
				}
		}
		
	$sql = "SELECT * FROM tbl_139_339_main 
	INNER JOIN tbl_139_339_sub_c_c	ON tbl_139_339_sub_c_c.139339_cc_ficon_cb_int = tbl_139_339_main.139339_main_id 
	INNER JOIN tbl_139_339_sub_c 	ON tbl_139_339_sub_c.139339_c_id = 139339_cc_c_cb_int  
	INNER JOIN tbl_139_339_sub_c_f 	ON tbl_139_339_sub_c_f.139339_f_id = 139339_c_facility_cb_int 
	WHERE 139339_main_id = '".$recordid."' AND 139339_c_name = 'isfrom12' 
	ORDER BY 139339_f_order, 139339_f_name, 139339_c_name";
	
	//echo $sql;
	
	$objcon = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
	
	if (mysqli_connect_errno()) {
			// there was an error trying to connect to the mysql database
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}		
		else {
			//mysql_insert_id();
			$objrs = mysqli_query($objcon, $sql) or die(mysqli_error($objcon));
			
			while ($objfields = mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {

					$from12 = $objfields['139339_cc_d_yn'];
					
					if($from12 == 1) {
							//echo "Direction on 17 is from 17 <br>";
									
						} else {
							//echo "Direction on 17 is from 35 <br>";
							
							swapmuvalues('x1230MuT 1','z1230MuR 3',$recordid);
							swapmuvalues('x1230MuT 2','z1230MuR 2',$recordid);
							swapmuvalues('x1230MuT 3','z1230MuR 1',$recordid);
							swapmuvalues('y1230MuM 1','y1230MuM 3',$recordid);
							//swapmuvalues('y1735MuM 2','y1735MuM 2',$recordid);	<-- Skipped
							//swapmuvalues('y1735MuM 3','y1735MuM 1',$recordid);
							//swapmuvalues('z1735MuR 1','x1735MuT 3',$recordid);
							//swapmuvalues('z1735MuR 2','x1735MuT 2',$recordid);
							//swapmuvalues('z1735MuR 3','x1735MuT 1',$recordid);
							
							// Numbers on runway Mu value are correct
						}
				}
		}		
		
}
?>