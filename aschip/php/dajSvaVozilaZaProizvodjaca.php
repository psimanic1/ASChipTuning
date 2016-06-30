<?php

include 'crud.php';
include 'klase.php';

if(isset($_REQUEST["idProizvodjaca"]) && isset($_REQUEST["tipVozila"])){
	Prikazi(dajVozilaZaProizvodjacaITipVozila($_REQUEST["idProizvodjaca"],$_REQUEST["tipVozila"]));
}

function Prikazi($lista){
	echo '<h2 style="margin: 20px 0;">'.dajProizvodjacaPoId($_REQUEST["idProizvodjaca"])["markaVozila"].'</h2>
			<table id="brandovi" style="margin-left: 30px;">
			<tbody>';
	$j=0;
	for($i=0; $i<count($lista); $i++){
		if($j==0) echo '<tr>';
		$j++;
		echo '<td><a href="#" onclick="return OtvoriVozilo('.$lista[$i]["id"].')">
			<img class="imgVozila" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div style="text-align:center; max-width:150px;">'.$lista[$i]["model"].'</div></a></td>';				
		if($j==3){
			echo '</tr>';
			$j=0;
		}
	}
	echo '</tbody></table>';
}

?>

<style>
.imgVozila{
	max-width:150px;
	max-height:150px;
}
</style>