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

						var fieldname 	= answer[i+1];
						var fieldvalue 	= document.getElementById(fieldname).innerHTML;
						
						// Check to see if the string included "CHECKED"
						//		if it does it will return the position in the string
						//		or -1 if no return.
						var ischecked	= fieldvalue.search("checked");
					
						//alert(fieldname);
						
						if(ischecked == -1) {
							
								//alert(fieldvalue);				
					
								document.getElementById(answer[i+1]).innerHTML = answer[i+2];
							
							} else {
								
								// Surface is closed attempt to block other items in this row
								//		we need to know more about the field name and how it
								//		relates to the name of the member groups as we're out
								//		out of the loop of PHP's help.
								
								//alert(fieldname);
								
							}
							
					}
				if (answer[i]==2) {
						
						var fieldname 	= answer[i+1];
						var fieldvalue 	= document.getElementById(fieldname).value;
					
						//alert(fieldname);
						//alert(fieldvalue);				
						
						if(fieldvalue == 'CLOSED') {
						
							} else {
						
								document.getElementById(answer[i+1]).value = answer[i+2];
							}
					
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
			var url = "part139339_c_ajax_loadtemplate.php?InspCheckList=" + escape(InspCheckList) + "&Employee=" + escape(id);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction_ficon_loadtemplate;
			request.send('');
		}