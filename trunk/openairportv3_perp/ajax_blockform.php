<?php
include("includes/_template_header.php");	
//include("includes/quickaccessFunctions.php");	

		$menuid 	= $_GET['menuid'];
		$userid		= $_GET['Employee'];
		$value		= $_GET['value'];
		
		$start		= $_GET['start'];
		$end		= $_GET['end'];

		$value		= ($value*1);
		//echo "Value in field is :".$value." <br>";
		
		//echo "Employee [".$userid."]";
		
		// Quick Access Menu System 
		// $value tells us the current status of the Quick Access Menu System, 	0 means there is no record in the databse or its arhived
		//																		1 would mean there is a record in the database
		// if $value = 1, then hide the record, if $value = 0, then we need to make it active or add it.
		
		if ($value == 0) {
				// The value must be 0, but is there an already exisiting record set to arcivhed?
				// Test with archived reports 
				$test1 = qac_test_exisist($menuid,$userid,"notest");
				//echo "test".$test1;
				if ($test1==0) {
						//echo "There is not a record in the database, make one <br><br>";
						$sql = "INSERT INTO tbl_quickaccess_control (tbl_qac_systemuser_id,tbl_qac_navigation_id) 
								VALUES 
								( '".$userid."','".$menuid."')";				
						//echo "SQL :".$sql."<br><br>";
						$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);				
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
								$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
							}
					}
					else {
						//echo "Unhide Record <br><br>";
						$sql = "UPDATE tbl_quickaccess_control SET tbl_qac_hidden_yn = 0 WHERE tbl_qac_systemuser_id = ".$userid." AND tbl_qac_navigation_id = ".$menuid."";
						//echo "SQL :".$sql."<br><br>";
						$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);				
						if (mysqli_connect_errno()) {
								// there was an error trying to connect to the mysql database
								printf("connect failed: %s\n", mysqli_connect_error());
								exit();
							}		
							else {
								$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
							}
					}
			}
			else {
				//echo "There is a value in the datbase, hide it <br><br>";
				$sql = "UPDATE tbl_quickaccess_control SET tbl_qac_hidden_yn = 1 WHERE tbl_qac_systemuser_id = ".$userid." AND tbl_qac_navigation_id = ".$menuid."";
				//echo "SQL ".$sql."<br><br>";
				$mysqli = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);			
				if (mysqli_connect_errno()) {
						// there was an error trying to connect to the mysql database
						printf("connect failed: %s\n", mysqli_connect_error());
						exit();
					}		
					else {
						$objrs = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
					}
			}
			
	loadquickaccessmenu($userid,$start,$end);
?>