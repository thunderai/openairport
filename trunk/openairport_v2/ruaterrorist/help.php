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
//	Name of Document	:	help.php
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
		$pagename = 'RUAT - HELP';		
		
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
					breadcrumbs('help.php', $pagename);
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
						Below you will find the instructions you will need to get your airport 
						setup and running. The setup process is rather simple and if you ever have 
						any question about any of the following steps please contact the system 
						administrator.					
						</p>
					<br>
					<p>
						<b>Step One:</b>
						</p>
					<br>
					<p>
						Before you can do anything in RUAT you will need to create the CSV file that 
						has all of your airport operators and any person who falls under the name 
						comparison regulations. If you are unsure who this is, please contact your 
						FSD for your region and they will be happy to assist you.
						</p>
					<br>
					<p>
						<b>Step Two:</b>
						</p>
					<br>
					<p>
						You can check out the CSV file guidelines for more information on how to 
						format your file. Once the file is made and ready navigate to the &#8216;
						<u>Upload New List button</u>&#8217; by clicking on &#8216;Options&#8217; 
						in the left hand menu and then click the &#8216;<u>Upload New List button</u>
						</p>
					<br>
					<p>
						<img src="images/image002.jpg">
						</p>
					<br>
					<p>
						Once the &#8216;<u>Upload New List button</u>&#8217; has been clicked the 
						following window pane will be displayed.
						</p>
					<br>
					<p>
						<img src="images/image004.jpg">
						</p>
					<br>
					<p>
						More information on how to format the CSV file can be found by clicking the 
						Hyperlink (<i style='mso-bidi-font-style:normal'>See Guidelines</i>) Marked 
						by the One on the picture. When you have a CSV file that meets the 
						guidelines you can click the &#8216;Browse&#8217; button to find the file on 
						your local computer and then click the &#8216;Open&#8217; button in the 
						Windows Explorer window. This will add the file to the text box to the left 
						of the button.<span style='mso-spacerun:yes'>&nbsp; </span>You may then 
						click the &#8216;Upload&#8217; button marked as number 3 on the picture and 
						your file will be uploaded.
						</p>
					<br>
					<p>
						<b>Step Three:</b>
						</p>
					<br>
					<p>
						With your CSV successfully uploaded to RUAT you create the search that will 
						become the foundation of your nightly email updates. To create the search 
						click the &#8216;Manage Searches&#8217; button, marked one on the image 
						below on the left side menu.
						</p>
					<br>
					<p>
						<img src="images/image006.jpg">
						</p>
					<br>
					<p>	
						When the new window pane is displayed, click the &#8216;Add
						New Search&#8217; Button marked number 2 on the image above. When the button is
						clicked a new window pane will be displayed allowing you to provide search
						criteria or run an official search meeting the requirements of the SD. Make
						sure the select box marked 1 on the image below is set to &#8220;Yes&#8221; and
						then click the &#8216;Submit&#8217; button located at the right bottom of the
						screen (not shown on image).
						</p>
					<br>
					<p>
						<img src="images/image008.jpg">
						</p>
					<br>
					<p>	
						Once the &#8216;Submit&#8217; button is clicked the computer
						will start to think and it may take awhile for anything to be displayed.<span
						style='mso-spacerun:yes'>&nbsp; </span>Do not close your browser during this
						process. A progress bar should show up in the left-hand corner of the window
						pane telling you how much work has been done.
						</p>
					<br>
					<p>
						When the process bar reaches 100% the contents of the search
						will be displayed. Hopefully there will not be many matches found. Look over
						any matches the system finds to ensure it is a false positive. If you believe
						you have a positive match follow contact procedures for your airport. Below is
						a screen showing no matches found.
						</p>
					<br>
					<p>
						<img src="images/image010.jpg">
						</p>
					<br>
					<p>
						Up to this point you have done everything you may ever need
						to do; however, if you need to add someone to your CSV file, just upload a new
						list and create a new search.<span style='mso-spacerun:yes'>&nbsp; </span>Make
						sure you click the &#8216;Clear all Searches&#8217; before you click the
						&#8216;Add New Search&#8217; button.
						</p>
					<br>
					<p>
						Every time a new watch list is imported by the System
						Administrator the system will run a &#8216;nightly maintenance&#8217; procedure
						that will run all of your saved searches looking for a new match.<span
						style='mso-spacerun:yes'>&nbsp; </span>If the system finds one, you will
						receive an email informing you which one of your people have a possible match
						and providing you directions on what to do next.
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