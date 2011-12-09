//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	var request = creat_Object_ficon_loadtemplate();
	
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------	

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