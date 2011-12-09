//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

var request = creat_Object_blockform();

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
function creat_Object_blockform()
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

function sever_interaction_blockform()
	{
	if(request.readyState == 4)
		{
		var answer = request.responseText.split("|");
		parent.document.getElementById("layout_topheadercenter").innerHTML = answer;
		
		var iframeids=["layouttableiframecontent"]		
		if (window.addEventListener)
			window.addEventListener("load", resizeCaller, false)
		else if (window.attachEvent)
			window.attachEvent("onload", resizeCaller)
		else
			window.onload=resizeCaller

		}
	}
function call_server_blockform(memnuid,userid,fieldtocontrol)
		{
		
		var fieldtocontrol 			= escape(fieldtocontrol);
		var currentvalueinfield 	= document.getElementById(fieldtocontrol).value;
		var fieldtocontrol_show		= fieldtocontrol + "active";
		
			var url = "ajax_blockform.php?menuid=" + escape(memnuid) + "&Employee=" + escape(userid) + "&value=" + escape(currentvalueinfield);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction_blockform;
			request.send('');

			if (currentvalueinfield == 1) {
				document.getElementById(fieldtocontrol).value		= 0;
				document.getElementById(fieldtocontrol_show).value	= "Add to Quick Menu";
				}
			if (currentvalueinfield == 0) {
				document.getElementById(fieldtocontrol).value 		= 1;
				document.getElementById(fieldtocontrol_show).value	= "Remove from Quick Menu!";
				}
		
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------