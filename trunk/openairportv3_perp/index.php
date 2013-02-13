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

	$whoareyou = $_SESSION["user_id"];

//	-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//	1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890
//			 1		   2		 3		   4		 5		   6		 7		   8		 9		   0   
//
//	DEFINE PAGE LAYOUT
//
?>	
		<div style="position:fixed;top:0;width:100%;z-index:100;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin: 0px; margin-bottom:0px; margin-top:0px;">
				<tr>
					<td align="left" valign="middle" background="images/_interface/headerbg.gif" class="perp_smallwhite_text">&nbsp;<?php echo $nameofairport;?> - Welcome <?php fwelcomebox($whoareyou); ?></td>
					<td background="images/_interface/headerbg.gif" class="perp_smallwhite_text">&nbsp;</td>
					<td align="right" valign="top" background="images/_interface/headerbg.gif"><image border="0" src="images/_interface/headerright.gif"></td>
					</tr>
				<tr>
					<td align="left" valign="middle" background="images/_interface/subheaderbg.gif"><image border="0" src="images/_interface/subheaderleft.gif"></td>
					<td align="left" valign="middle" background="images/_interface/subheaderbg.gif">
						Did you Know?
						</td>
					<td width="*" align="right" valign="top" background="images/_interface/subheaderbg.gif">
						<img style="margin-bottom:0;float:right;" src="images/_interface/icon_mainmenu_help.png" width="30" height="30" alt="Information" 	onClick="get4help_win=dhtmlwindow.open('gethelp_ajax'	, 'iframe', '_suc_help.php'						, 'Get Help'	, 'width=600px,height=400px,left=100px,top=150px,resize=1,scrolling=1,center=1'); return false;">
						
						
						<?php 
						$targetname 		= '_iframe-iEditUser_iframe_win';
						$dhtml_name 		= 'iEditUser_iframe_var';
						$functioneditpage 	= 'part139303_a_report_user_edit.php';
						?>	
					<form style="margin-bottom:0;float:right;" action="<?php echo $functioneditpage;?>" method="POST" name="userform" id="userform" target="<?php echo $targetname;?>" onSubmit="<?php echo $dhtml_name;?>=dhtmlwindow.open('iEditUser_iframe_win', 'iframe', '', 'Edit Your User Information', 'width=600px,height=400px,resize=1,scrolling=1,center=1', 'recal')" />
						<input NAME="targetname" ID="targetname"
							value="<?php echo $targetname;?>" 
							type="hidden" />
						<input NAME="dhtmlname" ID="dhtmlname"
							value="<?php echo $dhtml_name;?>" 
							type="hidden" />
						<input type="image" src="images/_interface/icons/icon_gear.png" alt="Submit button">
						</form>
						<a href="index_newlogin.php" style="margin-bottom:0;float:right;"><img src="images/_interface/icon_mainmenu_logout.png" border="0" width="30" height="30" alt="Log Out"></a>
						</td>
					</tr>
				</table>
			</div>	
			
	<div style="position:fixed;top:65;width:100%;height:100%;z-index:90;">
		<iframe id="airportmap" name="airportmap" SRC="_iframe_getairportmap.php" width="100%" height="100%" scrolling="yes" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%;"></iframe>
		</div>	

	<div style="position: fixed;bottom: 0px;background-color: #FFFFFF;width:100%;z-index:100;">
		<table width="100%" cellpadding="0" cellspacing="0" style="margin: 0px; margin-bottom:0px; margin-top:0px;">
			<tr>
				<td align="left" valign="middle" background="images/_interface/headerbg.gif" class="perp_smallwhite_text" />&nbsp;<a href="http://code.google.com/p/openairport/" target="_new" />OpenAirport.org</a></td>
				<td colspan="2" background="images/_interface/headerbg.gif"></td>
				<td align="right" valign="middle" background="images/_interface/headerbg.gif" class="perp_smallwhite_text" />Erick Alan Dahl <?php echo date('Y');?></td>
				</tr>
			</table>
		</div>				
	
<?php 
//	-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//	1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890
//			 1		   2		 3		   4		 5		   6		 7		   8		 9		   0   
//
//	DEFINE FIXED POSITION DIV LAYERS (NON DHTML WINDOWS)
//
?>

<div id="div_islandselect" style="position:fixed;top:75px;left:10px;width:70px;height:50px;z-index:100;"/>
	<TABLE class="maptools">			
			<td name="MapitButton" id="MapitButton"
				class="item_space_inactive" 
				onmouseover="MapitButton.className='item_space_active';" 
				onmouseout="MapitButton.className='item_space_inactive';" 
				onClick="contentpanel_win.close();
						quickaccessmenu_win.close(); 
						airportmap.div_mapSubmit.style.display='block';
						airportmap.div_maplayer.style.display='block';
						airportmap.div_maplayer2.style.display='block';
						airportmap.div_mapscale.style.display='block';"
						/>
				Mapit!
				</td>						
			</tr>					
		</table>
	</div>
	
