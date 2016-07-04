<?php
include 'crud.php';
include 'klase.php';

if(isset($_POST["idNovosti"])){
	$novost=dajNovostPoId($_POST["idNovosti"]);
	$data = $novost;
	header('Content-Type: application/json');
	echo json_encode($data);
}

?>