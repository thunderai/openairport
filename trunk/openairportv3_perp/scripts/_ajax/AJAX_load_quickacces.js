//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

var request = creat_Object_load_quickaccess();

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
function creat_Object_load_quickaccess()
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

function sever_interaction_load_quickaccess()
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
function call_server_load_quickaccess(userid,direction)
		{
			
			var start 	= document.getElementById('qa_start').value;
			var end		= document.getElementById('qa_end').value;
		
			start 		= start * 1;
			end 		= end * 1;
		
			//alert(start);
		
			if(direction == 'down') {
				
					if(start <= 0) {
							start = 0;
							
							document.getElementById('button_down').className = 'table_button_side_top_inactive';
							document.getElementById('button_up').className = 'table_button_side_top_function';

							} else {
							
							start= start - 1;
							//alert(start);
							
							document.getElementById('button_down').className = 'table_button_side_top_function';
							document.getElementById('button_up').className = 'table_button_side_top_function';
							document.getElementById('qa_start').value 	= start;
							//document.getElementById('qa_end').value 	= (end - 1);
						}
					
				}
			if(direction == 'up') {
					
					start= start + 1;
					//alert(start);
					if(start >= 4) {
							
							start = 4;
							document.getElementById('button_up').className = 'table_button_side_top_inactive';
							document.getElementById('button_down').className = 'table_button_side_top_function';

						} else {
						
					document.getElementById('button_up').className = 'table_button_side_top_function';
					document.getElementById('button_down').className = 'table_button_side_top_function';
					document.getElementById('qa_start').value 	= start;
					//document.getElementById('qa_end').value 	= (end + 1);
						}
				}
				
			
			var url 	= "ajax_load_quickaccess.php?userid=" + escape(userid) + "&start=" + escape(start) + "&end=" + escape(end);
			//alert(start);
			request.open("GET", url); 
			request.onreadystatechange = sever_interaction_load_quickaccess;
			request.send('');
		
			parent.document.getElementById('qa_rpt').innerHTML = "0S/" + document.getElementById('qa_start').value + " - " + "I/" +document.getElementById('qa_end').value;
			
		var currentvalueof_systemtext = parent.document.getElementById('SystemText').innerHTML;
		var newmessage = "Move Menu System " + direction + " << ";
		var completed_message = (newmessage) + " << " + (currentvalueof_systemtext);
		parent.document.getElementById('SystemText').innerHTML = completed_message;		
		}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------