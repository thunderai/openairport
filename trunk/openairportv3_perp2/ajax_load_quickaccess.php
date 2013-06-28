<?php
include("includes/_template_header.php");	
//include("includes/quickaccessFunctions.php");	

		$userid 	= $_GET['userid'];
		$start		= $_GET['start'];
		$end		= $_GET['end'];
			
	loadquickaccessmenu($userid,$start,$end);
?>