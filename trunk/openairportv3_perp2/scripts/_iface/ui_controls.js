function toggle_new(passeddiv) {

	//alert(passeddiv);
	
	var passeddiv_obj = document.getElementById(passeddiv);
	var passeddiv_obj_display = passeddiv_obj.style.display;
	
	if(passeddiv_obj_display == 'none') {
			// Not displayed, display it
			document.getElementById(passeddiv).style.display = 'block';
		} else {
			document.getElementById(passeddiv).style.display = 'none';
		}
	
	//alert(passeddiv_obj.style.display);

}

function modeselectionswitch(selected_mode,buildarray) {
	// Get mode from input field
	
		if (typeof selected_mode === 'undefined') {
				// variable is undefined
				var current_mode = document.getElementById("modeswtich").value;
			} else {
				var current_mode = selected_mode;
			}
		
		if (typeof buildarray === 'undefined') {
				// Not defined
			} else {
				// Split build array into parts
				var array_build = buildarray.split('|');
			}
		
		//alert(current_mode);
		
		if(current_mode == 'map') {
				
				// Hide Windows ONLY used by the Dash

				//alert(document.getElementById("layouttableiframecontent"));
				document.getElementById("layouttableiframecontent").style.display	='none';
				//document.getElementById("systemtext_div").style.display				='none';
				document.getElementById("qam_div").style.display					='none';
				
				//contentpanel_win.hide();
				
				// SHOW WINDOWS
				
				document.getElementById("div_maplayer1").style.display				='block';
				document.getElementById("div_mapscale").style.display				='block';
				
				// Rename Mode Switch
				
				document.getElementById("modeswitch_label").value 					= 'Dash Panel';
				document.getElementById("modeswtich").value 						= 'dash';
				
			}
		if(current_mode == 'dash') {
		
				//alert(document.getElementById("layouttableiframecontent"));
				
				document.getElementById("layouttableiframecontent").style.display='block';
				//document.getElementById("systemtext_div").style.display='block';
				document.getElementById("qam_div").style.display='block';
				
				// HIDE WINDOWS
			
				document.getElementById("div_maplayer1").style.display='none';
				document.getElementById("div_mapscale").style.display='none';
				
				// Rename Mode Switch
				
				document.getElementById("modeswitch_label").value = 'Map It!';
				document.getElementById("modeswtich").value = 'map';
		
			}

	}

function displaymode(mode) {
		// Take the variable mode and display or hide applicable divs
		if (mode == "Map") {
			
			// Hide Windows ONLY used by the Dash

			document.getElementById("layouttableiframecontent").style.display='none';
			document.getElementById("systemtext_div").style.display='none';
			document.getElementById("qam_div").style.display='none';
			
			// SHOW WINDOWS
			
			document.getElementById("div_maplayer1").style.display='block';
			document.getElementById("div_mapscale").style.display='block';
						
		
			}
		if (mode == "Dash") {
		
			// SHOW DASH WINDOWS
			
			document.getElementById("layouttableiframecontent").style.display='block';
			document.getElementById("systemtext_div").style.display='block';
			document.getElementById("qam_div").style.display='block';
			
			// HIDE WINDOWS
		
			document.getElementById("div_maplayer1").style.display='none';
			document.getElementById("div_mapscale").style.display='none';			
			}
	}

function updateactivepage(activepage) {
	// Take the input activepage and make the activepage input field equal to it
	document.getElementById("activepage").value = activepage;
	}

function showValue(newValue) {
	// We update both to send the scale value with the proper form cause Browsers suck
	
	document.getElementById("mapscale_disp").innerHTML=newValue;
	document.getElementById("map_scale_txt").value=newValue;
	
}

