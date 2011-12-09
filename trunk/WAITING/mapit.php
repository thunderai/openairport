<HEAD>
<script type="text/javascript">
<!--
var getX = function(evt){
     if(evt.x){ return evt.x; }
     if(evt.pageX){ return evt.pageX;
}
}
var getY = function(evt){
     if(evt.y + document.body.scrollTop){ return evt.y + document.body.scrollTop; }
     if(evt.pageY + document.body.scrollTop ){ return evt.pageY + document.body.scrollTop; 
}
}
var alertCoords = function(evt){
	opener.edittable.MouseX.value = getX(evt)
	opener.edittable.MouseY.value = getY(evt)
	alert("Surface Condition is located at" +"\n" +"\n X = "+ getX(evt) +"\n Y = "+ getY(evt) +"\n" +"\n You may now close this window");
}
// -->
</script>

</HEAD>

<BODY>
	<div style="position:absolute; z-index:1; left: 0; top: 0; align="left">
		<img border="0" onclick="alertCoords(event)" src="images/part_139_327/alp_discrepancy_location_current.gif" style="cursor: crosshair;">
		</div>
	<div style="position:absolute; z-index:2; left: 10; top: 0; align="left">
		<b>Please click the location of the Discovered Discrepancy. <br>Grid Units: 1 square = 100 pixels</b>
		</div>
	</BODY>