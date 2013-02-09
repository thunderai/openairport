// Establish Global Mouse Script Variables

		var gettotalvalue	= "";
		var gettotalvaluex 	= "";
		var gettotalvaluey 	= "";

function showValue(newValue) {
	// We update both to send the scale value with the proper form cause Browsers suck
	
	document.getElementById("mapscale_disp").innerHTML=newValue;
	document.getElementById("map_scale_txt").value=newValue;
	
}

function toggle(DivName) {
	var ele = document.getElementById(DivName);
	//var text = document.getElementById(DivName);
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "show";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "hide";
	}
} 
		
var whereaminow = function whereami() {
		// Function to display where your currently located on the map
		
		//get variable information
		//alert('hi');
		
		var px 					= document.getElementById("MouseX").value;
		var py 					= document.getElementById("MouseY").value;
		
		//alert(px);
		
		px = px * 1;
		py = py * 1;
		
		var icon 				= 'images/_interface/icons_whereami.png';
		var label				= ' You Are Here! ';
		var label_background 	= '#7d388e'; 	// Dark Purple
		var label_color			= '#FFFFFF';	// White
		var icon_width 			= 50;	// Manual adjustment to override image size, and/or for programming purposes
		var icon_height			= 50;	// Manual adjustment to override image size, and/or for programming purposes	
		var mainiconx			= ( px - parseInt( icon_width / 2 ) );
		var mainicony			= ( py - parseInt( icon_height / 2 ) );
		var label_off_x			= ( px + icon_width );
		var label_off_y			= ( py - icon_height );

		var jg = new jsGraphics("myCanvas_airportmap");
		
		jg.clear();
		
		jg.setColor(label_color);
		jg.drawLine(px, py, label_off_x, (label_off_y+10) ); 
		
		jg.setColor(label_background);
		jg.fillRect(label_off_x, label_off_y, 100, 20); 
	
		jg.setColor(label_color);
		jg.drawString(label, label_off_x, label_off_y);
	
		jg.drawImage(icon,mainiconx,mainicony,icon_width,icon_height); 
	
		jg.paint();	
		
		window.scroll( (px-300),(py-300)); 	// horizontal and vertical scroll targets
		
	}

function updatemousexy(div) {

	var elementnamex = "mappoint_x_" + escape(div);
	var elementnamey = "mappoint_y_" + escape(div);
	
	document.getElementById(elementnamex).value = document.getElementById("MouseX").value;
	document.getElementById(elementnamey).value = document.getElementById("MouseY").value;

	// Call rendering engine....
		
	if(div == 'sn') {
			// Draw Spawn Point
			alertCoords_sn_v2();
		}
		
	if(div == 'lm') {
			// Draw Spawn Point
			alertCoords_lm_v2();
		}
		
	if(div == 'wp') {
			// Draw Spawn Point
			alertCoords_wp_v2();
		}
		
	if(div == 'sh') {
			// Draw Spawn Point
			alertCoords_sh_v2();
		}		
		
}

		
var getX = function(evt){

		var IE = document.all?true:false;


		if (IE) { // grab the x-y pos.s if browser is IE
				return evt.x + document.documentElement.scrollLeft; 
			}
			else {  // grab the x-y pos.s if browser is NS
				return evt.pageX + document.getElementById("IslandMap").scrollLeft;
			}  		
		
		
		
		 //if(evt.x){ 
		//		return evt.x + document.documentElement.scrollLeft; 
		//	}
			
		// if(evt.pageX){ 
		//		return evt.pageX + document.body.scrollLeft;
		//	}
		
	}
	
