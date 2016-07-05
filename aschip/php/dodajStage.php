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
					$chiptuning->ChipTuningCtor(0,$id,$idStage,0);
					dodajStage1ChipTuning($chiptuning);
				}
				else if($tuninzi["0"]["idStage2"]==0){
					$idChipa=$tuninzi["0"]["id"];
					$chiptuning->ChipTuningCtor($idChipa,$id,0,$idStage);
					dodajStage2ChipTuning($chiptuning);
				}else{
					echo "Neka greska koja ne znam sta je.";		
				}
			}else{
				$chiptuning->ChipTuningCtor(0,$id,$idStage,0);
				dodajChipTuning($chiptuning);
			}
			echo "Uspjesno ste dodali stage!";
			?>
			</br>
			<?php
		}else{
			echo "Nisu uneseni snaga i obrtaji";
		}
}

echo " ";
$kraj=false;
$tuninzi=dajSveChipTuningZaVozilo($id);

if(!empty($tuninzi)){
	if($tuninzi["0"]["idStage1"]==0) echo "Stage 1";
	else if($tuninzi["0"]["idStage2"]==0) echo "STage 2";
	else{
		echo "Vise ne mozete dodati stage-ova!";
		$kraj=true;
	}
}else{
	echo "Stage 1";
}
?>
<?php
if(!$kraj){
?>
<form id="dodajStage" method="POST">
	<?php
	if(!empty($_GET["idVozila"]))
		echo '<input type="hidden" value="'.$_GET["idVozila"].'" name="idVozila" />'; 
	else
		echo '<input type="hidden" value="'.$_POST["idVozila"].'" name="idVozila" />'; 	?>
	<label>Snaga:</label></br>
	<input type="text" name="snaga" value="Na upit" id="snaga" oninput="Validiraj(this)"/></br>
	<label>Obrtaji:</label></br>
	<input type="text" name="obrtaji" value="Na upit" id="obrtaji" oninput="Validiraj(this)"/></br>
	<label>Cijena:</label></br>
	<input type="text" name="cijena" value="Na upit" id="cijena"  oninput="Validiraj(this)"/></br>
	<input type="submit" name="submit" value="submit" id="submit"/>
</form>
<?php
}
?>
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

//validacija
function Validiraj(tb){
	if(tb.value=="" || tb.value.length>=20){
		addRedBorder(tb);
		$("#submit").attr("disabled","disabled");
	}else{
		removeRedBorder(tb);
	}
}

function addRedBorder(tb){
	$(tb).addClass("redBorder");
}

function removeRedBorder(tb){
	$(tb).removeClass("redBorder");
	Check();
}

function Check(){
	var prviEl=$("#snaga").hasClass("redBorder");
	var drugiEl=$("#obrtaji").hasClass("redBorder");
	var treciEl=$("#cijena").hasClass("redBorder");
	if(!prviEl && !drugiEl && !treciEl)
		$("#submit").removeAttr("disabled");
}
</script>