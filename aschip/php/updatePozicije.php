<?php
include 'crud.php';
include 'klase.php';

if(isset($_POST["id"])){
	$rez=updatePozicijeSlikeNaPocetnoj($_POST["id"],$_POST["pozicija"]);
	if($rez==true)
		echo 'Slika je uspjesno postavljenja!';
}

?>