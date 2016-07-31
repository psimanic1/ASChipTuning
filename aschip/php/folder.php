<?php
include 'crud.php';
include 'klase.php';

if( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idFoldera"]) && isset($_POST["submit"])){
	if(!empty($_FILES["fileToUpload"]["name"])){
		$folder=dajFolderPoId($_POST["idFoldera"]);
		$target_dir = "../uploads/galerija/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$video=0;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		/*if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				echo "Fajl nije slika ili video.";
				$uploadOk = 0;
			}
		}*/

		//povecati velicinu fajla ovo je 50Mb
		if ($_FILES["fileToUpload"]["size"] > 50000000) {
			echo "Fajl je prevelik, mora biti manji od 50MB!";
			$uploadOk = 0;
		}
		
		if(isset($_POST['video'])){
			$video=1;
		}
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"  && $imageFileType!="mp4") {
			if($video==1 && !($imageFileType=="mp4")){
				//treba vidjeti koje kodeke podrzava i kako ih predstaviti
				echo "Samo MP4 fajlovi su dozvoljeni.";
			}
			if($video==0 && !($imageFileType=="png" || $imageFileType=="jpeg" || $imageFileType=="gif")){		
				echo "Samo JPG, JPEG, PNG & GIF fajlovi su dozvoljeni.";
			}
			$uploadOk = 0;
		}
		
		if ($uploadOk == 0) {
			echo "Greska prilikom dodavanja slike.";
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				
				$slika=new Slika();
				$slika->SlikaCtor(0,$target_file,$video,$folder["id"]);
				$id=dodajSliku($slika);
				echo "Uspjesno ste dodali sliku;";
			} else {
				echo "Greska prilikom dodavanja slike.";
			}
		}
	}else{
		echo "Niste odabrali sliku!";
	}
	
	
}

function PrikaziSlikeUFolderu($idFoldera){
	$list=dajSveSlikeZaFolder($idFoldera);
	for($i=0; $i<count($list); $i++){
		if($list[$i]["jelVideo"]=="1"){
			echo '<div class="slikeUFolderuDiv" onmouseleave="SakrijBrisi(this)" onmouseover="ShowBrisi(this)" onclick="pustiVideo(&quot;'.$list[$i]["path"].'&quot;)" >
		        <img style="width:100%; height:100%;" class="slikeUFolderu" alt src="../images/video.png" />
				<div style="display:none; top:0px; left:-15px;" class="obrisi" onclick="ObrisiSliku('.$list[$i]["id"].')">X</div></div>';
		}else 
			echo '<div class="slikeUFolderuDiv" onmouseleave="SakrijBrisi(this)" onmouseover="ShowBrisi(this)"><img style="width:100%; height:100%;" class="slikeUFolderu" alt src="'.$list[$i]["path"].'" /><div style="display:none; top:0px; left:-15px;" class="obrisi" onclick="ObrisiSliku('.$list[$i]["id"].')">X</div>
			<div class="listaPozicija"><div class="kvadratic" onclick="StaviSliku('.$list[$i]["id"].',1)">1</div><div class="kvadratic" onclick="StaviSliku('.$list[$i]["id"].',2)">2</div><div class="kvadratic" onclick="StaviSliku('.$list[$i]["id"].',3)">3</div><div class="kvadratic" onclick="StaviSliku('.$list[$i]["id"].',4)">4</div></div>
			</div>';
	}
}

?>



<style>
.listaPozicija{
    height: 20px;
    width: 50px;
    z-index: 100;
    position: relative;
    top: 76px;
    left: -113px;
	display:none;
}

.kvadratic{
	display: inline;
    height: 10px;
    width: 20px;
    border: 1px solid #ae2b2b;
    margin: 3px;
    padding: 5px;
	cursor: pointer;
	color: white;
}

#obicneSlike{
	height:200px;
}
.sredinaDodajDiv{
	height: 120px;
    background: #bfbdbd;
    padding: 5px;
    border-radius: 5%;
    color: #910000;
}
.dnoDodajDiv{
	height:10%;
}

#dodajSlikuDiv{
	height:  230px;
    width: 400px;
	background:#b51010;;
	padding:5px;
	display:none;
	color: white;
	border-radius:5%;
	position: absolute;
    top: 10px;
}
#submitDodajSlikuDiv{
	float:right;
}

#buttoniDodajSliku{
	position:relative;
	top: 45px;
}
#ponisti{
	position:relative;
	top: 45px;
}
#izadjiDodajSlikuDiv{
	float:left;	
}

.slikeUFolderu{
	max-width:100px;
	max-height:100px;
}
.slikeBezFoldera:hover{
	border:2px solid red;
	cursor:pointer;
}
.slikeUFolderuDiv{
	width:100px;
	height:100px;
	margin:2px;
	float:left;
	display:flex;
}
/*div.slikeUFolderuDiv:hover{
	border:2px solid red;
	cursor:pointer;
}*/
#poruke{
	height:20px;
}

.obrisi{
	position: relative;
    top: -120px;
    left: 90px;
    color: red;
    width: 10px;
	height:10px;
    font-size: medium;
    cursor: default;
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

#playVideo{
    position: absolute;
    top: 20%;
    z-index: 10000;
    background: grey;
    width: 500px;
    height: 300px;
    border-radius: 5%;
	display:none;
}
#playVideo video{
    margin: 24px;
    width: 400px;
    left: 20px;
    position: relative;
}
#izadjiIzVidea{
	float:right;