function togglecheckbox(inputname,fieldname) {
			
		var IconName 	= 'Icon_MM' + escape(fieldname);
		var NameName 	= 'Name_MM' + escape(fieldname);
		var FieldName	= 'Field_MM' + escape(fieldname);
		var FormatName	= 'Format_MM' + escape(fieldname);

		//alert(IconName);
		
	if (document.getElementById(inputname).checked == false) {
		document.getElementById(inputname).checked = true;
		
		document.getElementById(IconName).className = 'item_icon_active_form';
		document.getElementById(NameName).className = 'item_name_active_form';
		document.getElementById(FieldName).className = 'item_field_active_form';
		document.getElementById(FormatName).className = 'item_format_active_form';
		}
	else {
		document.getElementById(inputname).checked = false;
			
		document.getElementById(IconName).className = 'item_icon_inactive_form';
		document.getElementById(NameName).className = 'item_name_inactive_form';
		document.getElementById(FieldName).className = 'item_field_inactive_form';
		document.getElementById(FormatName).className = 'item_format_inactive_form';		
		
		}
}

function setMainMenuItem(MainControl)
	{
	document.getElementById("MainMenuID").value = MainControl;
	}
	
function setSubMenuItem(SubControl)
	{
	document.getElementById("SubMenuID").value = SubControl;
	
	var MainID_tmp = document.getElementById("MainMenuID").value;
	var SubID_tmp = document.getElementById("SubMenuID").value;
	
	call_server_getmaplayercontrols(MainID_tmp,SubID_tmp);
	}	

<!--
var state = 'none';

function showhide(layer_ref) {

if (state == 'block') { 
state = 'none'; 
} 
else { 
state = 'block'; 
} 
if (document.all) { //IS IE 4 or 5 (or 6 beta) 
eval( "document.all." + layer_ref + ".style.display = state"); 
} 
if (document.layers) { //IS NETSCAPE 4 or below 
document.layers[layer_ref].display = state; 
} 
if (document.getElementById &&!document.all) { 
hza = document.getElementById(layer_ref); 
hza.style.display = state; 
} 
} 
//--> 

function updatemap(IslandID) {
//loadintoIframe('layouttableiframecontent', '_suc_usersettings.php')
// _iframe_getisland

// The idea here is to collect information from the form and display the proper layers

	if(document.MapControlForm2.ISLANDLAYORS_BaseMap.checked == true) {
			var $display_base_map = 1;
		}
		else {
			var $display_base_map = 0;
		}
		
	if(document.MapControlForm2.ISLANDLAYORS_Buildings.checked == true) {
			var $display_buildings = 1;
		}
		else {
			var $display_buildings = 0;
		}
	if(document.MapControlForm2.ISLANDLAYORS_GridOverlay.checked == true) {
			var $display_GridOverlay = 1;
		}
		else {
			var $display_GridOverlay = 0;
		}		
	if(document.MapControlForm2.ISLANDLAYORS_PassableLightBot.checked == true) {
			var $display_plb = 1;
		}
		else {
			var $display_plb = 0;
		}

var url = "_iframe_getisland.php?islandid=" + escape(IslandID) + "&ISLANDLAYORS_BaseMap=" + escape($display_base_map) + "&ISLANDLAYORS_Buildings=" + escape($display_buildings) + "&ISLANDLAYORS_GridOverlay=" + escape($display_GridOverlay) + "&ISLANDLAYORS_PassableLightBot=" + escape($display_plb);
alert(url);

loadintoIframe('layouttableiframecontent', url);
}

function updatemap2(IslandID) {

document.getElementById("islandid_js").value = document.getElementById("islandid").value;

alert(document.getElementById("islandid").value);
document.MapControlForm2.submit();

}

var unflood = function() {

	document.getElementById("flood_lm").style.display='none';
	document.getElementById("flood_sn").style.display='none';
	document.getElementById("flood_wp").style.display='none';
	document.getElementById("flood_gs").style.display='none';
	document.getElementById("flood_gs_show").style.display='none';	
	document.getElementById("flood_sh").style.display='none';	
	document.getElementById("flood_sh_show").style.display='none';	
}

