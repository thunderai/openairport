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
//	Name of Document	:	welcome.php
//
//	Purpose of Page		:	FORM SIDE 	- Just shows text
//							SERVER SIDE - Just shows text
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
		$pagename = 'Welcome to RUAT';		
		
// Check to see if a user is currently logged Into the System.  We do this to prevent direct linking
//	to the document. If someone tries to direct link to the page, th e broweser will show a 404 error.
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
					breadcrumbs('welcome.php', $pagename);
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
					The “Are you a Terrorist?” (RUAT) is a comprehensive PHP, MYSQL application that will take a 
					given Comma Separated Value Sheet (CSV) and compare its contents to those people on government 
					watch lists.  The process requires the following steps:<br>
					<br>
					<ul>
					<li> Upload a document using the <a href="guidelines.php">guidelines</a> provided. </li>
					<li> Use the Manage Search button to create queries and see if there are any matches. </li>
					<li> You may also set up the system to email you when a match has been found when new lists are 
					populated from the TSA. </li>
					</ul>
					<br>
					This process mean you no longer have to manually compare your airport users, tenants, 
					construction workers, and any other frequent guests you may have to those watch lists. 
					You will save time, and your results will most likely be more accurate.<br>
					<br>
					This is an experiment used by the Watertown Regional Airport KATY-Cat IV) to meet the 
					requirements of the Part 1500 series requiring the airport to compare their users to the people 
					on the watch list. Because the project is experimental in nature it will be much slower than it 
					would be if it was in an actual multi-cluster server environment.<br>
					</p>
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