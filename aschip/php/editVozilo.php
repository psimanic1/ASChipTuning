<?php

include 'crud.php';
include 'klase.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"]) && isset($_POST["idVozila"])){
	$vozilo=dajVoziloPoId($_POST["idVozila"]);
	PrikaziFormuZaEdit($vozilo);
	PrikaziStage($vozilo["id"]);
}

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"]) && !isset($_POST["submit"]) && (isset($_POST["submit1"]) || isset($_POST["submit2"]))){
	SaveEditStage();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"]) && isset($_POST["submit"])){
	$id=$_POST["id"];
	$vozilo=dajVoziloPoId($id);
	SaveEdit($vozilo);
}


if(!empty($_SESSION["username"]) && !isset($_POST["search"]) && !isset($_POST["idVozila"])){
	$lista=Sortiraj(dajSvaVozila());
	Prikazi($lista,"");	
}

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"]) && isset($_POST["search"])){
	Prikazi(dajVoziloPoModelu($_POST["search"]),$_POST["search"]); 
}

function Sortiraj($list){
	foreach ($list as $key => $row) {
		$model[$key]  = $row['model'];
	}
	array_multisort($model, SORT_ASC, $list);
	return $list;
}

function Prikazi($lista,$input){
	echo '<script>focusCampo("search");
	function focusCampo(id){
    var inputField = document.getElementById(id);
    if (inputField != null && inputField.value.length != 0){
        if (inputField.createTextRange){
            var FieldRange = inputField.createTextRange();
            FieldRange.moveStart("character",inputField.value.length);
            FieldRange.collapse();
            FieldRange.select();
        }else if (inputField.selectionStart || inputField.selectionStart == "0") {
            var elemLen = inputField.value.length;
            inputField.selectionStart = elemLen;
            inputField.selectionEnd = elemLen;
            inputField.focus();
        }
    }else{
        inputField.focus();
    }
}
	</script>';
	echo '<input type="text" name="search" value="'.$input.'" id="search" oninput="Trazi(this)"/>';
	echo '<table><tbody>';
	$j=0;
	for($i=0; $i<count($lista); $i++){
		if($j==0) echo '<tr>';
		$j++;
		echo '<td>
			<img class="imgProizvodjaca" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div class="sredina">'.$lista[$i]["model"].'</div>
			<input style="float:right; top:5px;" class="sredina" type="button" value="Edit" onclick="return EditujVozilo('.$lista[$i]["id"].')" />
			</td>';				
		if($j==3){
			echo '</tr>';
			$j=0;
		}
	}
	echo '</tbody></table>';
}

function PrikaziFormuZaEdit($vozilo){
	echo '<form style="display:inline-block; float:left" id="dodajAuto" method="POST" enctype="multipart/form-data">
	<input type="hidden" value="'.$vozilo["id"].'" name="id"/>
	<label>Model:</label></br>
	<input type="text" name="model" id="model" value="'.$vozilo["model"].'" oninput="ValidirajModel(this)" /></br>
	<label>Motor:</label></br>
	<input type="text" name="motor" id="motor" value="'.$vozilo["motor"].'" oninput="ValidirajMotor(this)"/></br>
	<label>HP:</label></br>
	<input type="text" name="hp" id="hp" value="'.$vozilo["hp"].'" oninput="Validiraj(this)" /></br>
	<label>kW:</label></br>
	<input type="text" name="kw" id="kw" value="'.$vozilo["kw"].'" oninput="Validiraj(this)" /></br>
	<label>Snaga:</label></br>
	<input type="text" name="snaga" id="snaga" value="'.$vozilo["snaga"].'" oninput="Validiraj(this)" /></br>
	<label>Obrtaji:</label></br>
	<input type="text" name="obrtaji" id="obrtaji" value="'.$vozilo["obrtaji"].'" oninput="Validiraj(this)" /></br>
	<label>Cijena:</label></br>
	<input type="text" name="cijena" id="cijena" value="'.$vozilo["cijena"].'" oninput="Validiraj(this)" /></br>
	<label>Stara slika:</label>
	<img style="width:100px; height:100px;" alt="" src="'.dajSlikuPoId($vozilo["idSlike"])["path"].'" >
	<label>Izaberite novu sliku:</label></br>
	<br>
	<input type="file" name="fileToUpload" id="fileToUpload"/>
	<input type="submit" value="Submit" name="submit" disabled="disabled" id="submit"/>
</form>';
	
}

