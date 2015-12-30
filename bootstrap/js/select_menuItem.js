function selectMenuItem() {
	
	var menuItem_id = event.target.value;
	
	
	var xhttp = new XMLHttpRequest();
	  	xhttp.onreadystatechange = function() {
	    	if (xhttp.readyState == 4 && xhttp.status == 200) {
	      		document.getElementById("selected_menu_items").innerHTML = xhttp.responseText;
	    	}
		};
	
	  xhttp.open("GET", "FrontPage/displayMenuItem/" + menuItem_id, true);
	  xhttp.send();
	
}

$(function () {
                $('#datetimepicker1').datetimepicker();
            });