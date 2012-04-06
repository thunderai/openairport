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
//	Name of Document	:	navigation.list.php
//
//	Purpose of Page		:	Lists all Navigation Functions by include.
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
?>

<?php
	// Load Include Files
			include("_nav_hasslaves.inc.php");
			include("_nav_loadmenu.inc.php");
			include("_nav_loadmenu_v4.inc.php");
			include("_nav_buildbreadcrumtrail.inc.php");
			include("_nav_getnameofmenuitemid.inc.php");
			include("_nav_getpurposeofmenuitemid.inc.php");
			include("_nav_navigationalcombobox.inc.php");
			include("_nav_navigationalgroupbox.inc.php");
			include("_nav_navigationalcombobox_bypage.inc.php");
			include("_nav_displaytxtonreport.inc.php");
			include("_nav_getbysuid_navigationalgrouptext.inc.php");
			
			
			
			
			include("_nav_getnameofmenuitemid_return.inc.php");
			include("_nav_getpurposeofmenuitemid_return.inc.php");
	?>