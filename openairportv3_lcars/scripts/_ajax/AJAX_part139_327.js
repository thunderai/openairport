//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

var request = creat_Object();

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
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
			var url = "part139327_ajax_getchecklist.php?InspCheckList=" + escape(InspCheckList) + "&Employee=" + escape(id);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction;
			request.send('');
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------