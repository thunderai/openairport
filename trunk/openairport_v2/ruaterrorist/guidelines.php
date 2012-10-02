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
//	Name of Document	:	_guidelines.php
//
//	Purpose of Page		:	FORM SIDE 	- Just tells the user what the CSV should look like
//							SERVER SIDE - No Server Interaction.
//
//==============================================================================================
//3456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789
//		 1		   2		 3		   4		 5		   6		 7		   8	     9	

// Prevent System From Timeing out while doing a search of the database	   
		set_time_limit(0);
		
// Include Files nessary to complete any tasks assigned.		
		include("includes/generalsettings.php");
		include("includes/functions.php");
		include("includes/interface.php");

// Establish Page Name			
		$pagename = 'CSV File Guildelines';		
		
// Check to see if a user is currently logged Into the System.  We do this to prevent direct linking
//	to the document. If someone tries to direct link to the page, the broweser will show a 404 error.
		//echo "Session ID is [".$_SESSION['user_id'],"]";
		if ($_SESSION['user_id'] == '') {
				//echo "There has been a request for this page outside of normal operating procedures<br>";
				send_404();
			}
			else {
				//echo "The request for this page seems to be in order, allow page to be displayed <br>";
				?>
<HTML>
	<HEAD>
		<TITLE>
			Welcome to RUAT
			</TITLE>
		<link rel="stylesheet" href="scripts/style.css" type="text/css">
		</HEAD>
	<BODY>
		<table width="100%" Class="windowMain" CELLSPACING=1 CELLPADDING=2>
			<tr>
				<td>
					<?
					breadcrumbs('guidelines.php', $pagename);
					?>
					</td>
				</tr>
			<tr>
				<td class="newTopicTitle">
					<?=$pagename;?>
					</td>
				</tr>
			<tr>
				<td class="newTopicBoxes" align="left" valign="top">
					<p>
					In order for this system to accurately compare your user list CSV to the watch lists provided 
					by the TSA you will need to ensure that the file you upload uses the same format as the TSA 
					Watch lists, minus the SID and CLEARED columns. The file must also be in CSV not a TSV (tab 
					separated value sheet).  Provided below is an example document to show you the style of the 
					document you need to upload.<br>
					<br>
					<a href="example.csv" target="_new">Example CSV</a><br>
					</p>
					<br>
					<p>
						One of the easist ways to make this file is by listing your employees in Excel and then 
						saving the list as a CSV (MS-DOS). You will need to ensure that each line has nine (9) 
						columns seperated by commas and that at a minimum a last name and first name is provided.
						</p>
					<br>
					<p>
						One possible example with just a first and a last name is: <br>
						<br>
						<b> Example One </b>
						<br>
						<blockquote>
							Dahl,Erick,,,,,,,
							</blockquote>
						<br>
						Another possible example with a last name, first name, and a middle name is: <br>
						<br>
						<b> Example Two </b>
						<br>
						<blockquote>
							Dahl,Erick,Alan,,,,,,
							</blockquote>
						<br>
						If you know more about the person, you can add in even more information: <br>
						<br>
						<b> Example Three </b>
						<br>
						<blockquote>
							Dahl,Erick,Alan,,10/06/1978,"USA, Minnesota",,,"Male; 5'11, 250lbs, black hair, blue eyes."
							</blockquote>
						<br>
						It is important to remember that the SD does not require you to match anything other than 
						the first name, last name, and a middle name if collected. An Offical search will only 
						search those three things, anything else added into the CSV will be ignored. In this case, 
						Example Two gives the system all of the information it needs.
					</td>
				</tr>
			<tr>
				<td colspan="12" class="newTopicEnder">
					&nbsp;
					<?
					display_copywrite_footer();
					?>
					</td>
				</tr>	
			</table>
		</body>
	</html>
	<?
	}
?>	