<?
function preflights_tbl_139_339_sub_n_r_yn($recordid,$tblarchivedsort) {
		
		$isarchived = 0;

		$sql2 = "SELECT * FROM tbl_139_339_sub_n_r WHERE 139339_sub_n_r_cancelled_id_int = '".$recordid."' ";
		//echo $sql2;
		//make connection to database
		$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
			
			if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				//printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs2 = mysqli_query($objconn2, $sql2);
				if ($objrs2) {
						$number_of_rows = mysqli_num_rows($objrs2);
						//echo ">>".$number_of_rows;
						if ($number_of_rows > 0 ) {
								$isarchived = 1;
							}
					}
			}

		//echo "isarchieved ".$isarchived;	
		//echo "Duplicatesort ".$tblarchivedsort;
		
		if ($isarchived == 1) {
				//echo "Is rchived, do I display it?".$tblarchivedsort;
				if ($tblarchivedsort == 1) {
						//echo "Display Row";
						$displayrow = 1;
					}
					else {
						// Don't display datarow
						//echo "Dont Display row";
						$displayrow = 0;
					}
			}
			else {
				// This record is not a duplicate, and not archived, so lets display it anyway
				$displayrow=1;
			}
		
	//echo "Display Row :".$displayrow;
	
	return $displayrow;
	}
?>