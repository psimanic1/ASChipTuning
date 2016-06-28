function UcitajFormu(){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementById("loginDiv").innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementById("loginDiv").innerHTML = "Greska: nepoznat URL";
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
$(document).ready(function(){
	if(localStorage.getItem("msg")){
		alert(localStorage.getItem("msg"));
		localStorage.clear();
	}
	
});

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
		
		if(response.indexOf("Pogresan username i sifra!")!=-1) 
			//$("#Poruka").html("Pogresan username i sifra!");
			alert("Pogresan username i sifra!");
		else{
			document.location.reload();
			localStorage.setItem("msg", "Uspjesno ste se logovali!");
		}
	 }});
	return false;
}
function SubmitLogout(){
	var check=window.location.pathname;
	var urlTmp='php/login.php';
	if(check.indexOf("pages")!=-1)
		urlTmp='../php/login.php';
	var datarow={
		'odjava':'odjava'
	};
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: datarow,
	 success: function(response){
		 if(response.indexOf("logout")!=-1)
			localStorage.setItem("msg", "Uspjesno ste se odjavili!");
		// document.getElementById("vrh").innerHTML = response;
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