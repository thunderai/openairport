//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

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
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------