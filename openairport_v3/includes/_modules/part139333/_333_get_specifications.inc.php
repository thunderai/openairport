<?php
function part139333_get_specifications($suppliedid) {

		$sql = "SELECT * FROM `tbl_139_333_sub_c_spec` WHERE 139333_spec_c_id = '".$suppliedid."' ";
		
		//echo $sql;
		$objconn_support = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if (mysqli_connect_errno()) {
				//printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs_support = mysqli_query($objconn_support, $sql);
				if ($objrs_support) {
						$number_of_rows = mysqli_num_rows($objrs_support);
						if($number_of_rows == 0) {
						
								$areturn = array('-');
								
							}
						while ($objfields = mysqli_fetch_array($objrs_support, MYSQLI_ASSOC)) {
						
								$c1 = $objfields['139339_spec_proper_c1'];
								$c2 = $objfields['139339_spec_proper_c2'];
								
								$areturn = array($c1,$c2);
						
							}
					}
			}
			
	return $areturn;
	
	}				