function SaveEdit($vozilo){
		$model=htmlspecialchars($_POST["model"]);
		$motor=htmlspecialchars($_POST["motor"]);
		$hp=htmlspecialchars($_POST["hp"]);
		$kw=htmlspecialchars($_POST['kw']);
		$snaga=htmlspecialchars($_POST['snaga']);
		$obrtaji=htmlspecialchars($_POST['obrtaji']);
		$cijena=htmlspecialchars($_POST['cijena']);
		
		if(!empty($model) && !empty($motor) && !empty($hp) && !empty($kw) && !empty($snaga) && !empty($obrtaji) && !empty($cijena)){
			/*if(isset($_POST['tipVozila']))
				$tipV = $_POST['tipVozila']?:'';
			else{
				$tipV="";
			}
			if($tipV==0) $tipVozila="Auto";
			else if($tipV==1) $tipVozila="Kamion";
			else if($tipV==2) $tipVozila="Motor";
			else $tipVozila=null;*/
		
			
			$idUploadovaneSlike=0;
			$target_dir = "../uploads/vozila/".$vozilo["tipVozila"]."/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$video=0;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			$idUploadovaneSlike=0;
			if(!empty($_FILES["fileToUpload"]["tmp_name"])){
				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						$uploadOk = 1;
					} else {
						echo "Fajl nije slika ili video.";
						$uploadOk = 0;
					}
				}

				//povecati velicinu fajla ovo je 500kb
				if ($_FILES["fileToUpload"]["size"] > 500000) {
					echo "Fajl je prevelik";
					$uploadOk = 0;
				}
				
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
					echo "Samo JPG, JPEG, PNG & GIF fajlovi su dozvoljeni.";
					$uploadOk = 0;
				}

				if ($uploadOk == 0) {
					echo "Greska prilikom dodavanja slike.";
				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						$slika=new Slika();
						//idFoldera je 2 jer su tu slike za vozila
						$slika->SlikaCtor(0,$target_file,$video,2);
						obrisiSlikuPoId($vozilo["idSlike"]);
						$idUploadovaneSlike=dodajSliku($slika);
						
					} else {
						echo "Greska prilikom dodavanja slike.";
					}
				}
			}
			if($idUploadovaneSlike==0) $idUploadovaneSlike=null;
									
			$auto=new Vozilo();
			$auto->VoziloCtor($vozilo["id"],$model,null,$motor,$hp,$kw,$snaga,$obrtaji,$cijena,null,$idUploadovaneSlike);
			$id=updateVozilo($auto);
			
			if($id!=0){ 
				echo "<script> alert('Uspjesno ste editovali vozilo!'); </script>";
			}
			else{
				if(!empty($_FILES["fileToUpload"]["tmp_name"])){
					obrisiSlikuPoId($idUploadovaneSlike);
					unlink($target_file);
				}
				echo "<script> alert('Niste editovali vozilo!'); </script>";
			}
					

		}else{
			echo "Nisu sve vrijednosti postavljene";
		}	
}

