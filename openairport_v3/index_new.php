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
//	Name of Document	:	Index_new.php
//
//	Purpose of Page		:	Place holder, while program catches user login information
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		

// Include Required Files

	include("includes/_template_header.php");																// include file that gets information from form posts for navigational purposes

if ($_SESSION['user_id']=="") {
		?>
		<table border="0" width="100%" cellspacing="5" cellpadding="2">
			<tr>
				<td width="5">&nbsp;</td>
				<td>
					<font face="Arial Narrow" size="3">
						<b>
							Welcome to OpenAirport.org<br>
							The Open Source Advanced Record Keeping System for Airports
							</b>
						</font>
					<br>
					<div class=Section1>
						<p class=MsoNormal><font face="Arial Narrow" size="4">OpenAirport.org is a revolutionary record keeping system
						that exceeds the requirements of federal, state, and local governments
						pertaining to airport operations. OpenAirport.org provides an airport with an
						easy to use, quick to learn, and accurate software solution for all aspects of
						an airports operation. OpenAirport.org is the leading open source software
						solution for airports and the reasons are clear.</p>

						<p class=MsoNormal>OpenAirport.org is designed from the ground up to be the
						leading product for airports that has the lowest total cost of ownership.  The
						total cost of the software is zero dollars, yes, nothing.  As an Open Source
						software solution the software is yours to use as you please as long as you
						credit OpenAirport.org for the basis of your system.  As the base of your
						System the code that drives OpenAirport.org may be changed in whatever detail
						you like. </p>

						<p class=MsoNormal>Programmed in Zend PHP, MySQL AB Community Edition, and
						using either Microsoft IIS or Apache Group Apache server you can maximize your
						record keeping system with almost to no initial charges. Depending on the scope
						of your operation the system can work out on your Aircraft Operations Area
						using your WPA Local Area Network. The larger your operation the more benefit you
						may see from the OpenAirport.org system.</p>

						<p class=MsoNormal>Since the system is programmed with all operations in mind,
						you may find little need to change how the system works, but that does not mean
						you can not.  The airport has complete control over how data is used, who can
						see what data, what forms look like, how they work, and most importantly, total
						control over everything.</p>

						<p class=MsoNormal>For additional information about the system please click one
						of the links to the left hand panel.</p>

						<p class=MsoNormal>-Thanks.</p>
						</div>
						</td>
					</tr>
				</table>
<?php 
	}
	else {
		?>
		<table width="100%" height="1000" valign="top" background="images/part_139_327/part139_327_airportmap_new_color.png" />
			<tr>
				<td valign='top'>
					<?php
		//$tmpstarttime 	= time();

		include("includes/_template_dashpanel.php");	
		
		//$tmpendtime 	= time();
		
		//$displaytime	= ( $tmpstarttime - $tmpendtime );
		
		//echo "Display Time :".$displaytime;
					?>
					</td>
				</tr>
			</table>
		<?php

	}
	include("includes/_userinterface/_ui_footer.inc.php");		// include file that gets information from form POSTs for navigational purposes
?>	