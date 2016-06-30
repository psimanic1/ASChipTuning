<?php

include 'crud.php';
include 'klase.php';

if(isset($_REQUEST["id"])){
	Prikazi(dajVoziloPoId($_REQUEST["id"]));
}
//cisti prikaz, to bum skontali kako cemo napraviti :D
function Prikazi($vozilo){
	echo '<div> 
			<h2 style="margin: 20px 0;">'.dajProizvodjacaPoId($vozilo["idProizvodjaca"])["markaVozila"].'</h2>
			<div>Model: '.$vozilo["model"].'</div>
			<div>Motor: '.$vozilo["motor"].'</div>
			<div>HP: '.$vozilo["hp"].'</div>
			<div>kW: '.$vozilo["kw"].'</div>
			<div>Snaga: '.$vozilo["snaga"].'</div>
			<div>Obrtaji: '.$vozilo["obrtaji"].'</div>
			<div>Cijena: '.$vozilo["cijena"].'</div>
			<div><img src="'.dajSlikuPoid($vozilo["idSlike"])["path"].'" alt=""></div>			

		</div>';	
}

?>