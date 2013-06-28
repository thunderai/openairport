<?php
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	_globals.inc.php
//
//	Purpose of Page			:	To set certain global variables in the system
//
//	Special Notes			:	Changce the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

	// List Include Files
			include("includes/POSTs.php");																// include file that gets information from form posts for navigational purposes

	// Legacy Includes
			//include("includes/gs_config.php");												// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.
			//include("includes/AutoEntryFunctions.php");													// This include 'header.php' is the main include file which has the page layout, css, and functions all defined.

	// New Style Includes 			
			include("includes/_dateandtime/dateandtime.list.php");										// List of all Date and Time functions
			include("includes/_navigation/navigation.list.php");										// List of all Navigation functions			
			include("includes/_organizations/organization.list.php");									// List of all Navigation functions		
			include("includes/_systemusers/systemusers.list.php");										// List of all Navigation functions
			include("includes/_userinterface/userinterface.list.php");									// List of all Navigation functions
			include("includes/_generalsettings/generalsettings.list.php");								// List of all Navigation functions
			include("includes/_accesscontrol/accesscontrol.list.php");									// List of all Navigation functions
			include("includes/_gis/_gis.list.php");									// List of all Navigation functions
						
	// New Style Module Includes
	
			// Load these as needed? or load all ahead of time?
	
		?>	