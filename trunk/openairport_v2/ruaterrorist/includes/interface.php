<?
//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//==============================================================================================
//	
//	oooo	o   o	 ooo	ooooo
//	o	o	o	o	o	o	  o
//	o	o	o	o	o	o	  o
//	oooo	o   o	ooooo	  o	
//	o  o	o	o	o	o	  o
//	o	o	o	o	o	o	  o
//	o	o	ooooo	o   o	  o
//
//	The "Are You a Terrorist?" (RUAT) system.
//
//	Designed, Coded, and Supported by Erick Alan Dahl
//
//	Copywrite 2008 - Erick Alan Dahl
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	includes/interface.php
//
//	Purpose of Page		:	FORM SIDE 	- No forms
//							SERVER SIDE - Initialze Interface Common Objects
//
//==============================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

//		 1		   2		 3		   4		 5		   6		 7		   8	     9		   
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//=================================================================================================
// Function display_copywrite_footer()
//

// RUN GENERAL STUFF NOT INSIDE OF A PROCEDURE

if (!isset($_POST["displaylist"])) {
		$displaylist 	= "all";
		$displaytext	= " &raquo; All Saved Searches ";
	}
	else {
		$displaylist	= $_POST['displaylist'];
		$displaytext	= " &raquo; ".$displaylist." ";
	}
if (!isset($_POST["displaypage"])) {
		$displaypage 	= 1;
	}
	else {
		$displaypage	= $_POST['displaypage'];
	}
if (!isset($_POST["displaynameorder"])) {
		$displaynameorder 	= '';
	}
	else {
		$displaypage		= $_POST['displaynameorder'];
	}	

	
	

function display_copywrite_footer() {
	$tmp_year = date('Y');
	?>
	<font size="1" color="#FFFFFF">Copywrite <?=$tmp_year;?>; Erick Alan Dahl; All Rights Reserved.
	<?
	}
//
//=================================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

?>