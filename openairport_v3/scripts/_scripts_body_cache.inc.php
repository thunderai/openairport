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
//	Name of Document		:	_scripts_body_cache.inc.php
//
//	Purpose of Page			:	To set certain global variables in the system
//
//	Special Notes			:	Changce the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

	// Link to Body Cache Procedures

	// CACHE LOADING MESSAGE
	//		Assemble Message...
	?>	
	
		<SCRIPT LANGUAGE="JavaScript">
		ver = navigator.appVersion.substring(0,1)
		if (ver >= 4)
			{
			document.write('<DIV ID="cache" style="position:absolute; z-index:9; left:0; top:0; width:300; align="left"><table border="0" width="600" id="tblbrowseformtable" cellspacing="0" cellpadding="0"><tr><td width="10" class="tableheaderleft">&nbsp;</td><td class="tableheadercenter">THE PAGE YOU REQUESTED IS LOADING...</td><td class="tableheaderright">(Please wait, thank you.)</td></tr><tr><td class="formanswers_multicolumn" colspan="3" align="center" valign="middle" height="200"><img src="stylesheets/_cssimages/animated_timer_bar.gif"></td></tr></table></DIV>');
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