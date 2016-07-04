<?php
include 'crud.php';
include 'klase.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['username']) && isset($_POST['naslov'])){
	$naslov=htmlspecialchars($_POST['naslov']);
	$tekst=htmlspecialchars($_POST['tekstualno']);
	$idNovosti=$_POST["idNovosti"];
	
	if(!empty($_POST['naslov']) && !empty($_POST['tekstualno']) && !empty($_POST["idNovosti"])){
		if($_POST["idSlike"]==0){

			$idUploadovaneSlike=0;
			$target_dir = "../uploads/novosti/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$video=0;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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
					//idFoldera je 3 jer su tu slike za novosti
					$slika->SlikaCtor(0,$target_file,$video,3);
					$idUploadovaneSlike=dodajSliku($slika);
					
					if($idUploadovaneSlike!=0){						
						$novost=new Novost();
						$novost->NovostCtor($idNovosti,$naslov,$tekst,$idUploadovaneSlike);
						$id=editujNovost($novost);
						
						if($id!=0){ 
							echo "<script> alert('Uspjesno ste dodali novost!'); </script>";
						}
						else{
							obrisiSlikuPoId($idUploadovaneSlike);
							unlink($target_file);
							echo "<script> alert('Niste dodali novost!'); </script>";
						}
					}			
				} else {
					echo "Greska prilikom dodavanja slike.";
				}
			}
		}else{
			$novost=new Novost();
			$novost->NovostCtor($idNovosti,$naslov,$tekst,$_POST["idSlike"]);
			$id=editujNovost($novost);
			
			if($id!=0){ 
				echo "<script> alert('Uspjesno ste dodali novost!'); </script>";
			}else{
				echo "<script> alert('Niste dodali novost!'); </script>";		
			}
		}
	
		echo "Uspjesno ste editovali novost!";
	}
	else{
		echo "Niste popunili sva polja!";
	}
}

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['username']) && isset($_POST["idNovosti"])){
	if(obrisiNovostPoId($_POST["idNovosti"]))
		echo "Novost je uspjesno obrisana!";
	else 
		echo "Novost nije obrisana!";
}

PrikaziNovosti(dajZadnjih10Novosti());

function PrikaziNovosti($list){
	for($i=0; $i<count($list); $i++){
		echo '<div class="novosti" onmouseover="Prikazi(this)" onmouseleave="Sakrij(this)"> 
				<h2>'.$list[$i]["naslov"].'</h2><div style="display:none;" class="obrisi" onclick="Obrisi('.$list[$i]["id"].')">X</div><div style="display:none;" class="edit" onclick="Edituj('.$list[$i]["id"].')">Edit</div>
				<div class="vrijeme"> Novost objavljena '.$list[$i]["datumObjave"].'.</div>
				<div class="novost">
					<img class="slikaNovosti" src="'.dajSlikuPoId($list[$i]["idSlike"])["path"].'" alt="0"/>
					<p class="paragrafNovosti">'.$list[$i]["tekst"].'</p>
				</div>
			</div>';
	}
	echo '<input type="button" value="Ucitaj jos novosti!" id="loadMore" onclick="LoadMore()"/>';
}
?>

<style>
.edit{
	position: relative;
    top: -35px; 
    color: red;
    width: 30px;
    height: 20px;
    font-size: medium;
    cursor: pointer;
    float: right;
}
.obrisi{
    position: relative;
    top: -35px;
    color: red;
    width: 15px;
    height: 20px;
    font-size: medium;
    cursor: pointer;
    float: right;
	margin-left: 10px;
}
.novost{
	padding: 5px;
}

.vrijeme{
	font-size:10px;
	margin-left:5px;
}

.slikaNovosti{
	width:200px;
	height:100px;
	display:inline-block;
	border-radius: 15%;
	vertical-align:top;
}

.paragrafNovosti{
	display:inline-block;
	width:40%;
	margin-left:5px;
    font-size: 100%;
	margin-top: -5px;
	font-size:15px;
	font-family:'Lora';
	font-style:italic;
}

.msgbox{
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
.msgboxButtonNo{
	float:left;
	margin:5px;
}
.msgboxButtonYes{
	float:right;
	margin:5px;
}

#inputTextEditorEditNovost{
	width: 295px;
}

#divForm{
	background:red;
	height:375px;
	width:500px;
	border-radius:5%;
	padding:5px;
	color:white;
	position: absolute;
    top: 10px;
    z-index: 1000;
	display:none;
}

#topForm{
	height:30px;
	margin:5px;
}

#formaEdit{
	background:grey;
	padding:5px;
}

#MultilineEditorEditNovost{
	width: 295px;
	max-width:485px;
	max-height:100px;
}

#formaEditBbtObjavi{
	margin-top: 25px;
	float: right;
}

