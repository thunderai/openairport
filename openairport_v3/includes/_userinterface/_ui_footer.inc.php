<div style="z-index:99" id="dhtmltooltip"></div>
<script type="text/javascript">
/***********************************************
* Cool DHTML tooltip script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var offsetxpoint=-60 //Customize x offset of tooltip
var offsetypoint=20 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function ddrivetip(thetext, thecolor, thewidth){
if (ns6||ie){
if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
tipobj.innerHTML=thetext
enabletip=true
return false
}
}

function positiontip(e){
if (enabletip){
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth)
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<tipobj.offsetHeight)
tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
else
tipobj.style.top=curY+offsetypoint+"px"
tipobj.style.visibility="visible"
}
}

function hideddrivetip(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip

</script>
<script language="JavaScript1.2">
/*
Moving light on image script
© Dynamic Drive (www.dynamicdrive.com)
For full source code, installation instructions,
100's more DHTML scripts, and Terms Of
Use, visit dynamicdrive.com
*/


if (document.all&&window.spotlight){
var x=new Array()
var direction=new Array()
var y=new Array()
if (spotlight.length==null){
spotlight[0]=document.all.spotlight
x[0]=0
direction[0]="right"
y[0]=spotlight[0].height
spotlight[0].filters.light.addPoint(100,50,100,255,255,255,90)
}
else
for (i=0;i<spotlight.length;i++){
x[i]=0
direction[i]="right"
y[i]=spotlight[i].height
spotlight[i].filters.light.addPoint(100,50,100,255,255,255,90)
}
}

function slidelight(cur){
spotlight[cur].filters.light.MoveLight(0,x[cur],y[cur],200,-1)

if (x[cur]<spotlight[cur].width+200&&direction[cur]=="right")
x[cur]+=10
else if (x[cur]>spotlight[cur].width+200){
direction[cur]="left"
x[cur]-=10
}
else if (x[cur]>-200&&x[cur]<-185){
direction[cur]="right"
x[cur]+=10
}
else{
x[cur]-=10
direction[cur]="left"
}
}

if (document.all&&window.spotlight){
if (spotlight.length==null)
setInterval("slidelight(0)",spotlight[0].speed)
else
for (t=0;t<spotlight.length;t++){
var temp='setInterval("slidelight('+t+')",'+spotlight[t].speed+')'
eval(temp)
}
}
</script>
<?php
$time_init 				= $_SESSION['page_time'];
$_SESSION['page_time'] 	= microtime(true);
$time_completed 		= $_SESSION['page_time'];

//echo "Page Ended at time index [".$time_completed."] <br>";
$time_taken	= ($time_completed - $time_init);
//$time_taken	= ($time_taken * 1000);
$time_taken	= round($time_taken,6);
//echo "This page took ".$time_taken." micro seconds to load";

$message = "This page has taken ".$time_taken." microseconds to load";
?>
	<script>
		parent.document.getElementById("timetaken").innerHTML = "<?php echo $message;?>";
		</script>
		</body>
	</html>