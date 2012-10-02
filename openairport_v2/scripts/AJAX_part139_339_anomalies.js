//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	var request = creat_Object_ficon_anomalie_type();

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

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
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------