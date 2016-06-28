function OtvoriProizvodjaca(id,tip){
	var check=window.location.pathname;
	urlTmp='../php/dajSvaVozilaZaProizvodjaca.php';
	var datarow={
		'idProizvodjaca':id,
		'tipVozila':tip
	};
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: datarow,
	 success: function(response){
		$("#content").html(response);
		/*if(response.indexOf("Pogresan username i sifra!")!=-1) 
			//$("#Poruka").html("Pogresan username i sifra!");
			alert("Pogresan username i sifra!");
		else{
			document.location.reload();
			localStorage.setItem("msg", "Uspjesno ste se logovali!");
		}*/
	 }});
	return false;
}