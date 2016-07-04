$(document).ready(function(){
$.ajax({
	  url: '../php/ucitajPosljednjih6Slika.php',
	  type: 'GET',
	  success:function(response){
		  $("#sestSlika").html(response);
	  }
	});
});

function OtvoriProizvodjaca(id,tip){
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
	 }});
	return false;
}

function OtvoriVozilo(id){
	urlTmp='../php/dajVozilo.php';
	var datarow={
		'id':id,
	};
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: datarow,
	 success: function(response){
		$("#content").html(response);
	 }});
	return false;
	
}