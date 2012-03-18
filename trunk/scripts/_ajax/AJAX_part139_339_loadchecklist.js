//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		
	var Firequest = creat_Object_ficon();	
		
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		
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

function sever_interaction_ficon()
	{
	if(Firequest.readyState == 4)
		{
		var answer = Firequest.responseText.split("|");
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
			var url = "part139339_c_ajax_getchecklist.php?InspCheckList=" + escape(InspCheckList) + "&Employee=" + escape(id) + "&fullorshort=" + escape(fullorshort);
			Firequest.open("GET", url); 
			Firequest.onreadystatechange = sever_interaction_ficon;
			Firequest.send('');
		}