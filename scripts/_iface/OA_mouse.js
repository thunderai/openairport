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
	document.Show.MouseX.value = getX(evt)
	document.Show.MouseY.value = getY(evt)
     	alert("X = "+ getX(evt) +"\nY = "+ getY(evt));
}