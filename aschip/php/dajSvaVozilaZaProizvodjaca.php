<?php

include 'crud.php';
include 'klase.php';

if(isset($_REQUEST["idProizvodjaca"]) && isset($_REQUEST["tipVozila"])){
	Prikazi(dajVozilaZaProizvodjacaITipVozila($_REQUEST["idProizvodjaca"],$_REQUEST["tipVozila"]));
}

function Prikazi($lista){
	$lista=izbaciDuple($lista);
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

function izbaciDuple($lista){
	$lista=Sortiraj($lista);
	$tmpList=array();
	for($i=0; $i<count($lista); $i++){
		$j=$i+1;
		if($j==count($lista)){ 
			array_push($tmpList,$lista[$i]);
			break;
		}
		if($lista[$i]["model"]==$lista[$j]["model"]) continue;
		else{
			array_push($tmpList,$lista[$i]);
		}
	}
	return $tmpList;
}
function Sortiraj($list){
	foreach ($list as $key => $row) {
		$model[$key]  = $row['model'];
	}
	array_multisort($model, SORT_ASC, $list);
	return $list;
}

?>

<style>
.imgVozila{
	max-width:150px;
	max-height:150px;
}
</style>