function togglebutton_M(ButtonName,ButtonStatus) {
	// Takes the given variables and colors a button accordingly
	// Each button has four parts:
	//		Outer SPace
	//		Icon
	//		Inner Space
	//		Name
	
	// ButtonName will be a portion of the name of the button, the applicable four used names are:
	
	var OSpaceName = 'OSpace_MM' + escape(ButtonName);
	var ISpaceName = 'ISpace_MM' + escape(ButtonName);
	var IconName = 'Icon_MM' + escape(ButtonName);
	var NameName = 'Name_MM' + escape(ButtonName);

	if(ButtonStatus == 'off') {
			// Turn the button off
			document.getElementById(OSpaceName).className = 'item_space_inactive';
			document.getElementById(ISpaceName).className = 'item_space_inactive';
			document.getElementById(IconName).className = 'item_icon_inactive';
			document.getElementById(NameName).className = 'item_name_inactive';
		} else {
			// If Not OFF Turn the button ON
			document.getElementById(OSpaceName).className = 'item_space_active';
			document.getElementById(ISpaceName).className = 'item_space_active';
			document.getElementById(IconName).className = 'item_icon_active';
			document.getElementById(NameName).className = 'item_name_active';
		}

}

function togglebutton_M_F(ButtonName,ButtonStatus) {
	// Takes the given variables and colors a button accordingly
	// Each button has four parts:
	//		Outer SPace
	//		Icon
	//		Inner Space
	//		Name
	
	// ButtonName will be a portion of the name of the button, the applicable four used names are:
	
	var OSpaceName = 'OSpace_MM' + escape(ButtonName);
	var ISpaceName = 'ISpace_MM' + escape(ButtonName);
	var IconName = 'Icon_MM' + escape(ButtonName);
	var NameName = 'Name_MM' + escape(ButtonName);
	var FieldName = 'Field_MM' + escape(ButtonName);
	var FormatName = 'Format_MM' + escape(ButtonName);

	if(ButtonStatus == 'off') {
			// Turn the button off
			document.getElementById(OSpaceName).className = 'item_space_inactive_form';
			document.getElementById(ISpaceName).className = 'item_space_inactive_form';
			document.getElementById(IconName).className = 'item_icon_inactive_form';
			document.getElementById(NameName).className = 'item_name_inactive_form';
			document.getElementById(FieldName).className = 'item_field_inactive_form';
			document.getElementById(FormatName).className = 'item_format_inactive_form';			
		} else {
			// If Not OFF Turn the button ON
			document.getElementById(OSpaceName).className = 'item_space_active_form';
			document.getElementById(ISpaceName).className = 'item_space_active_form';
			document.getElementById(IconName).className = 'item_icon_active_form';
			document.getElementById(NameName).className = 'item_name_active_form';
			document.getElementById(FieldName).className = 'item_field_active_form';
			document.getElementById(FormatName).className = 'item_format_active_form';			
		}

}

function togglebutton_M_Q(ButtonName,ButtonStatus) {
	// Takes the given variables and colors a button accordingly
	// Each button has four parts:
	//		Outer SPace
	//		Icon
	//		Inner Space
	//		Name
	
	// ButtonName will be a portion of the name of the button, the applicable four used names are:
	
	var OSpaceName = 'OSpace_MMQ' + escape(ButtonName);
	var ISpaceName = 'ISpace_MMQ' + escape(ButtonName);
	var IconName = 'Icon_MMQ' + escape(ButtonName);
	var NameName = 'Name_MMQ' + escape(ButtonName);

	if(ButtonStatus == 'off') {
			// Turn the button off
			document.getElementById(OSpaceName).className = 'item_space_inactive';
			document.getElementById(ISpaceName).className = 'item_space_inactive';
			document.getElementById(IconName).className = 'item_icon_inactive';
			document.getElementById(NameName).className = 'item_name_inactive';		
		} else {
			// If Not OFF Turn the button ON
			document.getElementById(OSpaceName).className = 'item_space_active';
			document.getElementById(ISpaceName).className = 'item_space_active';
			document.getElementById(IconName).className = 'item_icon_active';
			document.getElementById(NameName).className = 'item_name_active';		
		}

}

