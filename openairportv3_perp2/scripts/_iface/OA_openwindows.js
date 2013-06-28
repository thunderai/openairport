function openchildall(file,window) {
    childwindow=open(file,window,'status=1,toolbar=1,location=1,menubar=1,directories=1,resizable=1,scrollbars=1,height=800,width=800');
    if (childwindow.opener == null) childwindow.opener = self;
    }

function opensmallchild(file,window) {
    childWindow=open(file,window,'status=1,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollbars=0,height=450,width=450');
    if (childWindow.opener == null) childWindow.opener = self;
    }
	
function openchild600(file,window) {
    childWindow=open(file,window,'status=1,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollbars=0,height=600,width=750');
    if (childWindow.opener == null) childWindow.opener = self;
    }
	
function openmapchild(file,window) {
    childWindow=open(file,window,'status=1,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollbars=1,height=700,width=800');
    if (childWindow.opener == null) childWindow.opener = self;
    }
	
function openchild_600_formonclick(file,window_location,form_id) {
	
	window.open("",window_location,"status=1,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollbars=0,height=600,width=600'"); 
   var a = window.setTimeout("document." + form_id + ".submit();",500); 
	
    }	
	
function openchild_map_formonclick(file,window_location,form_id) {
	
	window.open("",window_location,"status=1,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollbars=1,height=700,width=800'"); 
    var a = window.setTimeout("document." + form_id + ".submit();",500); 
	
    }
	
function open_new_report_window(file,location) {
	window.open('', location, 'status=1,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollbars=0,height=600,width=750');
	}
	
function open_new_littleform_window(file,location) {
	window.open('', location, 'status=1,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollbars=0,height=400,width=500');
	}	