<div id="div_islandselect" style="position:fixed;top:75px;left:95px;width:70px;height:50px;z-index:100;"/>
	<TABLE class="maptools">
		<tr>
			<td name="DashButton" id="DashButton" 
				class="item_space_inactive" 
				onmouseover="DashButton.className='item_space_active';" 
				onmouseout="DashButton.className='item_space_inactive';" 
				onClick="airportmap.div_mapSubmit.style.display='none';
						airportmap.div_maplayer.style.display='none';
						airportmap.div_maplayer2.style.display='none';
						airportmap.div_mapscale.style.display='none';
						airportmap.div_mapinfo.style.display='none';
						contentpanel_win=dhtmlwindow.open('layouttableiframecontent', 'iframe', 'index_new.php', 'Dash Panel', 'top=75px,left=175px,width=910px,height=525px,resize=1,scrolling=1,center=0', 'recal');quickaccessmenu_win=dhtmlwindow.open('qam_div', 'div', 'quickaccessmenu', 'Quick Access', 'top=140px,left=10px,width=150px,height=310px,resize=1,scrolling=1,center=0', 'recal')" />
				Dash Panel
				</td>
			</tr>
		</table>
	</div>	
	
<?php
// 	DEFINE DIV LAYER DHTML WINDOWS...
//		They are not loaded here, they are just defined
?>	
	
<div class="fullscreen" name="navigationdisplaypanel" id="navigationdisplaypanel" style="display: none;" />
	<table width="95%" cellpadding="0" cellspacing="0" style="margin:0px;border:0px solid;padding:0px;border-style: solid;border-color: #000000;border-collapse: collapse;" />
		<tr>
			<td id='navigationajaxcenter' />
				<?php
				// Display Navigtional Menu System					
				$whoareyou = $_SESSION["user_id"];	
				//loadnavmenu_3($whoareyou);				
				loadnavmenu_5($whoareyou,'root');
				?>
				</td>
			</tr>
		</table>
	</div>

<div id="quickaccessmenu" name="quickaccesmenu" style="display: none;" />
	<table width="100%" cellpadding="0" cellspacing="0" style="margin:0px;border:0px solid;padding:0px;border-style: solid;border-color: #000000;border-collapse: collapse;" />
		<tr>
			<td name="MainMenuButton" id="MainMenuButton" 
				class="item_name_inactive" 
				onmouseover="MainMenuButton.className='item_name_active';" 
				onmouseout="MainMenuButton.className='item_name_inactive';" 
				onClick="divwin=dhtmlwindow.open('navigationdisplaypanel_div', 'div', 'navigationdisplaypanel', 'Menu Navigation', 'width=350px,height=225px,left=200px,top=150px,resize=0,scrolling=0,center=1'); return false;" />
				Main Menu
				</td>
			</tr>
		<tr>
			<td id="layout_topheadercenter" name="layout_topheadercenter" />
				<?php
				loadquickaccessmenu($whoareyou);
				?>
				</td>
			</tr>
		</table>
	</div>	

<div id="systemactivity_win" name="systemactivity_win" style="display: none;" />
	<table width="100%" cellpadding="0" cellspacing="0" style="margin:0px;border:0px solid;padding:0px;border-style: solid;border-color: #000000;border-collapse: collapse;" />
		<tr>
			<td class="perp_systemactivity_box" />
				Time Taken (s):
				</td>
			<td class="perp_systemactivity_box" name="timetaken" id="timetaken" />
				???
				</td>				
			</tr>
		<tr>
			<td class="perp_systemactivity_box" />
				Action ID:
				</td>
			<td class="perp_systemactivity_box" name="actionid" id="actionid" />
				<!-- Action ID is ..... -->
				???
				</td>				
			</tr>
		<tr>
			<td class="perp_systemactivity_box" />
				Start #:
				</td>
			<td class="perp_systemactivity_box" name="startnumber" id="startnumber" />
				<!-- Left over from LCAR format.  Controls how many quick access menu items were displayed-->
				<!-- I left this in the code in case I want to use it again.-->
				<input class="perp_transperent_small_text" type="text" size="3" name="qa_start" id="qa_start" value="0" />
				</td>				
			</tr>	
		<tr>
			<td class="perp_systemactivity_box" />
				End #:
				</td>
			<td class="perp_systemactivity_box" name="startnumber" id="startnumber" />
				<!-- Left over from LCAR format.  Controls how many quick access menu items were displayed-->
				<!-- I left this in the code in case I want to use it again.-->
				<input class="perp_transperent_small_text" type="text" size="3" name="qa_end" id="qa_end" value="<?php echo $qua_e;?>" />
				</td>				
			</tr>			
		<tr>
			<td colspan="2" class="perp_systemactivity_box" />
				&nbsp;
				</td>
			</tr>
		<tr>
			<td colspan="2" id="layout_topheadercenter" name="layout_topheadercenter" />
				<div name="SystemText" id="SystemText" class="perp_systemactivity_box" />
					Waiting for system data...You should do something...
					</div>
				</td>
			</tr>
		</table>
	</div>	
	
<?php
// LOAD DHTML WINDOWS on PAGE LOAD...
?>	
<script type='text/javascript'>
	var quickaccessmenu_win=dhtmlwindow.open('qam_div', 'div', 'quickaccessmenu', 'Quick Access', 'top=140px,left=10px,width=150px,height=310px,resize=1,scrolling=1,center=0', 'recal')
	</script>
	
<script type='text/javascript'>
	var systemactivitypanel_win=dhtmlwindow.open('systemtext_div', 'div', 'systemactivity_win', 'System Activity', 'top=500px,left=10px,width=150px,height=120px,resize=0,scrolling=0,center=0', 'recal')
	</script>
	
<script type='text/javascript'>
	var contentpanel_win=dhtmlwindow.open('layouttableiframecontent', 'iframe', 'index_new.php', 'Dash Panel', 'top=75px,left=175px,width=910px,height=530px,resize=1,scrolling=1,center=0', 'recal')
	</script>	

<?php
include("includes/_userinterface/_ui_footer.inc.php");				// include file that gets information from form posts for navigational purposes
?>