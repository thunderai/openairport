<?
//*****************************************************************************************************************
//*****************************************************************************************************************
// RUAT - BILLING INFORMATION PAGE
//*****************************************************************************************************************
// Built by Erick Alan Dahl 2008 erick_dahl@hotmail.com
//*****************************************************************************************************************

include("includes/generalsettings.php");
include("includes/functions.php");	

$pagename = 'Welcome to RUAT';
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
			</table>
		</body>
	</html>					