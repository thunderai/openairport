//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

var request = creat_Object_MapIt_339D_t();

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
function creat_Object_MapIt_339D_t()
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

function sever_interaction_MapIt_339D_t()
	{
	if(request.readyState == 4)
		{
		var answer = request.responseText.split("|");
		//alert(answer);
		top.document.getElementById("MapIt_339D").innerHTML = answer;
		
		var iframeids=["layouttableiframecontent"]		
		if (window.addEventListener)
			window.addEventListener("load", resizeCaller, false)
		else if (window.attachEvent)
			window.attachEvent("onload", resizeCaller)
		else
			window.onload=resizeCaller

		}
	}
function call_server_MapIt_339D_t(idstring,howtodisplay,whatdoido)
		{
			//var InspCheckList = document.getElementById("InspCheckList").value;
			//alert(id);
			var url = "_iframe_getairportmap_elementinfo_MapIt_339B.php?idstring=" + escape(idstring) + "&whatdoido=" + escape(whatdoido);
			//alert(url);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction_MapIt_339D_t;
			request.send('');
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------