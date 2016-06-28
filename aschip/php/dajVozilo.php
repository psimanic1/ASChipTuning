<?php

include 'crud.php';
include 'klase.php';

if(isset($_REQUEST["id"]){
	Prikazi(dajVoziloPoId($_REQUEST["id"]));
}
//cisti prikaz, to bum skontali kako cemo napraviti :D
function Prikazi($vozilo){
	echo '<div> 
			<div>'.$vozilo["id"].'</div>
			<div>'.$vozilo["model"].'</div>
			<div>'.$vozilo["tipVozila"].'</div>
			<div>'.$vozilo["motor"].'</div>
			<div>'.$vozilo["hp"].'</div>
			<div>'.$vozilo["kw"].'</div>
			<div>'.$vozilo["snaga"].'</div>
			<div>'.$vozilo["obrtaji"].'</div>
			<div>'.$vozilo["cijena"].'</div>
			<div><img src="'.dajSlikuPoid($vozilo["idSlike"])["path"].'" alt=""></div>			
			<div>'.dajProizvodjacaPodId($vozilo["idProizvodjaca"])["markaVozila"].'</div>
		</div>';	
}

?>