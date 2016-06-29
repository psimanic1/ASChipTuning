function dodajProizvodjaca(){
	urlTmp='../php/dodavanjeProizvodjaca.php';
	var datarow={	};
	$.ajax({
	   url: urlTmp,
	   type:    'GET',
	   data: datarow,
	 success: function(response){
		$("#centerAdminPanel").html(response);
	 }});
	return false;
}

function dodajVozilo(){
	urlTmp='../php/dodajVozilo.php';
	var datarow={	};
	$.ajax({
	   url: urlTmp,
	   type:    'GET',
	   data: datarow,
	 success: function(response){
		$("#centerAdminPanel").html(response);
	 }});
	return false;
}