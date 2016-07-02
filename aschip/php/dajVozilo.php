<?php

include 'crud.php';
include 'klase.php';

if(isset($_REQUEST["id"])){
	$vozila=dajVozilaZaModel(dajVoziloPoId($_REQUEST["id"])["model"]);
	PrikaziSveMotore($vozila);
}

function PrikaziSveMotore($list){
	echo '<table id="tabela" style="text-align:center;">
		 <thead>
    	<tr>
        	<th scope="col">Vozilo</th>
            <th scope="col">Model</th>
            <th scope="col">Motor</th>
            <th scope="col">HP</th>
            <th scope="col">kW</th>
        </tr>
    </thead>
    <tbody>';
	for($i=0; $i<count($list); $i++){
		echo '<tr onclick="dajDetaljeMotoraVozila('.$list[$i]["id"].')">
        	<td ><a href="#">'.dajProizvodjacaPoId($list[$i]["idProizvodjaca"])["markaVozila"].'</a></td>
            <td><a href="#">'.$list[$i]["model"].'</a></td>
            <td><a href="#">'.$list[$i]["motor"].'</a></td>
            <td><a href="#">'.$list[$i]["hp"].'</a></td>
            <td><a href="#">'.$list[$i]["kw"].'</a></td>
        </tr>';
	}
	
	echo '</tbody></table>';
}

?>
<style>
#tabela tbody tr:hover{
	background-color: red;
}
</style>
<script>
function dajDetaljeMotoraVozila(id){
	var dataRow={
		'model':id,
		
	}
	$.ajax( {
	  url: '../php/dajDetaljeMotoraVozila.php',
	  type: 'POST',
	  data: dataRow,
	  success:function(response){
		  $("#content").html(response);
	  }
	});
	return false;
}

</script>