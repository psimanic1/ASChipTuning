<?php
include 'crud.php';
include 'klase.php';
session_start();

$id=$_GET["idVozila"];
$tuninzi=dajSveChipTuningZaVozilo($id);

if(!empty($tuninzi)){
	if($tuninzi["idStage1"]=="") echo "Stage 1";
	else if($tuninzi["idStage2"]=="") echo "STage 2";
	else if($tuninzi["idStage3"]=="") echo "STage 3";
	else if($tuninzi["idEcoTuning"]=="") echo "Eco Tuning";
	else "Stage";
}else{
		echo "Stage 1";
}


if( $_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['username'])){
		$snaga=htmlspecialchars($_POST["snaga"]);
		$obrtaji=htmlspecialchars($_POST["obrtaji"]);
		$cijena=htmlspecialchars($_POST["cijena"]);
		if(!empty($snaga) && !empty($obrtaji) && !empty($cijena)){
			echo "DODANO AL MALO SUTRA, BIT CE USKORO GOTOVO :D";
		}

?>


<form id="dodajStage" method="POST">
	<?php echo '<input type="hidden" value="'.$_GET["idVozila"].'" name="idVozila" />'; ?>
	
	<label>Snaga:</label></br>
	<input name="snaga" value="" id="snaga"/></br>
	<label>Obrtaji:</label></br>
	<input name="obrtaji" value="" id="obrtaji"/></br>
	<label>Cijena:</label></br>
	<input name="cijena" value="" id="cijena"/></br>
	<input type="submit" name="submit" value="submit"/>
</form>

<script>
$('#dodajStage').submit( function( e ) {
		$.ajax( {
		  url: '../php/dodajVozilo.php',
		  type: 'POST',
		  data: new FormData(this),
		  processData: false,
		  contentType: false,
		  success:function(response){
			  $("#centerAdminPanel").html(response);
		  }
		});
    e.preventDefault();
	});
	
</script>