//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

var ncrequest = creat_object_navigationalcontrol();

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