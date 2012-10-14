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

	include("includes/_template_header.php");																// include file that gets information from form posts for navigational purposes

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
// This must be done first to ensure that the rest of the controls on the page work.z-index:
	?>
	<div ID="menusystem" style="position:fixed;top:40px;height:45px;width:100%;z-index:9;">
		<table border="0" width="100%" id="table1" cellpadding="0" cellspacing="0">
			<tr>
				<td class="layout_topheader_menubar" id="navigational_control">
					<?php
					// Display Navigtional Menu System					
					$whoareyou = $_SESSION["user_id"];	
					//loadnavmenu_3($whoareyou);				
					loadnavmenu_4($whoareyou);
					?>
					</td>
				</tr>
			</table>
		</div>
<?php
// Display Header Information
?>
	<div style="position:fixed;left:0px;top:0px;z-index:2;width:100%;" align="center" ID="content">
		<table border="0" width="100%" id="table1" cellpadding="0" cellspacing="0" style="margin: 0px;">
			<tr>
				<td rowspan="2" colspan="2" width="300"	class="layout_topheaderleft" id="layout_topheaderleft" align="left" valign="middle">
					<?php echo $nameofairport;?><br>
					<?php
					fwelcomebox($whoareyou);
					?>
					</td>
				</tr>
			<tr>
				<td height="1" width="*" class="layout_topheadercenter" id="layout_topheadercenter">
					<?php
					// This is the intial load of the Quick User Access Control System.
					//		All subsequent calls will be updatd by the AJAX function until the next page reload.
					loadquickaccessmenu($whoareyou);
					?>
					</td>
				<td width="100"	class="layout_topheaderright" id="loginbox" align="center" valign="middle">
					<?php
					// This is the User Control Menu System Function.
					//		Content is conteoled in the UserFunction include
					flogheader($whoareyou);
					?>
					</td>
				</tr>
			</table>
		</div>
<?php
// Display iFrame Information
?>		
	<div style="position:absolute;left:0px;top:65px;width:100%;z-index:1;">	
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td height="300" width="*" colspan="4" rowspan="1" class="layouttablecontent" 		id="contentsection">					
					<iframe id="layouttableiframecontent" name="layouttableiframecontent" SRC="index_new.php" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%; display:none"></iframe>
					</td>
				</tr>
			</table>
		</div>
<?php
// Display Footer Information
?>

	<div style="position:fixed;bottom:-3px;left:0px;width:100%;z-index:2;">		
		<table width="100%" border="0" cellspacing="0" id="footer" name="footer" bgcolor="#000000">
			<tr>
				<td colspan="4" align="center" id="timetaken" name="timetaken">
					<font face="arial" color="#FFFFFF" size="3">
						<align="center">Page has not completed loading, please wait...
						</font>
					</td>
				</tr>
			<tr>
				<td colspan="4" align="center" >
					<font face="arial" color="#FFFFFF" size="3">
						OpenAirport.org</font><font face="arial" size="2" color="#FFFFFF"> <span title="48">©</span> <span title="10.1.1.241"><?php echo date('Y');?></span>
						</font>
					</td>
				</tr>
			</table>
		</div>
<?php
include("includes/_userinterface/_ui_footer.inc.php");				// include file that gets information from form posts for navigational purposes
?>