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
//	Name of Document	:	Header.php
//
//	Purpose of Page		:	Almost evey page of the system uses the header file to create the
//							look and function of the page and well as locate required functions
//							and other things each page may need.
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		

	// Start Session Variables	
		Session_Start();
		Session_Register("user_id");
		Session_Register("process_login");
		Session_Register("last_activity");
		Session_Register("page_time");

		$time_initiated = microtime();
		//echo "Session Last Activity [".$_SESSION['last_activity']."] <br>";
		$_SESSION['last_activity'] = time();
		//echo "Session Last Activity Now is[".$_SESSION['last_activity']."] <br>";
		$_SESSION['page_time'] = microtime(true);
		
		//echo "Page Started at time index [".$time_initiated."] <br>";

	// Establish Document Type
	?>
<!DOCTYPE html>
<html>
	<?php 		
	// Include Required Files	
		include("includes/_globals.inc.php");		
	// Create the HEAD Section of the HTML Document
	?>
		<head>		
			<title>www.OpenAirport.org - The OpenSource Advanced Airport Record Keeping Solution</title>
			
	<?php
	// Load Javascript Script files
		include("scripts/_scripts_header_iframes.inc.php");
		include("scripts/_scripts_header_iface.inc.php");
		include("scripts/_scripts_header_ajaxs.inc.php");		
	// Load StyleSheets (CSS)	
		include("stylesheets/_css.inc.php");
	
	// Load Mobile Detect (https://github.com/serbanghita/Mobile-Detect)
		include("thirdparty/mobile-detect/mobiledetect.php");
		$detect = new Mobile_Detect();
		
		$width		= '100%';
		$height		= '900px';
		
		$qua_e		= 9;
		
		if ($detect->isMobile()) {
				// Any mobile device.
				
				$width		= '100%';
				$height		= '400px';
				
				$qua_e		= 2;
				
			}
		
		if($detect->isTablet()){
				// Any tablet device.
				
				$width		= '975px';
				$height		= '620px';
				
				$qua_e		= 5;
			}
			
	?>
			</head>
		<body leftmargin="0px" rightmargin="0px" topmargin="0px" marginwidth="0px" marginheight="0px" style="margin: 0px; margin-bottom:0px; margin-top:0px;margin-right:0px;" />
			<a href="#top"></a>
	<?php
	//onLoad="cacheOff()"
	// Load Javascript Body Cache Procedures
		//include("scripts/_scripts_body_cache.inc.php");		
	// END OF HEADER FILE.  INDEX.PHP/ OR SPECIFIC PAGE REQUEST WILL TAKE OVER FROM HERE.
	?>