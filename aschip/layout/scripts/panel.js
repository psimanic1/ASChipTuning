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

function obrisiProizvodjaca(){
	urlTmp='../php/obrisiProizvodjaca.php';
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

function obrisiVozilo(){
	urlTmp='../php/obrisiVozilo.php';
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

function editujGaleriju(){
	urlTmp='../php/galerija.php';
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

function dodajNovosti(){
	urlTmp='../php/dodajNovost.php';
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