var getY = function(evt){

		var IE = document.all?true:false;


		if (IE) { // grab the x-y pos.s if browser is IE
		
				if(evt.y + document.documentElement.scrollTop){ 
				
						return evt.y + document.documentElement.scrollTop;
						}
						//return evt.y + document.documentElement.scrollTop;
			}
			else {  // grab the x-y pos.s if browser is NS
			
				if(evt.pageY + document.getElementById("IslandMap").scrollTop ){ 
				
						return evt.pageY + document.getElementById("IslandMap").scrollTop; 

						//return evt.pageX + document.getElementById("IslandMap").scrollTop;
					}
			}

	//	 if(evt.y + document.documentElement.scrollTop){ 
	//			return evt.y + document.documentElement.scrollTop;
	//			}
	//			
	//	 if(evt.pageY + document.body.scrollTop ){ 
	//			return evt.pageY + document.body.scrollTop; 
	//		}
			
	}
	
var alertCoords = function(evt){

		document.getElementById("MouseX").value = getX(evt)
		document.getElementById("MouseY").value = getY(evt)
		
		//document.getElementById("mappoint_x").value = getX(evt)
		//document.getElementById("mappoint_y").value = getY(evt)

		//alert("Mouse was click on map at" +"\n" +"\n X = "+ getX(evt) +"\n Y = "+ getY(evt) +"\n" +"\n You may close this window. \n\n Nothing was added to the Database");
	
	}	
	
function update_element_info(stringtxt) {

	// Seperate String
	var n=stringtxt.split(';');
	
	var recordid 		= n[0];
	var recordname 		= n[1];
	var display_x 		= n[2];		// Probably overwritten below
	var display_y 		= n[3];		// Probably overwritten below
	var cordtype 		= n[4];
	var mapscale 		= n[5];
	var recordsource 	= n[6];
	var recordidfield	= n[7];
	
	// If Not already displayed, display the Map Element 'window'
	
	document.getElementById("div_mapinfo").style.display = "block";
	
	// Move 'window' near the selected element, but offset it some
	var offset_x = 45;
	var offset_y = -45;
	
	if(cordtype == 'point') {
	
			var window_loc_x = (n[2] * 1) + offset_x;
			var window_loc_y = (n[3] * 1) + offset_y;
			
			var display_x = n[2];
			var display_y = n[3];
			
		} else {
		
			var xtotal				= 0;
			var ytotal				= 0;
			var xaverage			= 0;
			var yaverage			= 0;
			
			var xpoints=n[2].split(",");
			var ypoints=n[3].split(",");
			
			for (i=0; i<xpoints.length; ++i) {
			  xpoints[i] = xpoints[i] * 1 * n[5];
			  xtotal = xtotal + xpoints[i];
			  } // for
			  xaverage = (xtotal/xpoints.length);
			  xaverage = Math.round(xaverage);
			  //alert(xaverage);
			  
			for (i=0; i<ypoints.length; ++i) {
			  ypoints[i] = ypoints[i] * 1 * n[5];  
			  ytotal = ytotal + ypoints[i];
			  } // for
			  yaverage = (ytotal/ypoints.length);
			  yaverage = Math.round(yaverage);			  
		
			var window_loc_x = xaverage + offset_x;
			var window_loc_y = yaverage + offset_y;	

			var display_x = Math.round(xaverage/mapscale);
			var display_y = Math.round(yaverage/mapscale);
		}
	
	//alert(window_loc_y);
	document.getElementById("ElementInfo_Id").innerHTML = n[0];
	document.getElementById("elementrecordid").value = n[0];
	document.getElementById("elementrecordidfield").value = recordidfield;
	document.getElementById("ElementInfo_Name").innerHTML = n[1];
	document.getElementById("ElementInfo_LocX").innerHTML = 'X:' + display_x + ',';
	document.getElementById("ElementInfo_LocY").innerHTML = 'Y:' + display_y;
	document.getElementById("elementrecordsource").value = n[6];
	
	document.getElementById("div_mapinfo").style.position = "absolute";
	document.getElementById("div_mapinfo").style.top = window_loc_y;
	document.getElementById("div_mapinfo").style.left = window_loc_x;
	
}
