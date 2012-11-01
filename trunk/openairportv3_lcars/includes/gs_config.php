<?
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
//	Name of Document		:	gs_config.php
//
//	Purpose of Page			:	To set certain global variables in the system
//
//	Special Notes			:	Changce the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

	// Set Global Variables

		global $nameofairport;
		global $nameofdatabase;
		global $passwordofdatabase;
		global $hostdomain;
		global $hostusername;
	
		date_default_timezone_set('America/Chicago');
	
	// Define Values of Global Variables	
	
		$nameofairport		= "Watertown Regional Airport";								// Change this value to the name of your airport
		$hostdomain			= "localhost";												// Change this to the IP or name of the server hosting OpenAirport (localhost should be ok)
		$hostusername		= "webuser";												// Change this to the name of the user approved to access to MySQL database for OpenAirport
		$nameofdatabase		= "OpenAirportv3";											// Change this to the name of the OpenAirport database in MySQL
		$passwordofdatabase	= "limitaces";												// Change this to the password the user uses to access the database
		
	// Language Variables
			
		$en_start_date		= "Start Date :";
		$en_end_date		= "End Date :";
		$en_turned_off		= "This options has been turned off";
		$en_joined			= "Join Fields";
		$en_joined_desc		= "Clck to Join: Use this control to join underlined items";
		$en_textlike		= "Text Like ? :";
		$en_archived		= "Archived";
		$en_closed			= "Closed";
		$en_duplicate		= "Duplicate";
		$en_select_page		= "Page";
		$en_quickaccess_f	= "";
		$en_form_exports	= "Form Utilities";
		$en_calendarprint	= "Calendar Printout";
		$en_yearendreport	= "Year End Report";
		$en_printerprint	= "Printer Friendly Report";
		$en_optionsforu		= "The following options are avilable to you";
		$en_distribution	= "Distribution Chart";
		$en_linechart		= "Line Chart";
		$en_mapit			= "Map Location(s)";
		$en_googleearthit	= "Export Google Earth";
		$en_quickaccess		= "Add to Quick Access";
		$en_quickaccessno	= "Remove from Quick Access";
		$en_pageation		= "Display Page";
		$en_active			= "ON";
		$en_notactive		= "OFF";
		$en_submitform		= "Submit";
		$en_id				= "Record ID";
		$en_functions		= "Functions";
		$en_commands		= "Commands";
		$en_open_commands	= "Controls";
		$en_sortingfilters	= "Filters";
?>