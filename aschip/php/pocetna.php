<?php
include 'crud.php';
include 'klase.php';


$tipV=0;
$markaVozila=0;
$modelVozila=0;

function PrikaziTipVozila(){
	if(isset($_POST["tipVozila"]))
		$tipV = $_POST["tipVozila"]?:'';
	else{
		$tipV=0;
	}
	if($tipV==0){
		echo '<option selected="selected" value="0">Auto</option>';
		echo '<option value="1">Kamion</option>';
		echo '<option value="2">Motor</option>';
	}
	else if($tipV==1){
		echo '<option value="0">Auto</option>';
		echo '<option selected="selected" value="1">Kamion</option>';
		echo '<option value="2">Motor</option>';
	}
	else if($tipV==2){
		echo '<option value="0">Auto</option>';
		echo '<option value="1">Kamion</option>';
		echo '<option selected="selected" value="2">Motor</option>';
	}
}

function PrikaziMarkeVozila($lista){
	if(isset($_POST['markaVozila']))
		$markaVozila = $_POST['markaVozila']?:'';
	else{
		$markaVozila=0;
	}
	for($i=0; $i<count($lista); $i++){
		if(isset($_POST["markaVozila"])){
			if($markaVozila==$lista[$i]["id"])
				echo '<option selected="selected" value="'.$lista[$i]["id"].'">'.$lista[$i]["markaVozila"].'</option>';	
			else
				echo '<option value="'.$lista[$i]["id"].'">'.$lista[$i]["markaVozila"].'</option>';
		}else{
			echo '<option value="'.$lista[$i]["id"].'">'.$lista[$i]["markaVozila"].'</option>';	
		}
	}
}

function PrikaziModeleVozila($lista){
	$lista=izbaciDuple($lista);
	if(isset($_POST['model']))
		$modelVozila = $_POST['model']?:'';
	else{
		$modelVozila=0;
	}
	for($i=0; $i<count($lista); $i++){
		if(isset($_POST["model"])){
			if($modelVozila==$lista[$i]["id"])
				echo '<option selected="selected" value="'.$lista[$i]["id"].'">'.$lista[$i]["model"].'</option>';	
			else
				echo '<option value="'.$lista[$i]["id"].'">'.$lista[$i]["model"].'</option>';
		}else{
			echo '<option value="'.$lista[$i]["id"].'">'.$lista[$i]["model"].'</option>';	
		}
	}
}

function PrikaziMotoreZaModel($lista){
	for($i=0; $i<count($lista); $i++){
		echo '<option value="'.$lista[$i]["id"].'">'.$lista[$i]["motor"].'</option>';	
	}
}

function izbaciDuple($lista){
	$lista=Sortiraj($lista);
	$tmpList=array();
	for($i=0; $i<count($lista); $i++){
		$j=$i+1;
		if($j==count($lista)){ 
			array_push($tmpList,$lista[$i]);
			break;
		}
		if($lista[$i]["model"]==$lista[$j]["model"]) continue;
		else{
			array_push($tmpList,$lista[$i]);
		}
	}
	return $tmpList;
}

function Sortiraj($list){
	foreach ($list as $key => $row) {
		$model[$key]  = $row['model'];
	}
	array_multisort($model, SORT_ASC, $list);
	return $list;
}
?>


	<div id="centralni"
	<p>Odaberite vozilo i saznajte koliko snage dobijate chip tuningom!</p>
	</div>
	<div class="odabir">
	<p>Tip--------Marka------------Model---------Motor</p>
	<form id="tipVozilaForm" method="POST">
		<select id="tipVozila" name="tipVozila" onchange="SubmitTipVozilaForm()">
			<?php
				PrikaziTipVozila();							
			?>
		</select>
	</form>
	<form id="markaVozilaForm" method="POST">
		<select id="markaVozila" name="markaVozila" onchange="SubmitMarkaVozilaForm()">
			<option value="-1">Odaberite marku vozila</option>
			<?php
				PrikaziMarkeVozila(dajSveProizvodjace());							
			?>
		</select>
	</form>
	
	<select id="model" name="model" onchange="SubmitModelForm()">
		<option value="-1">Odaberite model vozila</option>
		<?php
			if(isset($_POST["tipVozila"]))
				$tipV = $_POST["tipVozila"]?:'';
			else{
				$tipV=0;
			}
			$tipVozila="";
			if($tipV==0) $tipVozila="Auto";
			else if($tipV==1) $tipVozila="Kamion";
			else if($tipV==2) $tipVozila="Motor";
			if(isset($_POST['markaVozila']))
				$markaVozila = $_POST['markaVozila']?:'';
			else{
				$markaVozila=0;
			}
			PrikaziModeleVozila(dajVozilaZaProizvodjacaITipVozila($markaVozila,$tipVozila));							

		?>
	</select>
	
	<select id="motorVozila" name="motorVozila" onchange="SubmitMotorVozila()">
		<option value="-1">Odaberite motor vozila</option>
		<?php
			if(isset($_POST['model']))
				$modelVozila = $_POST['model']?:'';
			else{
				$modelVozila=0;
			}
			$modelIme=dajVoziloPoId($modelVozila);
			PrikaziMotoreZaModel(dajVozilaZaModel($modelIme["model"]));
		?>
	</select>
    <br class="clear" />
	<div id="detalji"></div>
    </div>
	
<script>
function SubmitTipVozilaForm(){
	var dataRow={
		'tipVozila':$("#tipVozila option:selected").val()
	}
	$.ajax( {
	  url: 'php/pocetna.php',
	  type: 'POST',
	  data: dataRow,
	  success:function(response){
		  $("#container").html(response);
	  }
	});
	return false;	
}

function SubmitMarkaVozilaForm(){
	var dataRow={
		'markaVozila':$("#markaVozila option:selected").val(),
		'tipVozila':$("#tipVozila option:selected").val()
	}
	$.ajax( {
	  url: 'php/pocetna.php',
	  type: 'POST',
	  data: dataRow,
	  success:function(response){
		  $("#container").html(response);
	  }
	});
	return false;	
}

function SubmitModelForm(){
	var dataRow={
		'model':$("#model option:selected").val(),
		'markaVozila':$("#markaVozila option:selected").val(),
		'tipVozila':$("#tipVozila option:selected").val()
	}
	$.ajax( {
	  url: 'php/pocetna.php',
	  type: 'POST',
	  data: dataRow,
	  success:function(response){
		  $("#container").html(response);
	  }
	});
	return false;	
}

function SubmitMotorVozila(){
	var dataRow={
		'model':$("#motorVozila option:selected").val(),
		'pocetna':"true"
	}
	$.ajax( {
	  url: 'php/dajDetaljeMotoraVozila.php',
	  type: 'POST',
	  data: dataRow,
	  success:function(response){
		  $("#detalji").html(response);
	  }
	});
	return false;
}
</script>