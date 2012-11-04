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
	
// Build New Index Layout for LCARS layout

//	Set Height to 620px to test fitting on iPad--------------------------\
//  Set width to 975px to test fitting on iPad----------------\			  |
//															  |			  |
?>
<div style="position:fixed;left:5px;top:5px;z-index:10;width:<?php echo $width;?>;height:<?php echo $height;?>;border:0px solid;" />
	<table width="100%" bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
		<tr>
			<td align="left" valign="top">
				<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
					<tr>
						<td class="table_button_side_top_function" name="navigationalsidepanel" id="navigationalsidepanel" class="table_button_side_top_function" onclick="javascript:toggle('navigationdisplaypanel');" />
							Menu
							</td>
						<td class="table_button_side_top_function_gap" />
							&nbsp;
							</td>	
						<td class="table_button_side_top_function_help" onMouseover="ddrivetip('Open Menu Screen');" onMouseout="hideddrivetip();"/>
							&nbsp;
							</td>
						</tr>
					</table>					
				</td>
			<td colspan="11" rowspan="2" align="right" valign="top" />
				<table width="100%" height="75" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;text-align: right;" />
					<tr>
						<td name="WelcomeText" id="WelcomeText" class="welcometext" />
							<?php echo $nameofairport;?> - Welcome <?php fwelcomebox($whoareyou); ?>
							</td>
						</tr>
					<tr>
						<td />
							<div name="SystemText" id="SystemText" class="systemtext" />
								Waiting for system data...You should do something...
								</div>
							</td>
						</tr>
					</table>
				</td>				
			</tr>
		<tr>
			<td rowspan="2" class="table_top_sweep" onclick="loadintoIframe('layouttableiframecontent', 'part139303_a_report_user_edit.php')" style="cursor:hand;"/>
				<img src="images/_interface/lcars_top_sweep.png" />
				</td>				
			</tr>
		<tr>
			<td rowspan="1" class="table_top_sweep_tail"  style="cursor:hand;" onMouseover="ddrivetip('Open User Settings Page');" onMouseout="hideddrivetip();" />
				Settings
				</td>
			<td class="table_top_buttons_timetaken" id="timetaken" name="timetaken" onMouseover="ddrivetip('<b>Load Times</b><br>This page took this many milliseconds to load');" onMouseout="hideddrivetip();"/>
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_light1" id="qa_rpt" name="qa_rpt" onMouseover="ddrivetip('Menu Structure Points');" onMouseout="hideddrivetip();">
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_light2" id="actionid" name="actionid" />
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>				
			<td class="table_top_buttons_dark1" id="typeid" name="typeid" />
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_light1">
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>				
			<td class="table_top_buttons_light2">
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_dark1">
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_light1" colspan="2">
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_endcap" />
				<?php
				$random = rand(0,10);
				echo $random;
				?>
				</td>				
			</tr>
		<tr>
			<td colspan="1" ROWSPAN="2" class="table_bottom_sweep" onclick="loadintoIframe('layouttableiframecontent', 'part139303_a_report_user_edit.php')" style="cursor:hand;">
				<img src="images/_interface/lcars_bottom_sweep.png" />
				
				</td>
			<td colspan="11" rowspan="7" style="border:0px;padding:0px;margin:0px;" align="left" valign="top" />
				<div style="z-index:15;display: none;margin-left:-4px;margin-top:-2px;padding:0px;border:0px solid;" name="navigationdisplaypanel" id="navigationdisplaypanel">
					<table width="100%" height="<?php echo $height;?>" border="0" cellpadding="1" cellspacing="1" name="navigationajaxtable" id="navigationajaxtable" />
						<tr>
							<td align="left" valign="top" name="navigationajaxcenter" id="navigationajaxcenter" />
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
				<iframe id="layouttableiframecontent" name="layouttableiframecontent" SRC="index_new.php" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%;display:none;"></iframe>
				</td>
			</tr>
		<tr>

			</tr>	
		<tr>
			<td class="table_bottom_sweep">
				<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
					<tr>
						<td class="table_button_side_top_function" onclick="loadintoIframe('layouttableiframecontent', '_suc_help.php')" style="cursor:hand;"/>
							Help
							</td>
						<td class="table_button_side_top_function_gap" />
							&nbsp;
							</td>	
						<td class="table_button_side_top_function_help" onMouseover="ddrivetip('Open Help Screen');" onMouseout="hideddrivetip();"/>
							&nbsp;
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<tr>
			<form>
				<input type="hidden" name="qa_start" 	id="qa_start" 	value='0' />
				<input type="hidden" name="qa_end" 		id="qa_end" 	value="<?php echo $qua_e;?>" />
				</form>
			<td align="left" valign="top">
				<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
					<tr>
						<td class="table_button_side_top_function" id="button_up" class="table_button_side_top_function" onclick="javascript:call_server_load_quickaccess('<?php echo $whoareyou;?>','up');" />
							Up
							</td>
						<td class="table_button_side_top_function_gap" />
							&nbsp;
							</td>	
						<td class="table_button_side_top_function_help" onMouseover="ddrivetip('Move Quick Access Menu Items Up');" onMouseout="hideddrivetip();"/>
							&nbsp;
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<tr>
			<td id="layout_topheadercenter" name="layout_topheadercenter" />
				<?php 
				//echo $qua_e;
				loadquickaccessmenu($whoareyou,0,$qua_e);
				?>
				</td>			
			</tr>	
		<tr>
			<td align="left" valign="top">
				<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
					<tr>
						<td class="table_button_side_top_function" id="button_down" class="table_button_side_top_function" onclick="javascript:call_server_load_quickaccess('<?php echo $whoareyou;?>','down');" />
							Down
							</td>
						<td class="table_button_side_top_function_gap" />
							&nbsp;
							</td>	
						<td class="table_button_side_top_function_help" onMouseover="ddrivetip('Move Quick Access Menu Items Down');" onMouseout="hideddrivetip();"/>
							&nbsp;
							</td>
						</tr>
					</table>
				</td>				
			</tr>			
		<tr>
			<td align="left" valign="top">
				<table bgcolor="#000000" border="0" style="margin:0px;padding:0px;border:0px;border-collapse:collapse;" />
					<tr>
						<td class="table_button_side_top_red" onclick="window.location='index_newlogin.php'" />
							Logout
							</td>
						<td class="table_button_side_top_red_gap" />
							&nbsp;
							</td>	
						<td class="table_button_side_top_red_help" onMouseover="ddrivetip('Logout of OpenAirport. Your information will be saved.');" onMouseout="hideddrivetip();"/>
							&nbsp;
							</td>
						</tr>
					</table>
				</td>			
			</tr>
		</table>
	</div>

<div class="fullscreen" style="display: none;" name="navigationdisplaypanel" id="navigationdisplaypanel">
	<table width="100%" height="100%" border="0" cellpadding="1" cellspacing="1" name="navigationajaxtable" id="navigationajaxtable" />
		<tr>
			<td align="left" valign="top" name="navigationajaxcenter" id="navigationajaxcenter" />
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
	

<?php
include("includes/_userinterface/_ui_footer.inc.php");				// include file that gets information from form posts for navigational purposes
?>