<?
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	preflights_tbl_139_327_main.php
//
//	Purpose of Page		:	...
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
	
function preflight_tbl_139_327_main_a_yn($recordid,$tblarchivedsort) {

		$sql2 = "SELECT * FROM tbl_139_327_sub_a WHERE archived_inspection_id = '".$recordid."' ";
		//make connection to database
		$objconn2 = mysqli_connect("localhost", "webuser", "limitaces", "openairport");
		if (mysqli_connect_errno()) {
				// there was an error trying to connect to the mysql database
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs2 = mysqli_query($objconn2, $sql2);
				if ($objrs2) {
						$number_of_rows = mysqli_num_rows($objrs2);
					}
			}
		
		if ($isarchived==1) {
				//echo "Is rchived, do I display it?".$tblarchivedsort;
				if ($tblarchivedsort=="1") {
						//echo "Display Row";
						$displaydatarow=1;
					}
					else {
						// Don't display datarow
						//echo "Dont Display row";
						$displaydatarow=0;
					}
			}
			else {
				// This record is not a duplicate, and not archived, so lets display it anyway
				$displaydatarow=1;
			}
		//$displayrow = 0;
		
		if ( $number_of_rows2 > 0 ) {
				//echo "There is a record saying this row is archived ";
				if ($tblarchivedsort == 1) {
						$displayrow	= 1;
						//echo "User has selected to display archived rows, so tell block to display row ";
					}
					else {
						$displayrow	= 0;
						//echo "User has selected NOT to archived closed rows, so tell block NOT to display row ";
					}
			}
			else {
				$displayrow = 1;
			}
			
	return $displayrow;
	}
?>
