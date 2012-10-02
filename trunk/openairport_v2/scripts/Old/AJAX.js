function openchildfixed(file,window) {
    childwindow=open(file,window,'resizable=no,scrollbars=yes,width=500,height=700');
    if (childwindow.opener == null) childwindow.opener = self;
    }

function openChild2(file,window) {
    childWindow=open(file,window,'resizable=yes,scrollbars=yes,width=700,height=711,statusbar=yes');
    if (childWindow.opener == null) childWindow.opener = self;
    }
	
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//var bfrequest = creat_object_browseformresult();
var nmrequest = creat_object_menuitem_feeder();
var mirequest = creat_object_menuitem();
var csrequest = creat_object_contentsection();
var ncrequest = creat_object_navigationalcontrol();
var lbrequest = creat_object_loginbox();
var wbrequest = creat_object_welcomebox();
var bxrequest = creat_object_boxrequest();

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function creat_object_boxrequest()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}

function sever_interaction_boxrequest()
	{
	if(bxrequest.readyState == 4)
		{
		var answer = bxrequest.responseText.split("|");
		document.getElementById("leases_type_idajax").innerHTML = answer;
		}
	}
function call_server_boxrequest(display)
		{
			var leasetype = document.getElementById("leases_lease_type_cb_int").value;			
			var url = "ajax_leaseparts_data_entry_request.php?leasetype=" + escape(leasetype);
			bxrequest.open("GET", url); 
			bxrequest.onreadystatechange = sever_interaction_boxrequest;
			bxrequest.send('');
		
		}


function creat_object_welcomebox()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}

function sever_interaction_welcomebox()
	{
	if(wbrequest.readyState == 4)
		{
		var answer = wbrequest.responseText.split("|");
		document.getElementById("welcomebox").innerHTML = answer;
		}
	}
function call_server_welcomebox(display)
		{
			var display = escape(display);
			var url = display;
			wbrequest.open("GET", url); 
			wbrequest.onreadystatechange = sever_interaction_welcomebox;
			wbrequest.send('');
		
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function creat_object_loginbox()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}

function sever_interaction_loginbox()
	{
	if(lbrequest.readyState == 4)
		{
		var answer = lbrequest.responseText.split("|");
		document.getElementById("loginbox").innerHTML = answer;
		}
	}
function call_server_loginbox(display)
		{
			var display = escape(display);
			var url = display;
			lbrequest.open("GET", url); 
			lbrequest.onreadystatechange = sever_interaction_loginbox;
			lbrequest.send('');
		
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function creat_object_navigationalcontrol()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}

function sever_interaction_navigationalcontrol()
	{
	if(ncrequest.readyState == 4)
		{
		var answer = ncrequest.responseText.split("|");
		document.getElementById("navigational_control").innerHTML = answer;
		}
	}
function call_server_navigationalcontrol(display)
		{
			var display = escape(display);
			var url = display;
			ncrequest.open("GET", url); 
			ncrequest.onreadystatechange = sever_interaction_navigationalcontrol;
			ncrequest.send('');
		
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function creat_object_contentsection()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}

function sever_interaction_contentsection()
	{
	if(csrequest.readyState == 4)
		{
		var answer = csrequest.responseText.split("|");
		document.getElementById("contentsection").innerHTML = answer;
		}
	}
function call_server_contentsection(display)
		{
			var display = escape(display);
			var url = display;
			csrequest.open("GET", url); 
			csrequest.onreadystatechange = sever_interaction_contentsection;
			csrequest.send('');
		
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function creat_object_menuitem()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}

function loadintoIframe(iframeid, url){
if (document.getElementById)
document.getElementById(iframeid).src=url
}
function sever_interaction_menuitem()
	{
	if(mirequest.readyState == 4)
		{
		var answer = mirequest.responseText.split("|");
		loadintoIframe('layouttableiframecontent', answer)
		if (window.addEventListener)
window.addEventListener("load", resizeCaller, false)
else if (window.attachEvent)
window.attachEvent("onload", resizeCaller)
else
window.onload=resizeCaller
		document.getElementById("layouttableiframecontent").innerHTML = answer;
		}
	}
