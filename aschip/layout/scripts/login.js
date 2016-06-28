function UcitajFormu(){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementById("vrh").innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementById("vrh").innerHTML = "Greska: nepoznat URL";
	}
	var check=window.location.pathname;
	var urlTmp='php/login.php';
	if(check.indexOf("pages")!=-1)
		urlTmp='../php/login.php';
	ajax.open("GET", urlTmp, true);
	ajax.send();	
}

function Zatvori(){
	$("#loginForm").hide();
}

function SubmitLogin(){
	var check=window.location.pathname;
	var urlTmp='php/login.php';
	if(check.indexOf("pages")!=-1)
		urlTmp='../php/login.php';
	var datarow={
		'username':$("#username").val(),
		'pass':$("#pass").val()
	};
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: datarow,
	 success: function(response){
		if(response.indexOf("Pogresan username i sifra!")!=-1) alert("Pogresan username i sifra!");
		else
			document.getElementById("vrh").innerHTML = response;
	 },
	 error: function(){
	   alert(w.data_error);
	   document.location.reload(); 
	 },
	 complete: function(){
	   document.location.reload(); 
	 }
	});
}
function SubmitLogout(){
	var check=window.location.pathname;
	var urlTmp='php/login.php';
	if(check.indexOf("pages")!=-1)
		urlTmp='../php/login.php';
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: 'odjava=odjava',
	 success: function(response){
		 document.getElementById("vrh").innerHTML = response;
	 },
	 error: function(){
	   alert(w.data_error);
	   document.location.reload(); 
	 },
	 complete: function(){
	   document.location.reload(); 
	 }
	});
}