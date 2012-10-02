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
//	Name of Document	:	Index.php
//
//	Purpose of Page		:	This is the main structure of the system. Most every page in the
//							system fits into the structure of this document. Usually being
//							displayed in the layouttableiframecontent iframe.
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		

// Include Required Files

	include("includes/header.php");																// include file that gets information from form posts for navigational purposes

if (!isset($_POST["systemuserid"])) {
		if ($tbldatesort==1) {
				$_SESSION["user_id"] = '';
			}
		//tblsqlwhereaddon = 1
	}
	else {
		$_SESSION["user_id"]=$_POST["systemuserid"];
		//tblsqlwhereaddon = 1
	}	
	
	//echo "active user".$_SESSION["user_id"];
	
// Display Navigational Menu System as well as login controls.
// This must be done first to ensure that the rest of the controls on the page work.
	?>
	<div style="position:absolute;left:-10px;top:48px;height:0px;width:100px;padding:1em;">
		<?
		// Display Navigtional Menu System
		
		$whoareyou = $_SESSION["user_id"];
		
		loadnavmenu($whoareyou);
		?>
		</div>
<?
// Display layout format
?>
		<div align="center">
			<table border="0" width="100%" id="table1" cellpadding="0" cellspacing="0">
				<tr>
					<td height="49"	width="100"							class="layout_topheaderleft" 	id="layout_topheaderleft"><img src="images/layoutheaderlogo.gif" id="spotlight" speed="50" ></td>
					<td height="49" width="320"							class="layout_topheadercenter" 	id="layout_topheadercenter">OpenAirport.org</td>
					<td height="49" width="*"							class="layout_topheaderright" 	id="loginbox">
						<?
						// Load Fucntion to make the top menu system. Layout will depend on if a user is logged into the system or not
						echo $_Session['user_id'];
						flogheader();
						?>
						</td>
					</tr>
				<tr>
					<td 						colspan="1"	rowspan="3"	class="layout_navigation" 		id="navigational_control">
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br> 
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br> 
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br> 
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						</td>
					<td height="26"				colspan="2"	rowspan="1"	class="layout_welcomebox" 		id="welcomebox">
						<?
						// Determine if a user is currently logged into the system
						//catchuserid($strattemptedusername, $strattemptedpassword);
						// Display Welcome box information
						fwelcomebox();
						?>
						</td>
					</tr>
				<tr>
					<td height="300" width="*"	colspan="2" rowspan="1" class="layouttablecontent" 		id="contentsection">					
						<iframe id="layouttableiframecontent" name="layouttableiframecontent" SRC="index_new.php" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%; display:none"></iframe>
						</td>
					</tr>
				<tr>
					<td id="footernavigation" colspan="2" valign="top" align="center" height="1">
						<table border="0" cellpadding="0" cellspacing="5">
							<tr>
								<td align="center" id="about" 		onMouseOver="fontabout.color='#FFFFFF',this.bgColor='#AC9D8A' " onMouseOut="fontabout.color='#000000', this.bgColor='#FAEBD7'" style="padding-left: 5px; padding-right: 5px; padding-top: 2px; padding-bottom: 2px"><font face="arial" size="1" color="#000000" id="fontabout">about</font></td>
								<td align="center" id="blog" 		onMouseOver="fontablog.color='#FFFFFF',this.bgColor='#AC9D8A' " onMouseOut="fontablog.color='#000000', this.bgColor='#FAEBD7'" style="padding-left: 5px; padding-right: 5px; padding-top: 2px; padding-bottom: 2px"><font face="arial" size="1" color="#000000" id="fontablog">blog</font></td>
								<td align="center" id="developers" 	onMouseOver="fontdevlo.color='#FFFFFF',this.bgColor='#AC9D8A' " onMouseOut="fontdevlo.color='#000000', this.bgColor='#FAEBD7'" style="padding-left: 5px; padding-right: 5px; padding-top: 2px; padding-bottom: 2px"><font face="arial" size="1" color="#000000" id="fontdevlo">developers</font></td>
								<td align="center" id="privacy" 	onMouseOver="fontpriva.color='#FFFFFF',this.bgColor='#AC9D8A' " onMouseOut="fontpriva.color='#000000', this.bgColor='#FAEBD7'" style="padding-left: 5px; padding-right: 5px; padding-top: 2px; padding-bottom: 2px"><font face="arial" size="1" color="#000000" id="fontpriva">privacy</font></td>
								</tr>
							<tr>
								<td colspan="4" align="center" valign="top" height="1">
									<font face="arial" size="1">an erick alan dahl organization</font>
									<br>
									<font face="arial" size="1">openairport <span title="48">©</span> <span title="10.1.1.241">20</span><span title="1841408">06</span></font>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
<?
include("includes/footer.php");				// include file that gets information from form posts for navigational purposes
?>