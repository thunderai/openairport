<?
$tmpxpointsfieldname = "";
$tmpypointsfieldname = "";

if (!isset($_GET['xpoints'])) {
		// There is no value provided for the name of the xfield
		$tmpxpointsfieldname = "xpoints";
	}
	else {
		$tmpxpointsfieldname = $_GET['xpoints'];
	}
if (!isset($_GET['ypoints'])) {
		// There is no value provided for the name of the xfield
		$tmpypointsfieldname = "ypoints";
	}
	else {
		$tmpypointsfieldname = $_GET['ypoints'];
	}
?>

<HEAD>
<script type="text/javascript">
var gettotalvalue;

gettotalvaluex = "";
gettotalvaluey = "";

<!--
var getX = function(evt){
     if(evt.x){ return evt.x + document.body.scrollLeft;; }
     if(evt.pageX){ return evt.pageX + document.body.scrollLeft;
}
}
var getY = function(evt){
     if(evt.y + document.body.scrollTop){ return evt.y + document.body.scrollTop; }
     if(evt.pageY + document.body.scrollTop ){ return evt.pageY + document.body.scrollTop; 
}
}
var alertCoords = function(evt){

	var tmpvaluex = getX(evt)
	var tmpvaluey = getY(evt)
	
	if (gettotalvaluex=="") {
			//Value is at its default setting so this is the first time this has been used
			opener.edittable.<?=$tmpxpointsfieldname;?>.value = "" + getX(evt)
			gettotalvaluex = "" + getX(evt)
		}
		else {
			gettotalvaluex = gettotalvaluex + "," + tmpvaluex
			opener.edittable.<?=$tmpxpointsfieldname;?>.value = gettotalvaluex
		}
		
	if (gettotalvaluey=="") {
			//Value is at its default setting so this is the first time this has been used
			opener.edittable.<?=$tmpypointsfieldname;?>.value = "" + getY(evt)
			gettotalvaluey = "" + getY(evt)
		}
		else {
			gettotalvaluey = gettotalvaluey + "," + tmpvaluey
			opener.edittable.<?=$tmpypointsfieldname;?>.value = gettotalvaluey
		}

	//opener.edittable.MouseY.value = getY(evt)
	//alert("Surface Condition is located at" +"\n" +"\n X = "+ getX(evt) +"\n Y = "+ getY(evt) +"\n" +"\n You may now close this window");
}
// -->
</script>
<script type="text/javascript" src="scripts/wz_jsgraphics.js"></script>
</HEAD>

<BODY>
	<div style="position:absolute; z-index:1; left: 0; top: 0; align="left">
		<img border="5" onclick="alertCoords(event)" src="images/Part_139_327/alp_pavement_location.gif" style="cursor: crosshair;">
		</div>
	<div style="position:absolute; z-index:2; left: 10; top: 0; align="left">
		<b>Please click the location of the Discovered Discrepancy. <br>Grid Units: 1 square = 100 pixels</b>
		</div>
	<div id="myCanvas" style="position:absolute;z-index:3;"></div>
		<script type="text/javascript">
		<!--
		function myDrawFunction() {
			// Get The current Numbers from the Edit Table, and set them to the variable.
			var xpoints = opener.edittable.<?=$tmpxpointsfieldname;?>.value;
			var ypoints = opener.edittable.<?=$tmpypointsfieldname;?>.value;

			// Take apart the string values of the text fiel and put the strings into an array
			var xpoints=xpoints.split(",");
			var ypoints=ypoints.split(",");

			// In each array take the string and convert it into a number adjusting for mouse pointer error
			for (i=0; i<xpoints.length; ++i) {
			  xpoints[i] = xpoints[i] * 1 - 12;  
			  } // for
			for (i=0; i<ypoints.length; ++i) {
			  ypoints[i] = ypoints[i] * 1 - 17;  
			  } // for

			// Draw the Pavement section
			jg.setColor("#ff000f"); // red
			jg.drawPolyline(xpoints, ypoints);
			jg.paint();
		}

		var jg = new jsGraphics("myCanvas");

		myDrawFunction();

		//-->
		</script> 
 

	</BODY>