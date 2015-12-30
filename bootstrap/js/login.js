function selectNumber(number) {
	
	var inserted = document.getElementById("pin_field").innerHTML;
	
	if(inserted.length < 20) {
			document.getElementById('pin_field').innerHTML = inserted + number;
		
	}
	
	
	/*
	var inserted = document.getElementById("pin_field").value;
	
	var new_number = 1;
	
	var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	      document.getElementById("tulemused").innerHTML = xhttp.responseText;
	    }
	  };
	
	  xhttp.open("GET", "kalkulaator.php" + query, true);
	  xhttp.send();
	*/
}

function clearSilk(number) {
	
	document.getElementById('pin_field').innerHTML = "&nbsp";

}

function sendSilk() {
	
	var inserted = document.getElementById("pin_field").innerHTML;
	
	document.getElementById('pin_field').innerHTML = "lammas" + inserted;
}