function call_server_menuitem(menuitemid,menuitemurl)
		{
			var menuitemid = escape(menuitemid);
			var url = escape(menuitemurl) + "?menuitemid=" + escape(menuitemid);
			//alert(url);
			mirequest.open("GET", url); 
			mirequest.onreadystatechange = sever_interaction_menuitem;
			mirequest.send('');
		
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function creat_object_menuitem_feeder()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}

function loadintoIframe(iframeid, url){
if (document.getElementById)
document.getElementById(iframeid).src=url
}
function sever_interaction_menuitem_feeder()
	{
	if(mirequest.readyState == 4)
		{
		var answer = mirequest.responseText.split("|");
		loadintoIframe('layouttableiframecontent', answer)
		if (window.addEventListener)
window.addEventListener("load", resizeCaller, false)
else if (window.attachEvent)
window.attachEvent("onload", resizeCaller)
else
window.onload=resizeCaller
		document.getElementById("layouttableiframecontent").innerHTML = answer;
		}
	}
function call_server_menuitem_feeder(menuitemid,menuitemurl)
		{
			var menuitemid = escape(menuitemid);
			var url = "ajax_navigationmenu_request.php?menuitemid=" + escape(menuitemid) + "&menuitemurl=" + escape(menuitemurl);
			//alert(url);
			nmrequest.open("GET", url); 
			nmrequest.onreadystatechange = sever_interaction_menuitem_feeder;
			nmrequest.send('');
		
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// THIS FUNCTION IS USED TO RETURN THE RESULTS OF A BROWSE FORM INLINE WITH AJAX
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 var http_request = false;
   function makeRequest(url, parameters) {
      http_request = false;
	  if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) {
         	// set type accordingly to anticipated content type
            //http_request.overrideMimeType('text/xml');
            http_request.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      http_request.onreadystatechange = alertContents;
      http_request.open('GET', url + parameters, true);
      http_request.send(null);
   }

   function alertContents() {
      if (http_request.readyState == 4) {
         if (http_request.status == 200) {
            //alert(http_request.responseText);
            result = http_request.responseText;
            document.getElementById('frmajaxresult').innerHTML = result;            
         } else {
            alert('There was a problem with the request.');
         }
      }
   }
   
   function get_childnodes(obj,url) {
	var getstr = "?";
	//alert(url);
      for (i=0; i<obj.childNodes.length; i++) {
         if (obj.childNodes[i].tagName == "INPUT") {
            if (obj.childNodes[i].type == "text") {
               getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
            }
			if (obj.childNodes[i].type == "hidden") {
               getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
            }
            if (obj.childNodes[i].type == "checkbox") {
               if (obj.childNodes[i].checked) {
                  getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
               } else {
                  getstr += obj.childNodes[i].name + "=&";
               }
            }
            if (obj.childNodes[i].type == "radio") {
               if (obj.childNodes[i].checked) {
                  getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
               }
            }
         }   
         if (obj.childNodes[i].tagName == "SELECT") {
            var sel = obj.childNodes[i];
            getstr += sel.name + "=" + sel.options[sel.selectedIndex].value + "&";
         }
         
      }
	  //alert(getstr);
      makeRequest(url, getstr);
   }
 
function creat_Object()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}
	
var request = creat_Object();
function sever_interaction()
	{
	if(request.readyState == 4)
		{
		var answer = request.responseText.split("|");
		document.getElementById("CheckListData").innerHTML = answer;
		
		var iframeids=["layouttableiframecontent"]		
		if (window.addEventListener)
			window.addEventListener("load", resizeCaller, false)
		else if (window.attachEvent)
			window.attachEvent("onload", resizeCaller)
		else
			window.onload=resizeCaller

		}
	}
function call_server(id)
		{
			var InspCheckList = document.getElementById("InspCheckList").value;
			var url = "ajax_inspection_data_entry_request.php?InspCheckList=" + escape(InspCheckList) + "&Employee=" + escape(id);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction;
			request.send('');
		}
		
function creat_Object_ficon()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}
	
