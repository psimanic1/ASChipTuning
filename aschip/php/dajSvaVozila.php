<?php

include 'crud.php';
include 'klase.php';

Prikazi(dajSvaVozila());

//cisti prikaz, to bum skontali kako cemo napraviti :D
function Prikazi($lista){
	for($i=0; $i<count($lista); $i++){
		print '<div> 
			<div>'.$lista[$i]["id"].'</div>
			<div>'.$lista[$i]["model"].'</div>
			<div>'.$lista[$i]["tipVozila"].'</div>
			<div>'.$lista[$i]["motor"].'</div>
			<div>'.$lista[$i]["hp"].'</div>
			<div>'.$lista[$i]["kw"].'</div>
			<div>'.$lista[$i]["snaga"].'</div>
			<div>'.$lista[$i]["obrtaji"].'</div>
			<div>'.$lista[$i]["cijena"].'</div>
		</div>';	
	}
}

?>