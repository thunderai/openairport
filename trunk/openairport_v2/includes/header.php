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
	
	// Establish Document Type
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ENhttp://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
		<?
	// Include Required Files
	
		include("includes/GETs.php");																// include file that gets information from form posts for navigational purposes
		include("includes/POSTs.php");																// include file that gets information from form posts for navigational purposes
		include("includes/UserFunctions.php");														// include file that handles user login and menu formations
		include("includes/NavFunctions.php");														// include file that handles user login and menu formations
		include("includes/DateFunctions.php");														// include file that handles user login and menu formations
		include("includes/FormFunctions.php");														// include file that handles user login and menu formations	
	
	// Is there currently a defined session value in Session_Register("user_id"), if so do some stuff
	
		//catchuserid($strattemptedusername, $strattemptedpassword);
		
	// Create the HEAD Section of the HTML Document
		?>
		<head>
			<meta http-equiv="content-language" content="en-us">
			<meta http-equiv="content-type" content="text/html; charset=windows-1252">
			<title>www.OpenAirport.org - The OpenSource Advanced Airport Record Keeping Solution</title>
			<script type="text/javascript" src="scripts/iframe.js"></script>
			<script type="text/javascript" src="scripts/OA_openwindows.js"></script>
			<script type="text/javascript" src="scripts/AjaxRequest.js"></script>
			<script type="text/javascript" src="scripts/dom-drag.js"></script>
			<script type="text/javascript" src="scripts/browseheader.js"></script>
			<script type="text/javascript" src="scripts/wz_jsgraphics.js"></script>
			<script type="text/javascript" src="scripts/iframemovement.js"></script>
			
			<script type="text/javascript" src="html2xhtml.js"></script>
			<script type="text/javascript" src="richtext_compressed.js"></script>
			
			<script type="text/javascript" src="scripts/ajax_boxrequest.js"></script>
			<script type="text/javascript" src="scripts/ajax_contentsection.js"></script>
			<script type="text/javascript" src="scripts/ajax_loginbox.js"></script>
			<script type="text/javascript" src="scripts/ajax_menuitem.js"></script>
			<script type="text/javascript" src="scripts/ajax_menuitem_feeder.js"></script>
			<script type="text/javascript" src="scripts/ajax_navigationalcontrol.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_303.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_327.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_333.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_339.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_339_notmp.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_339_anomalies.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_339_loadtemplate.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_339_template.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_resultsinwindow.js"></script>
			<script type="text/javascript" src="scripts/ajax_part139_welcomebox.js"></script>
			
			<script language="JavaScript" src="http://www.gvisit.com/record.php?sid=2673b02ddeacd6d8ee7e9198147ab7a8" type="text/javascript"></script>
			
			<!--<script type="text/javascript" src="scripts/equalcolumns.js"></script>-->
			<link href="defaultoa.css" rel="stylesheet" type="text/css">
			<link rel="stylesheet" media="all" type="text/css" href="css_play.css" />
			<!--[if IE 7]>
				<style type="text/css">
				.menu li {float:left;}
				</style>
				<![endif]-->
			<style type="text/css">
			.menu2 {list-style:none; padding:0px 0px 0px 0; margin:0 0 0 -10px; width:23px; background:transparent;}
			.menu2 li {display:block; width:25px; margin-bottom:-29px;}
			.menu2 li a {text-decoration:none; color:#fff; font-size:11px; line-height:10px; position:relative; border:0;}

			.menu2 li a em {display:block; width:25px; height:29px;background:url(rtl_default.gif) left bottom; font-style:normal;}
			.menu2 li a b {display:block; padding:29px 7px 0 3px; text-decoration:none; background:url(rtl_default.gif) left top; color:#fff; writing-mode:tb-rl;}


			.menu2 li a:hover {border:0; z-index:100; cursor:pointer;}
			.menu2 li a:hover em {background-image: url(rtl_hover.gif);}
			.menu2 li a:hover b {background-image: url(rtl_hover.gif); color:#660;}

			.menu2 li a.selected, .menu li a:hover.selected {border:0; position:relative; z-index:200; cursor:default;}
			.menu2 li a.selected em, .menu li a:hover.selected em {background-image: url(rtl_selected.gif);}
			.menu2 li a.selected b, .menu li a:hover.selected b {background-image: url(rtl_selected.gif); color:#242;}

			</style>
			<!--[if gte IE 7]>
			<style type="text/css">

			.menu2 li a b {float:left;  background:url(rtl_default.gif) right top; color:#fff; writing-mode:tb-rl;}

			</style>
			<![endif]-->
			</head>
		<?
	// Start the BODY of the HTML Document
		?>			
		<body topmargin="3" leftmargin="3" rightmargin="3" bottommargin="3" onLoad="cacheOff()">
			<SCRIPT LANGUAGE="JavaScript">
		    ver = navigator.appVersion.substring(0,1)
		    if (ver >= 4)
		    	{
		    	document.write('<DIV ID="cache" style="position:absolute; z-index:9; left:0; top:0; width:300; align="left"><table border="0" width="100%" id="tblbrowseformtable" cellspacing="0" cellpadding="0"><tr><td width="10" class="tableheaderleft">&nbsp;</td><td class="tableheadercenter">THE PAGE YOU REQUESTED IS LOADING...</td><td class="tableheaderright">(Please wait, thank you.)</td></tr><tr><td class="formanswers_multicolumn" colspan="3" align="center" valign="middle" height="200"><img src="images/animated_timer_bar.gif"></td></tr></table></DIV>');
		    	var navi = (navigator.appName == "Netscape" && parseInt(navigator.appVersion) >= 4);
		    	var HIDDEN = (navi) ? 'hide' : 'hidden';
		    	var VISIBLE = (navi) ? 'show' : 'visible';
		    	var cache = (navi) ? document.cache : document.all.cache.style;
		    	largeur = screen.width;
		    	cache.left = Math.round(100);
				sWidth = screen.width;
				sHeight = screen.height
				cache.left = (sWidth / 2) - 500;
				cache.top = (sHeight / 2) - 300;
				cache.right = (sHeight / 2) - 500;

		    	cache.visibility = VISIBLE;
		    	}
		    function cacheOff()
		    	{
		    	if (ver >= 4)
		    		{
		    		cache.visibility = HIDDEN;
		    		}
		    	}
		    </SCRIPT>
		<?
	// End of Header File, the content of each page is controled on that page from this point in
		?>