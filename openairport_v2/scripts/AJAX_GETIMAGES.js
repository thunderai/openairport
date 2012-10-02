//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

var bxrequest = creat_object_getimages();

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function creat_object_getimages()
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

function sever_interaction_getimages()
	{
	if(bxrequest.readyState == 4)
		{
		var answer = bxrequest.responseText.split("|");
		document.getElementById("placeimageshere").innerHTML = answer;
		}
	}
function call_server_getimages(display)
		{
			var url = "ajax_getimages.php?category=" + escape(display);
			bxrequest.open("GET", url); 
			bxrequest.onreadystatechange = sever_interaction_getimages;
			bxrequest.send('');
		
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------