function PrikaziStage($id){
	$chips=dajSveChipTuningZaVozilo($id);
	if(!empty($chips))
		$stage1=dajStagePoId($chips[0]["idStage1"]);
		if(!empty($stage1))
			
			echo '<form style="display:inline-block; position:relative; top:0px;" id="dodajStage1" method="POST">
					<label>Stage 1</label></br>
					<input type="hidden" value="'.$stage1["id"].'" name="id1"/>
					<label>Snaga:</label></br>
					<input type="text" name="snaga1" value="'.$stage1["snaga"].'" id="snaga1" oninput="ValidirajStage1(this)"/></br>
					<label>Obrtaji:</label></br>
					<input type="text" name="obrtaji1" value="'.$stage1["obrtaji"].'" id="obrtaji1" oninput="ValidirajStage1(this)"/></br>
					<label>Cijena:</label></br>
					<input type="text" name="cijena1" value="'.$stage1["cijena"].'" id="cijena1"  oninput="ValidirajStage1(this)"/></br>
					<input type="submit" name="submit1" value="submit" id="submit1"/>
				</form>';
			
		$stage2=dajStagePoId($chips[0]["idStage2"]);
		if(!empty($stage2))
			echo '<form style="display:inline-block;  position:relative; top:0px;" id="dodajStage2" method="POST">
					<label>Stage 2</label></br>
					<input type="hidden" value="'.$stage2["id"].'" name="id2"/>
					<label>Snaga:</label></br>
					<input type="text" name="snaga2" value="'.$stage2["snaga"].'" id="snaga2" oninput="ValidirajStage2(this)"/></br>
					<label>Obrtaji:</label></br>
					<input type="text" name="obrtaji2" value="'.$stage2["obrtaji"].'" id="obrtaji2" oninput="ValidirajStage2(this)"/></br>
					<label>Cijena:</label></br>
					<input type="text" name="cijena2" value="'.$stage2["cijena"].'" id="cijena2"  oninput="ValidirajStage2(this)"/></br>
					<input type="submit" name="submit2" value="submit" id="submit2"/>
				</form>';
}

function SaveEditStage(){
	if(isset($_POST["snaga1"])){
		$snaga=htmlspecialchars($_POST["snaga1"]);
		$obrtaji=htmlspecialchars($_POST["obrtaji1"]);
		$cijena=htmlspecialchars($_POST["cijena1"]);
		$id=htmlspecialchars($_POST["id1"]);
	}else {
		$snaga=htmlspecialchars($_POST["snaga2"]);
		$obrtaji=htmlspecialchars($_POST["obrtaji2"]);
		$cijena=htmlspecialchars($_POST["cijena2"]);
		$id=htmlspecialchars($_POST["id2"]);
	}
	if(!empty($snaga) && !empty($obrtaji)){
		
		$stage=new Stage();
		$stage->StageCtor($id,$snaga,$obrtaji,$cijena);
		$idStage= updateStage($stage);

		echo "Uspjesno ste editovali stage!";
	}else{
		echo "Nisu uneseni snaga i obrtaji!";
	}
}

?>
<!--
<div id="poruka" class="msgbox">
	<div class="msgboxTop"><h2 style="border:none;">Poruka</h2></div>
	<div class="msgboxCenter">
		<h4 style="border:none;">Da li zelite obrisati vozilo?</h4>
	</div>
	<div class="msgboxFooter">
		<input type="button" id="msgboxButtonNo" value="Ne" name="Ne"/>
		<input type="button" id="msgboxButtonYes" value="Da" name="Ne"/>
	</div>
</div>
-->

<style>
/*.msgbox{
	margin-left:auto;
	margin-right:auto;
	width:250px;
	height:200px;
	position:absolute;
	top:10%;
	left:30%;
	z-index:1000;
	background:#b1b1b1;;
	border-radius:5%;
	display:none;
}
.msgboxTop{
	width:100%;
	height:15%;
	padding-left:5px;
	paddin-top:5px:
}
.msgboxCenter{
	width:98%;
	height:63%;
	background:aliceblue;
	padding-left:5px;
	padding-top: 5px;

}
.msgboxFooter{
	width:100%;
	height:20%;
}
#msgboxButtonNo{
	float:left;
	margin:5px;
}
#msgboxButtonYes{
	float:right;
	margin:5px;
}
*/


.imgProizvodjaca{
	max-width:70px;
	max-height:70px;
	display:inline-block;
}

.sredina{
	display: inline-block;
    position: relative;
    top: -10px;
}

table{
	border:none;
}
</style>

<script>
function Trazi(button){
	var vrj=button.value;
	if(vrj!=""){
		urlTmp='../php/editVozilo.php';
		var datarow={	
			'search':vrj
		};
		$.ajax({
		   url: urlTmp,
		   type:    'POST',
		   data: datarow,
		 success: function(response){
			$("#centerAdminPanel").html(response);
		 }});
	}
}

