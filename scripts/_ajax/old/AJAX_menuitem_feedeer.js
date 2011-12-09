//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

var nmrequest = creat_object_menuitem_feeder();

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