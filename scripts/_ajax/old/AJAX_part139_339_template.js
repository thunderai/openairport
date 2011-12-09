//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	var request = creat_Object_ficon_template();
	
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		
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