function EditujVozilo(idPr){
	urlTmp='../php/editVozilo.php';
	var datarow={
		'idVozila':idPr
	};
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: datarow,
	 success: function(response){
		$("#centerAdminPanel").html(response);
	 }});
	return false;
}

$('#dodajAuto').submit( function( e ) {
		$.ajax( {
		  url: '../php/editVozilo.php',
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
	
/*function dodajStage(id){
	urlTmp='../php/dodajStage.php';
	var datarow={
		'idVozila':id
	};
	$.ajax({
	   url: urlTmp,
	   type:    'GET',
	   data: datarow,
	 success: function(response){
		$("#centerAdminPanel").html(response);
	 }});
	return false;
}*/


//validacija
Check();

function Validiraj(tb){
	if(tb.value=="" || tb.value.length>20){
		addRedBorder(tb);
		$("#submit").attr("disabled","disabled");
	}else{
		removeRedBorder(tb);
	}
}

function ValidirajMotor(tb){
	if(tb.value=="" || tb.value.length>20){
		addRedBorder(tb);
		$("#submit").attr("disabled","disabled");
	}else{
		removeRedBorder(tb);
	}
}

function ValidirajModel(tb){
	if(tb.value=="" || tb.value.length>30){
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
	var prviEl=$("#model").hasClass("redBorder");
	var drugiEl=$("#motor").hasClass("redBorder");
	var cetEl=$("#hp").hasClass("redBorder");
	var petiEl=$("#kw").hasClass("redBorder");
	var sestiEl=$("#snaga").hasClass("redBorder");
	var sedmiEl=$("#obrtaji").hasClass("redBorder");
	var osmiEl=$("#cijena").hasClass("redBorder");
	
	if(!prviEl && !drugiEl && !cetEl && !petiEl && !sestiEl && !sedmiEl && !osmiEl)
		$("#submit").removeAttr("disabled");
}

$('#dodajStage1').submit( function( e ) {
		$.ajax( {
		  url: '../php/editVozilo.php',
		  type: 'POST',
		  data: new FormData(this),
		  processData: false,
		  contentType: false,
		  success:function(response){
			  if(response.indexOf("Uspjesno ste editovali stage!")==-1)
			      alert("Nisu uneseni snaga i obrtaji!");
			  else 
				  alert("Uspjesno ste editovali stage!");
			  
			  $("#submit1").attr("disabled","disabled");
		  }
		});
    e.preventDefault();
});
$('#dodajStage2').submit( function( e ) {
		$.ajax( {
		  url: '../php/editVozilo.php',
		  type: 'POST',
		  data: new FormData(this),
		  processData: false,
		  contentType: false,
		  success:function(response){
			  if(response.indexOf("Uspjesno ste editovali stage!")==-1)
			      alert("Nisu uneseni snaga i obrtaji!");
			  else 
				  alert("Uspjesno ste editovali stage!");
			  $("#submit2").attr("disabled","disabled");
		  }
		});
    e.preventDefault();
});
//validacija
function ValidirajStage1(tb){
	if(tb.value=="" || tb.value.length>=20){
		addRedBorder(tb);
		$("#submit1").attr("disabled","disabled");
	}else{
		removeRedBorderStage(tb);
		CheckStage1();
	}

}

function ValidirajStage2(tb){
	if(tb.value=="" || tb.value.length>=20){
		addRedBorder(tb);
		$("#submit2").attr("disabled","disabled");
	}else{
		removeRedBorderStage(tb);
		CheckStage2();
	}

}

function removeRedBorderStage(tb){
	$(tb).removeClass("redBorder");
}

function CheckStage1(){
	var prviEl=$("#snaga1").hasClass("redBorder");
	var drugiEl=$("#obrtaji1").hasClass("redBorder");
	var treciEl=$("#cijena1").hasClass("redBorder");
	if(!prviEl && !drugiEl && !treciEl)
		$("#submit1").removeAttr("disabled");
}

function CheckStage2(){
	var prviEl=$("#snaga2").hasClass("redBorder");
	var drugiEl=$("#obrtaji2").hasClass("redBorder");
	var treciEl=$("#cijena2").hasClass("redBorder");
	if(!prviEl && !drugiEl && !treciEl)
		$("#submit2").removeAttr("disabled");
}
</script>