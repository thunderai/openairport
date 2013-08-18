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
	include("includes/_template/template.list.php");
	
if (!isset($_POST["systemuserid"])) {
		// SystemUserID is not set from the POST object.
		//		Set variables accordingly
		//
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

	if ($whoareyou == '') {
			// NO CURRENT USER IN SESSION VARIABLE
			//		Send user to Login Screen
			//
			?>
			<form name="redirect_form_3" id="redirect_form_3" action="index_newlogin.php" method="POST">
			<input class="combobox" type="hidden" size="1" name="redirect_input_3" id="redirect_input_3">
			<script type="text/javascript">
				<!--
					var targetURL="index_newlogin.php"
					var countdownfrom=1
					var currentsecond = document.getElementById('redirect_input_3').value=countdownfrom+1
					function countredirect(){
						if (currentsecond!=1){
							currentsecond-=1
							document.getElementById('redirect_input_3').value=currentsecond
							}
							else{
								document.getElementById('redirect_form_3').submit();
						return
						}
						setTimeout("countredirect()",0)
						}
						countredirect()
				//-->
				</script>
				</form>			
			<?php
		} else {
			//	-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			//	1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890
			//			 1		   2		 3		   4		 5		   6		 7		   8		 9		   0   
			//
			//	DEFINE PAGE LAYOUT
			//
				$screen_x_tmp	= 0;
				$header_height	= 30;
				//$screen_x_tmp	= $screen_x - $header_height;
			?>	
			<div style="position:fixed;top:0;width:100%;z-index:100;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin: 0px; margin-bottom:0px; margin-top:0px; height:<?php echo $header_height;?>px;" />
					<tr>
						<td class="item_name_inactive" width="*" />
							&nbsp;<?php echo $nameofairport;?> - Welcome <?php fwelcomebox($whoareyou); ?>
							</td>
						<td class="item_name_inactive" width="30%"/>
							Did you know!
							</td>
						<td class="item_name_inactive" width="300px"/>
							<?php
							//_tp_control_function_button_iframe($formname,$label,$icon,$action = '',$target = '',$display='show')
							/* onclick="<?php echo $formname;?>_var=dhtmlwindow.open('<?php echo $formname;?>_win', 'iframe', '<?php echo $action;?>', '<?php echo $label;?>', 'top=75px,left=175px,width=600px,height=300px,resize=1,scrolling=1,center=1', 'recal');" 
							 */
							_tp_control_function_button_iframe('gethelp_ajax','Get Help','icons_warning','_suc_help.php');
							_tp_control_function_button_iframe('edityouraccount','Your Account','icon_gear','part139303_a_report_user_edit.php');
							_tp_control_function_button_link('logout','Log Out','icon_close','index_newlogin.php');
							?>
							</td>
						</tr>
					</table>
				</div>	
			<?php
				$footer_height	= 15;
				$taskbar_height	= 40;
			?>		
			<div style="position: fixed;bottom: 0px;width:100%;z-index:100;">
				<table width="100%" cellpadding="0" cellspacing="0" style="margin: 0px; margin-bottom:0px; margin-top:0px;height:<?php echo $footer_height;?>px;" />
					<tr>
						<td class="item_name_inactive" width="*" />&nbsp;<a href="http://code.google.com/p/openairport/" target="_new" />OpenAirport.org</a></td>
						<td class="item_name_inactive" width="50%" />&nbsp;</td>
						<td class="item_name_inactive" width="200px" />Erick Alan Dahl <?php echo date('Y');?></td>
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
			//
			//	Mode Selection Switch Location Array
			//	array_mode = array($top,$left,$width,$height,$zindex);
				$mode_top 		= $header_height + 10;
				$mode_left		= 10;
				$mode_width		= 160;
				$mode_height	= 40;
				$mode_zindex	= 100;
				$array_mode		= array($mode_top,$mode_left,$mode_width,$mode_height,$mode_zindex);
			?>
			<div id="div_islandselect" style="position:fixed;top:<?php echo $array_mode[0];?>px;left:<?php echo $array_mode[1];?>px;width:<?php echo $array_mode[2];?>px;height:<?php echo $array_mode[3];?>px;z-index:<?php echo $array_mode[4];?>;"/>
				<TABLE class="maptools" width="100%" />
					<tr>
						<td>
							<?php
							_tp_control_function_button_mode('modeswitch','Map It!','icon_window','modeselectionswitch','modeswtich')
							?>
							<input type="hidden" name="modeswtich" id="modeswtich" value="map" />
							</td>
						</tr>
					</table>
				</div>
			<?php
			// 	DEFINE DIV LAYER DHTML WINDOWS...
			//		They are not loaded here, they are just defined
			?>
			<div class="fullscreen" name="navigationdisplaypanel" id="navigationdisplaypanel" style="display: none;" />
				<table width="100%" height="100%" cellpadding="0" cellspacing="0" />
					<tr>
						<td id='navigationajaxcenter' align="left" valign="top" />
							<?php
							// Display Navigtional Menu System					
							$whoareyou = $_SESSION["user_id"];	
							//echo "Who Are You ?".$whoareyou."<br>";
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
							onClick="divwin=dhtmlwindow.open('navigationdisplaypanel_div', 'div', 'navigationdisplaypanel', 'Menu Navigation', 'width=350px,height=250px,left=200px,top=150px,resize=1,scrolling=0,center=1'); return false;" />
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

			<div id="systemactivity_win" name="systemactivity_win" style="width:0px;height:0px;display: none;" />
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
							<input type="hidden" name="activepage" id="activepage" value="NOTHING" />
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
			//
			//	Set variables
			//	array_qam = array($top,$left,$width,$height,$zindex);
				$width_swath	= 4;																		// How much more width does a DHTML widget add to a nominal width.
				$qam_top 		= $array_mode[0] + $array_mode[3] + 10;										// Mode Top + Mode Height + 10
				$qam_left		= 10;
				$qam_width		= 160 - $width_swath;														// Standard width minus the swath
				$qam_height		= $screen_y - $array_mode[3] - $footer_height - $taskbar_height - 200;
				//echo "Height :".$qam_height."<br>";
				//$qam_height		= 40;
				$qam_zindex		= 100;																		// Not Used
				$array_qam		= array($qam_top,$qam_left,$qam_width,$qam_height,$qam_zindex);
			?>
			<script type='text/javascript'>
				var quickaccessmenu_win=dhtmlwindow.open('qam_div', 'div', 'quickaccessmenu', 'Quick Access', 'top=<?php echo $array_qam[0];?>px,left=<?php echo $array_qam[1];?>px,width=<?php echo $array_qam[2];?>px,height=<?php echo $array_qam[3];?>px,resize=1,scrolling=1,center=0', 'recal')
				</script>
			<?php
			/* <script type='text/javascript'>
				var systemactivitypanel_win=dhtmlwindow.open('systemtext_div', 'div', 'systemactivity_win', 'System Activity', 'top=0px,left=0px,width=0px,height=0px,resize=0,scrolling=0,center=0', 'recal')
				</script> */

			// LOAD DHTML WINDOWS on PAGE LOAD...
			//
			//	Set variables
			//	array_dash = array($top,$left,$width,$height,$zindex);
				$width_swath	= 4;																		// How much more width does a DHTML widget add to a nominal width.
				$dash_top 		= $header_height + 10;										// Mode Top + Mode Height + 10
				$dash_left		= $array_mode[2] + 20;
				$dash_width		= $screen_x - 10 - 10 - 20 - $array_mode[2];														// Standard width minus the swath
				$dash_height	= $screen_y - $footer_height - $taskbar_height - 190;
				//echo "Height :".$qam_height."<br>";
				//$qam_height		= 40;
				$dash_zindex		= 100;																		// Not Used
				$array_dash		= array($dash_top,$dash_left,$dash_width,$dash_height,$dash_zindex);
				
				echo "POST SETTINGS :".$_POST["bypassdash"]." <br>";
				
				if (!isset($_POST["bypassdash"])) {
						// Not set display it
						$displaydash = 1;
					} else {	
						if($_POST['bypassdash'] == 1) {
								// Bypass dash is one.  DO not display the dash
								$displaydash = 0;
							} else {
								$displaydash = 1;
							}
					}
				?>
			<script type='text/javascript'>
				var contentpanel_win=dhtmlwindow.open('layouttableiframecontent', 'iframe', 'index_new.php', 'Dash Panel', 'top=<?php echo $array_dash[0];?>px,left=<?php echo $array_dash[1];?>px,width=<?php echo $array_dash[2];?>px,height=<?php echo $array_dash[3];?>px,resize=1,scrolling=1,center=0', 'recal');
				</script>		

				
				
			<div name="indexmap" id="indexmap" style="position:fixed;top:0px;width:100%;height:100%;z-index:90;overflow:auto;" />
				<?php
				include('_iframe_getairportmap.php');
				//<iframe id="airportmap" name="airportmap" SRC="_iframe_getairportmap.php" width="100%" height="100%" scrolling="yes" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:hidden; width:100%;"></iframe>
				?>
				</div>	
			<?php
		}
include("includes/_userinterface/_ui_footer.inc.php");				// include file that gets information from form posts for navigational purposes
?>