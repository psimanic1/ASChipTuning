<?php
include 'crud.php';
include 'klase.php';

function PrikaziNovosti($list){
	for($i=0; $i<count($list); $i++){
		echo '<div class="novosti" onmouseover="Prikazi(this)" onmouseleave="Sakrij(this)"> 
				<h2>'.$list[$i]["naslov"].'</h2><div style="display:none;" class="obrisi" onclick="Obrisi('.$list[$i]["id"].')">X</div><div style="display:none;" class="edit" onclick="Edituj('.$list[$i]["id"].')">Edit</div>
				<div class="vrijeme"> Novost objavljena '.$list[$i]["datumObjave"].'.</div>
				<div class="novost">
					<img class="slikaNovosti" src="'.dajSlikuPoId($list[$i]["idSlike"])["path"].'" alt="0"/>
					<p class="paragrafNovosti">'.$list[$i]["tekst"].'</p>
				</div>
			</div>';
	}
}

if(isset($_POST["brNovosti"])){
	PrikaziNovosti(ucitajJos5Novosti($_POST["brNovosti"])); 
}

?>