function togglebutton_M_D(ButtonName,ButtonStatus) {
	// Takes the given variables and colors a button accordingly
	// Each button has four parts:
	//		Outer SPace
	//		Icon
	//		Inner Space
	//		Name
	
	// ButtonName will be a portion of the name of the button, the applicable four used names are:
	
	var OSpaceName = 'dashname' + escape(ButtonName);
	var ISpaceName = 'dashmname' + escape(ButtonName);
	var IconName = 'dashcheckbox' + escape(ButtonName);
	var NameName = 'dashorder' + escape(ButtonName);

	if(ButtonStatus == 'off') {
			// Turn the button off
			document.getElementById(OSpaceName).className = 'item_name_inactive';
			document.getElementById(ISpaceName).className = 'item_name_inactive';
			document.getElementById(IconName).className = 'item_space_inactive';
			document.getElementById(NameName).className = 'item_space_inactive';		
		} else {
			// If Not OFF Turn the button ON
			document.getElementById(OSpaceName).className = 'item_name_active';
			document.getElementById(ISpaceName).className = 'item_name_active';
			document.getElementById(IconName).className = 'item_space_active';
			document.getElementById(NameName).className = 'item_space_active';		
		}

}

function togglebutton_M_C(ButtonName,ButtonStatus,maxcol) {
	// ButtonName is the dynamic part of the column to change
	// ButtonStatus is the direction to change in
	// maxcol is the maximum number of columns in the row

	for (var i=1;i<=maxcol;i++) { 
		// Loop through the columns and change them as needed
		var td_name = "col_" + i + '_r' + ButtonName;
		//alert(td_name);
		
		if(ButtonStatus == 'off') {
				// Turn the button off
				document.getElementById(td_name).className = 'item_name_small_inactive';	
			} else {
				// If Not OFF Turn the button ON
				document.getElementById(td_name).className = 'item_name_small_active';	
			}
			
		}

}

function togglebutton_M_F_color(ButtonName,ButtonStatus,on,off) {
	// Takes the given variables and colors a button accordingly
	// Each button has four parts:
	//		Outer SPace
	//		Icon
	//		Inner Space
	//		Name
	
	// ButtonName will be a portion of the name of the button, the applicable four used names are:
	
	var OSpaceName = 'OSpace_MMC' + escape(ButtonName);
	var ISpaceName = 'ISpace_MMC' + escape(ButtonName);
	var IconName = 'Icon_MMC' + escape(ButtonName);
	var NameName = 'Name_MMC' + escape(ButtonName);
	var FieldName = 'Field_MMC' + escape(ButtonName);
	var FormatName = 'Format_MMC' + escape(ButtonName);

	if(ButtonStatus == 'off') {
			// Turn the button off
			document.getElementById(OSpaceName).className = off;
			document.getElementById(ISpaceName).className = off;
			document.getElementById(IconName).className = off;
			document.getElementById(NameName).className = off;
			document.getElementById(FieldName).className = off;
			document.getElementById(FormatName).className = off;			
		} else {
			// If Not OFF Turn the button ON
			document.getElementById(OSpaceName).className = on;
			document.getElementById(ISpaceName).className = on;
			document.getElementById(IconName).className = on;
			document.getElementById(NameName).className = on;
			document.getElementById(FieldName).className = on;
			document.getElementById(FormatName).className = on;			
		}

}

// Establish Global Mouse Script Variables

		var gettotalvalue	= "";
		var gettotalvaluex 	= "";
		var gettotalvaluey 	= "";