var request = creat_Object_ficon();
function sever_interaction_ficon()
	{
	if(request.readyState == 4)
		{
		var answer = request.responseText.split("|");
		document.getElementById("CheckListData").innerHTML = answer;
		
		var iframeids=["layouttableiframecontent"]		
		if (window.addEventListener)
			window.addEventListener("load", resizeCaller, false)
		else if (window.attachEvent)
			window.attachEvent("onload", resizeCaller)
		else
			window.onload=resizeCaller
		}
	}
function call_server_ficon(id,fullorshort)
		{
			var InspCheckList = document.getElementById("InspCheckList").value;
			var url = "ajax_part139339_data_entry_request.php?InspCheckList=" + escape(InspCheckList) + "&Employee=" + escape(id) + "&fullorshort=" + escape(fullorshort);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction_ficon;
			request.send('');
		}
		
function creat_Object_ficon_template()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}
	
var request = creat_Object_ficon_template();
function sever_interaction_ficon_template()
	{
	if(request.readyState == 4)
		{
		var answer = request.responseText.split("|");
		document.getElementById("TemplateSaveData").innerHTML = answer;
		
		var iframeids=["layouttableiframecontent"]		
		if (window.addEventListener)
			window.addEventListener("load", resizeCaller, false)
		else if (window.attachEvent)
			window.attachEvent("onload", resizeCaller)
		else
			window.onload=resizeCaller
		}
	}
function call_server_ficon_template(id)
		{
			var InspCheckList = document.getElementById("frmtemplatesave").value;
			var url = "ajax_part139339_template_data_entry_request.php?InspCheckList=" + escape(InspCheckList) + "&Employee=" + escape(id);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction_ficon_template;
			request.send('');
		}

function creat_Object_ficon_loadtemplate()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}
	
var request = creat_Object_ficon_loadtemplate();
function sever_interaction_ficon_loadtemplate()
	{
	if(request.readyState == 4)
		{
		var answer = request.responseText.split("|");
		//var maxtext = answer[0];
		//0 number of records
		//1 type of connection
		//2 name of field
		//3 value of field
		//alert(answer[5]);
		
		for (i=1; i<answer.length; i+=3) {
				if (answer[i]==1) {
						document.getElementById(answer[i+1]).innerHTML = answer[i+2];
					}
				if (answer[i]==2) {
						document.getElementById(answer[i+1]).value = answer[i+2];
					}
			}

		var iframeids=["layouttableiframecontent"]		
		if (window.addEventListener)
			window.addEventListener("load", resizeCaller, false)
		else if (window.attachEvent)
			window.attachEvent("onload", resizeCaller)
		else
			window.onload=resizeCaller
		}
	}
function call_server_ficon_loadtemplate(id)
		{
			var InspCheckList = document.getElementById("InspTemplate").value;
			var url = "ajax_part139339_loadtemplate_data_entry_request.php?InspCheckList=" + escape(InspCheckList) + "&Employee=" + escape(id);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction_ficon_loadtemplate;
			request.send('');
		}

function creat_Object_ficon_anomalie_type()
{

var xmlhttp;
	// This if condition for  Firefox and  Opera  Browsers	
  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') 
  {
		try 
		{
		  xmlhttp = new XMLHttpRequest();
		} 
		catch (e) 
		{
			alert("Your browser is not supporting XMLHTTPRequest");
			xmlhttp = false;
		}
	}
	// else condition for  ie
	else
	{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  return xmlhttp;
}
	
var request = creat_Object_ficon_anomalie_type();
function sever_interaction_ficon_anomalie_type()
	{
	if(request.readyState == 4)
		{
		var answer = request.responseText.split("|");
		document.getElementById("anomalielocation_id").innerHTML = answer;
		}
	}
function call_server_ficon_anomalie_type(id)
		{
			var InspCheckList = document.getElementById("discrepancy_type_cb_int").value;
			var url = "ajax_part139339_anomalietype_data_entry_request.php?InspCheckList=" + escape(InspCheckList) + "&Employee=" + escape(id);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction_ficon_anomalie_type;
			request.send('');
		}