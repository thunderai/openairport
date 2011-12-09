//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

var mirequest = creat_object_menuitem();

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