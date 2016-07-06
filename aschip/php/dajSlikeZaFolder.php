<?php
include 'crud.php';
include 'klase.php';

if(isset($_GET["idFoldera"])){
	$list=dajSveSlikeZaFolder($_GET["idFoldera"]);
	for($i=0; $i<count($list); $i++){
		echo '<img src="'.$list[$i]["path"].'" alt="" width="100%" height="300" />';
	}
}

?>