#formaEditBbtPonisti{
	margin-top: 25px;
	float: left;
}
</style>

<div id="divForm">
	<div id="topForm">
		<h3>Editovanje novosti</h3>
	</div>
	<form id="formaEdit" method="Post" enctype="multipart/form-data">
		<div>
			<input type="hidden" value="" id="idNovosti" name="idNovosti"/>
			<input type="hidden" value="" id="idSlike" name="idSlike"/>
			<p>Naslov:</p>
			<input id="inputTextEditorEditNovost" type="text" oninput="ValidirajNaslov(this)" value="" name="naslov"/>
			<p>Tekst:</p>
			<textarea id="MultilineEditorEditNovost" name="tekstualno" oninput="ValidirajTekst(this)" value="" cols="40" rows="5"></textarea>
			<br/>
			<label>Izaberite drugu sliku:<label></br>
			<br>
			<input type="file" name="fileToUpload" id="fileToUpload" onclick="DodavanjeSlike()"/>
		</div>
		<div id="formaEditBbtPonisti">
			<input type="button" name="izadji" onclick="IzadjiIzNovosti()" value="Ponisti"/>
		</div>
		<div id="formaEditBbtObjavi">				
			<input type="submit" name="objavi" value="Objavi novost" id="submit"/>
		</div>	
	</form>	
</div>


<div id="poruka" class="msgbox">
	<div class="msgboxTop"><h2 style="border:none;">Poruka</h2></div>
	<div class="msgboxCenter">
		<h4 style="border:none;">Da li ste sigurni da zelite obrisati novost?</h4>
	</div>
	<div class="msgboxFooter">
		<input type="button" class="msgboxButtonNo" id="msgboxButtonNo" value="Ne" name="Ne"/>
		<input type="button" class="msgboxButtonYes" id="msgboxButtonYes" value="Da" name="Ne"/>
	</div>
</div>


<script>
function LoadMore(){
	var br=$(".novosti").length;
	
	urlTmp='../php/loadMoreNovosti.php';
	var datarow={	
			'brNovosti':br
		};
		$.ajax({
		   url: urlTmp,
		   type:    'POST',
		   data: datarow,
		 success: function(response){
			$(response).insertBefore("#loadMore");
		 }});
}

function Prikazi(div){
	$(div).find(".obrisi").show();
	$(div).find(".edit").show();
}

function Sakrij(div){
	$(div).find(".obrisi").hide();
	$(div).find(".edit").hide();
}

function Obrisi(id){
	$("#poruka").show();
	$("#msgboxButtonYes").attr("name",id);
}

$("#msgboxButtonYes").click(function(){
	var vrj=$("#msgboxButtonYes").attr("name");
	if(vrj!="Ne"){
		urlTmp='../php/editujNovosti.php';
		var datarow={	
			'idNovosti':vrj
		};
		$.ajax({
		   url: urlTmp,
		   type:    'POST',
		   data: datarow,
		 success: function(response){
			$("#centerAdminPanel").html(response);
		 }});
	}
});

$("#msgboxButtonNo").click(function(){
	$("#poruka").hide();
	$("#msgboxButtonYes").attr("name","Ne");
});

function Edituj(id){
	$("#divForm").show();
	urlTmp='../php/dajNovost.php';
		var datarow={	
			'idNovosti':id
		};
		$.ajax({
		   url: urlTmp,
		   type:    'POST',
		   data: datarow,
		 success: function(response){
			$("#MultilineEditorEditNovost").val(response["tekst"]);
			$("#inputTextEditorEditNovost").val(response["naslov"]);
			$("#idNovosti").val(id);
			$("#idSlike").val(response["idSlike"]);
		 }});
}

function IzadjiIzNovosti(){
	$("#MultilineEditorEditNovost").val("");
	$("#inputTextEditorEditNovost").val("");
	$("#idNovosti").val("");
	$("#idSlike").val("");
	$("#divForm").hide();
}

function DodavanjeSlike(){
	$("#idSlike").val("0");
}

$('#formaEdit').submit( function( e ) {
	$.ajax({
		url: '../php/editujNovosti.php',
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

function ValidirajNaslov(tb){
	var reg=/\w{2}/i;
	if(!reg.test(tb.value)){
		addRedBorder(tb);
		$("#submit").attr("disabled","disabled");
	}else{
		removeRedBorder(tb);
	}
}

function ValidirajTekst(tb){
	var reg=/\w{2}/i;
	if(!reg.test(tb.value)){
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
	var prviEl=$("#inputTextEditorObjaviNovost").hasClass("redBorder");
	var drugiEl=$("#MultilineEditorObjaviNovost").hasClass("redBorder");
	var treciEl=$("#fileToUpload").hasClass("redBorder");
	if(!prviEl && !drugiEl && !treciEl)
		$("#submit").removeAttr("disabled");
}
</script>