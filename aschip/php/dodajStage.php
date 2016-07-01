<?php
include 'crud.php';
include 'klase.php';
session_start();

$id="";
if(!empty($_GET["idVozila"]))
	$id=$_GET["idVozila"];
else{
	$id=$_POST["idVozila"];
}
$tuninzi=dajSveChipTuningZaVozilo($id);



if( $_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['username'])){
		$snaga=htmlspecialchars($_POST["snaga"]);
		$obrtaji=htmlspecialchars($_POST["obrtaji"]);
		$cijena=htmlspecialchars($_POST["cijena"]);
		if(!empty($snaga) && !empty($obrtaji)){
			$stage=new Stage();
			$stage->StageCtor(0,$snaga,$obrtaji,$cijena);
			$idStage= dodajStage($stage);
			
			$chiptuning=new ChipTuning();
			if(!empty($tuninzi)){
				if($tuninzi["0"]["idStage1"]==0){
					$chiptuning->ChipTuningCtor(0,$id,$idStage,0,0,0);
					dodajStage1ChipTuning($chiptuning);
				}
				else if($tuninzi["0"]["idStage2"]==0){
					$idChipa=$tuninzi["0"]["id"];
					$chiptuning->ChipTuningCtor($idChipa,$id,0,$idStage,0,0);
					dodajStage2ChipTuning($chiptuning);
				} 
				else if($tuninzi["0"]["idStage3"]==0){
					$idChipa=$tuninzi["0"]["id"];
					$chiptuning->ChipTuningCtor($idChipa,$id,0,0,$idStage,0);
					dodajStage3ChipTuning($chiptuning);
				}
				else if($tuninzi["0"]["idEcoTuning"]==0){
					$idChipa=$tuninzi["0"]["id"];
					$chiptuning->ChipTuningCtor($idChipa,$id,0,0,0,$idStage);
					dodajEcoStageChipTuning($chiptuning);
				}else{
					echo "Neka greska koja ne znam sta je.";		
				}
			}else{
				$chiptuning->ChipTuningCtor(0,$id,$idStage,0,0,0);
				dodajChipTuning($chiptuning);
			}
			echo "Uspjesno ste dodali stage!";
		}else{
			echo "Nisu uneseni snaga i obrtaji";
		}
}

if(!empty($tuninzi)){
	if($tuninzi["0"]["idStage1"]==0) echo "Stage 1";
	else if($tuninzi["0"]["idStage2"]==0) echo "STage 2";
	else if($tuninzi["0"]["idStage3"]==0) echo "STage 3";
	else if($tuninzi["0"]["idEcoTuning"]==0) echo "Eco Tuning";
	else "Stage";
}else{
	echo "Stage 1";
}
?>


<form id="dodajStage" method="POST">
	<?php
	if(!empty($_GET["idVozila"]))
		echo '<input type="hidden" value="'.$_GET["idVozila"].'" name="idVozila" />'; 
	else
		echo '<input type="hidden" value="'.$_POST["idVozila"].'" name="idVozila" />'; 	?>
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
		  url: '../php/dodajStage.php',
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