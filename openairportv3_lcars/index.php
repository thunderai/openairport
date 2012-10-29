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

?>
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

<div style="position:fixed;right:0px;top:50px;z-index:99;width:85%;height:80px;overflow:hidden;" align="right" ID="content">
	<table>
		<tr>
			<td name="SystemText" id="SystemText" class="systemtext" />
				Waiting for system data...You should do something...
				</td>
			</tr>
		</table>	
	</div>
	
<div style="position:fixed;left:0px;top:0px;z-index:2;width:100%;" align="center" ID="content">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="table_shoulder" />
				</td>
			<td rowspan="3" colspan="9" class="table_header_container" />
				<table border="0" cellpadding="0" cellspacing="0" width="100%" />
					<tr>
						<td name="WelcomeText" id="WelcomeText" class="welcometext" />
							<?php echo $nameofairport;?> - Welcome <?php fwelcomebox($whoareyou); ?>
							</td>
						</tr>
					</table>
				</td>			
			</tr>
		<tr>
			<td name="navigationalsidepanel" id="navigationalsidepanel" class="table_button_side_top_function" onclick="javascript:toggle('navigationdisplaypanel');" />
				Menu
				</td>
			</tr>
		<tr>
			<td class="table_button_top_sweep" onclick="loadintoIframe('layouttableiframecontent', 'part139303_a_report_user_edit.php')" style="cursor:hand;" onMouseover="ddrivetip('Open User Settings Page');" onMouseout="hideddrivetip();"/>
				Settings
				</td>
			</tr>
		<tr>
			<td class="table_top_sweep" onclick="loadintoIframe('layouttableiframecontent', 'part139303_a_report_user_edit.php')" style="cursor:hand;" onMouseover="ddrivetip('Open User Settings Page');" onMouseout="hideddrivetip();"/>
				<img src="images/_interface/lcars_top_sweep.png" border="0" style="float:left;" />
				</td>
			<td class="table_top_sweep_tail" onclick="loadintoIframe('layouttableiframecontent', 'part139303_a_report_user_edit.php')" style="cursor:hand;" onMouseover="ddrivetip('Open User Settings Page');" onMouseout="hideddrivetip();"/>
				&nbsp;
				</td>
			<td class="table_top_buttons_light2" id="qa_rpt" name="qa_rpt" onMouseover="ddrivetip('Menu Structure Points');" onMouseout="hideddrivetip();"/>
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_light1" />
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>			
			<td class="table_top_buttons_dark1" />
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>		
			<td class="table_top_buttons_light2" id="typeid" name="typeid" onMouseover="ddrivetip('Current Type ID');" onMouseout="hideddrivetip();" />
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_light1" id="actionid" name="actionid" onMouseover="ddrivetip('Current Action ID');" onMouseout="hideddrivetip();"/>
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_light1" id="timetaken" name="timetaken" onMouseover="ddrivetip('Data has taken this many milliseconds to load');" onMouseout="hideddrivetip();"/>
				<?php
				$random = rand(0,2000);
				echo $random;
				?>
				</td>
			<td class="table_top_buttons_endcap" />
				&nbsp;
				</td>
			</tr>
		<tr>
			<td colspan="10" bgcolor="000000" />
				&nbsp;
				</td>
			</tr>			
		</table>
	</div>
	
<div style="position:fixed;left:180px;top:200px;right:0;z-index:99;overflow: hidden;height: 75%;">	
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td class="table_maincontent" />
				<iframe id="layouttableiframecontent" name="layouttableiframecontent" SRC="index_new.php" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" style="overflow:visible; width:100%; display:none"></iframe>
				</td>
			</tr>
		</table>
	</div>

<div style="position:fixed;left:0px;top:175px;right:0;z-index:2;">	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td rowspan="2" class="table_bottom_sweep" onclick="loadintoIframe('layouttableiframecontent', '_suc_help.php')" style="cursor:hand;" onMouseover="ddrivetip('Open Help Screen');" onMouseout="hideddrivetip();"/>
				<img src="images/_interface/lcars_bottom_sweep.png" border="0" style="float:left;" />
				</td>
			<td class="table_bottom_sweep_tail" onclick="loadintoIframe('layouttableiframecontent', '_suc_help.php')" style="cursor:hand;" onMouseover="ddrivetip('Open Help Screen');" onMouseout="hideddrivetip();"/>
				<a class="hyperlink" href="http://www.openairport.org" target="SourceCode">OpenAirport.org &copy; <?php echo date('Y');?></a>
				</td>
			<td class="table_bottom_buttons_endcap" />
				&nbsp;
				</td>
			</tr>
		<tr>	
			<td colspan="2">
				</td>
			</tr>			
		<tr>
			<td class="table_button_bottom_sweep" onclick="loadintoIframe('layouttableiframecontent', '_suc_help.php')" style="cursor:hand;" onMouseover="ddrivetip('Open Help Screen');" onMouseout="hideddrivetip();"/>
				Help
				</td>
			</tr>
		<tr>
			<form>
				<input type="hidden" size="4" name="qa_start" id="qa_start" value='0' />
				<input type="hidden" name="qa_end" id="qa_end" value='5' />
				</form>
			<td id="button_up" class="table_button_side_function" onclick="javascript:call_server_load_quickaccess('<?php echo $whoareyou;?>','up');" onMouseover="ddrivetip('Load Additional Quick Access Items - Up');" onMouseout="hideddrivetip();"/>
				Up
				</td>
			</tr>
		<tr>
			<td id="layout_topheadercenter" name="layout_topheadercenter" />
				<?php 
				loadquickaccessmenu($whoareyou);
				?>
				</td>
			</tr>
		<tr>
			<td id="button_down" class="table_button_side_function" onclick="javascript:call_server_load_quickaccess('<?php echo $whoareyou;?>','down');" onMouseover="ddrivetip('Load Additional Quick Access Items - Down');" onMouseout="hideddrivetip();" />
				Down
				</td>
			</tr>			
		<tr>
			<td class="table_button_side_red_light2" onclick="window.location='index_newlogin.php'" style="cursor:hand;" onMouseover="ddrivetip('Logout of OpenAirport. Your information will be saved.');" onMouseout="hideddrivetip();" />
				LOGOUT
				</td>
			</tr>		
		<tr>
			<td class="table_bottom_shoulder" />
				&nbsp;
				</td>
			</tr>
		</table>
	</div>

<?php
include("includes/_userinterface/_ui_footer.inc.php");				// include file that gets information from form posts for navigational purposes
?>