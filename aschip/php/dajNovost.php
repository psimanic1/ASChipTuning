<?php
include 'crud.php';
include 'klase.php';

if(isset($_POST["idNovosti"])){
	$novost=dajNovostPoId($_POST["idNovosti"]);
	$data = $novost;
	header('Content-Type: application/json');
	echo json_encode($data);
/*	echo "datum:".$novost["datumObjave"]." \n";
	echo "tekst:".$novost["tekst"]." \n";
	echo "idSlike:".$novost["idSlike"]." \n";
	echo "naslov:".$novost["naslov"]." \n";*/
}

?>