</style>
<div id="poruke"></div>
<div id="dodajSlikuDiv">
	<div class="vrhDodajDiv">
		<h4>Dodaj novu sliku bez foldera</h4>
	</div>
	<div class="sredinaDodajDiv"> 
		
		<form id="dodajSlikuForm" method="post" enctype="multipart/form-data">
			<label>Odaberite sliku za upload:</label></br></br>
			<input type="hidden" name="idFoldera" id="idFoldera" value="<?php if(isset($_POST["idFoldera"])) echo $_POST["idFoldera"]; ?>"/>
			<input type="file" name="fileToUpload" id="fileToUpload"/></br></br>
			<input type="checkbox" name="video" id="video"/>Video 
			<div id="ponisti">
				<input type="button" value="Izadji" id="izadjiDodajSlikuDiv" />
			</div>
			<div id="buttoniDodajSliku">
				<input type="submit" value="Submit" id="submitDodajSlikuDiv" disabled="disabled" name="submit"/>
			</div>
		</form>
	</div>
	<div class="dnoDodajDiv"></div>
</div>

<div id="obicneSlike">
<?php 
if(isset($_POST["idFoldera"]))
	PrikaziSlikeUFolderu($_POST["idFoldera"]); 
?>
<input style="width:100px; height:100px;" class="slikeBezFolderaDiv" type="button" value="Dodaj Sliku" onclick="DodajSliku()"/>
</div>


<div id="porukaSlika" class="msgbox">
	<div class="msgboxTop"><h2 style="border:none;">Poruka</h2></div>
	<div class="msgboxCenter">
		<h4 style="border:none;">Da li ste sigurni da zelite obrisati sliku?</h4>
	</div>
	<div class="msgboxFooter">
		<input type="button" class="msgboxButtonNo" id="msgboxSlikaButtonNo" value="Ne" name="Ne"/>
		<input type="button" class="msgboxButtonYes" id="msgboxSlikaButtonYes" value="Da" name="Ne"/>
	</div>
</div>
<div style="display:none;" id="load"><img alt="load" src="../images/loading.gif"/></div>

<div id="playVideo">
<video id="videoPlayer" width="320" height="240" controls="">
	<source id="videoPath" src="" type="video/mp4">
	Your browser does not support the video tag.
</video>
<input type="button" id="izadjiIzVidea" value="Izadji"/>
</div>

<script>
function pustiVideo(path){
	var player = document.getElementById('videoPlayer');
	var mp4Vid = document.getElementById('videoPath');

	player.pause();
	mp4Vid.src = path;

	player.load();
	player.play();
	$("#playVideo").show();
}

$("#izadjiIzVidea").click(function(){
	var player = document.getElementById('videoPlayer');
	player.pause();
	$("#playVideo").hide();
});


$('#dodajSlikuForm').submit( function( e ) {
	$("#load").show();
	$.ajax({
		url: '../php/folder.php',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success:function(response){			
		    $("#load").hide();
			$("#centerAdminPanel").html(response);
			$("#dodajSlikuDiv").hide();
		}
	});
	$("#dodajSlikuDiv").hide();
	e.preventDefault();
});

$("#izadjiDodajSlikuDiv").click(function(){
	$("#dodajSlikuDiv").hide();
	$("#fileToUpload").val("");
	$("#fileToUpload").addClass("redBorder");
	$("#submit").attr("disabled","disabled");
});

function DodajSliku(){
	$("#dodajSlikuDiv").show();
}

function ObrisiSliku(id){
	$("#porukaSlika").show();
	$("#msgboxSlikaButtonYes").attr("name",id);
}

$("#msgboxSlikaButtonYes").click(function(){
	var vrj=$("#msgboxSlikaButtonYes").attr("name");
	if(vrj!="Ne"){
		urlTmp='../php/obrisiSlikuFolder.php';
		var datarow={	
			'idSlike':vrj
		};
		$.ajax({
		   url: urlTmp,
		   type:    'POST',
		   data: datarow,
		 success: function(response){
			$("#centerAdminPanel").html(response);
			var id= <?php echo $_POST["idFoldera"]; ?>;
			OtvoriFolderZaSlike(id);
		 }});
	}
});

$("#msgboxSlikaButtonNo").click(function(){
	$("#porukaSlika").hide();
	$("#msgboxSlikaButtonYes").attr("name","Ne");
});

function ShowBrisi(div){
	$(div).find(".obrisi").show();
	$(div).find(".listaPozicija").show();
}

function SakrijBrisi(div){
	$(div).find(".obrisi").hide();	
	$(div).find(".listaPozicija").hide();
}

$(".kvadratic").mouseover(function(e){
	var ovo=$(e.target);
	ovo.css("background","red");
});

$(".kvadratic").mouseleave(function(e){
	var ovo=$(e.target);
	ovo.css("background","transparent");
});

function StaviSliku(idSlike, broj){
	urlTmp='../php/updatePozicije.php';
	var datarow={
		'id':idSlike,
		'pozicija':broj
	};
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: datarow,
	 success: function(response){
		if(response.indexOf("Slika je uspjesno postavljenja!")!=-1){
			alert("Uspjesno ste dodali sliku na pocetnu stranicu!");
		}
	 }});
	return false;
}

function OtvoriFolderZaSlike(id){
	urlTmp='../php/folder.php';
	var datarow={
		'idFoldera':id
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



//validacija
$("#fileToUpload").addClass("redBorder");

 $("input:file").change(function (){
	var fileName = $(this).val();
	if(fileName!=null)
		removeRedBorder(this);		
	else 
		addRedBorder(this);
	
});

function addRedBorder(tb){
	$(tb).addClass("redBorder");
}

function removeRedBorder(tb){
	$(tb).removeClass("redBorder");
	Check();
}

function Check(){
	var treciEl=$("#fileToUpload").hasClass("redBorder");
	if(!treciEl)
		$("#submitDodajSlikuDiv").removeAttr("disabled");
}
</script>