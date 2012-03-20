<?php 
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
//	Name of Document	:	part139339.list.php
//
//	Purpose of Page		:	Lists all Part 139.339 Functions by include.
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		

	// Load Include Files
			include("_339_c_facilitycombobox.inc.php");
			include("_339_c_facilitycomboboxwall.inc.php");	
			
			//include("_327_conditionscombobox.inc.php");
			//include("_327_conditionscomboboxwall.inc.php");			
			//include("_327_discrepancycombobox.inc.php");
			//include("_327_discrepancydisplaybox.inc.php");
			//include("_327_discrepancy_getstage.inc.php");
			//include("_327_discrepancydisplaysummary.inc.php");	
			//include("_327_reportdisplaysummary.inc.php");
			
			include("_339_c_typescombobox.inc.php");
			include("_339_c_typestextfield.inc.php");
			include("_339_c_typescomboboxwall.inc.php");
			
			include("_339_c_templatescombobox_ajax.inc.php");			
			include("_339_c_templatescombobox.inc.php");
			
	// Load PreFlight Files
			include("preflights_tbl_139_339_c_main_a_yn.inc.php");
			//include("preflights_tbl_139_327_main_sub_d_a_yn.inc.php");
			//include("preflights_tbl_139_327_main_sub_d_c_yn.inc.php");
			//include("preflights_tbl_139_327_main_sub_d_d_yn.inc.php");
	?>