<?php
include 'crud.php';
include 'klase.php';
		
if(isset($_POST["imeFoldera"]) && isset($_POST["dodajFolder"])){
	$folder=new Folder();
	$folder->FolderCtor(0,$_POST["imeFoldera"]);
	$id=dodajFolder($folder);

}

function PrikaziFoldere($list){
	for($i=0; $i<count($list); $i++){
		echo '<div class="folderOkolniDiv" onmouseleave="SakrijBrisi(this)" onmouseover="ShowBrisi(this)"><div class="folderDiv" onclick="OtvoriFolderZaSlike('.$list[$i]["id"].')" >';
		PrikaziSlikeUFolderu($list[$i]["id"]); 
		echo '</div><label>'.$list[$i]["imeFoldera"].'</label><div style="display:none;" class="obrisi" onclick="ObrisiFolder('.$list[$i]["id"].')">X</div></div>';
		
	}
}

function PrikaziSlikeUFolderu($idFoldera){
	$list=dajZadnje4likeZaFolder($idFoldera);
	for($i=0; $i<count($list); $i++){
		if($list[$i]["jelVideo"]==1)
			echo '<img class="slikaUFolderu" alt src="../images/video.png" />';
		else 
			echo '<img class="slikaUFolderu" alt src="'.$list[$i]["path"].'" />';
	}
}

function PrikaziSlikeBezFoldera(){
	$list=dajSveSlikeZaFolder(0);
	if(!empty($list)){
		for($i=0; $i<count($list); $i++){
			if($list[$i]["jelVideo"]==1)
				echo '<div class="slikeBezFolderaDiv" onmouseleave="SakrijBrisi(this)" onmouseover="ShowBrisi(this)" onclick="pustiVideo(&quot;'.$list[$i]["path"].'&quot;)" >
				<img class="slikeBezFoldera" alt src="../images/video.png" /><div style="display:none; top:0px; left:-15px;" class="obrisi" onclick="ObrisiSliku('.$list[$i]["id"].')">X</div></div>';
			else 
				echo '<div class="slikeBezFolderaDiv" onmouseleave="SakrijBrisi(this)" onmouseover="ShowBrisi(this)"><img class="slikeBezFoldera" alt src="'.$list[$i]["path"].'" /><div style="display:none; top:0px; left:-15px;" class="obrisi" onclick="ObrisiSliku('.$list[$i]["id"].')">X</div></div>';
		}
	}
}

/*if (isset($_FILES["file"]["name"])) {

    $name = $_FILES["file"]["name"];
    $tmp_name = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];

    if (!empty($name)) {
        $location = '../uploads/galerija/';

        if  (move_uploaded_file($tmp_name, $location.$name)){
            echo 'Uploaded';
        }

    } else {
        echo 'please choose a file';
    }
}*/
?>




<style>
#folderi{
	height:200px;
	max-width:100%;
}
.folderOkolniDiv{
	width: 100px;
    height: 100px;
    float: left;
    margin: 5px;
}
.folderDiv{
	width:100px;
	height:100px;
	float:left;
	border: 1px solid black;
    margin: 2px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
div.folderDiv:hover{
	border:2px solid red;
	cursor:pointer;
}
.folderDiv label{
	position:relative;
	top:100%;
}

.slikaUFolderu{
	width:48px;
	height:48px;
	padding:1px;
}
#obicneSlike{
	max-height:100%;
	max-width:100%;
	
}

#dodajFolderDiv{
	height:200px;
	width:200px;
	position: absolute;
	top:10px;
	left:40%;
	background:#b51010;;
	padding:5px;
	display:none;
	border-radius:5%;
	color: white;
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
#submitDodajFolderDiv{
	position:relative;
	top:50%;
	float:right;
}

#izadjiDodajFolderDiv{
	position:relative;
	top:50%;
	float:left;
}

#dodajSlikuDiv{
	height:  230px;
    width: 400px;
	position: absolute;
	top:10px;
	left:40%;
	background:#b51010;;
	padding:5px;
	display:none;
	color: white;
	border-radius:5%;
	
}
#submitDodajSlikuDiv{
	float:right;
}

#izadjiDodajSlikuDiv{
	float:left;
}
#buttoniDodajSliku{
	position:relative;
	top: 45px;
}
.slikeBezFoldera{
	max-width:100px;
	max-height:100px;
}
.slikeBezFoldera:hover{
	border:2px solid red;
	cursor:pointer;
}
.slikeBezFolderaDiv{
	width:100px;
	height:100px;
	margin:5px;
	float:left;
	display:flex;
}
/*div.slikeBezFolderaDiv:hover{
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
	float: right;
}
</style>

<div id="folderi">
<?php PrikaziFoldere(dajSveFoldere());  ?>
<input style="margin:5px; cursor:pointer;" class="folderDiv" type="button" value="Dodaj folder" onclick="DodajFolder()"/>
</div>


<div id="obicneSlike">
<?php PrikaziSlikeBezFoldera(); ?>
<input style="width:100px; height:100px;" class="slikeBezFolderaDiv" type="button" value="Dodaj Sliku" onclick="DodajSliku()"/>
</div>


<div id="dodajFolderDiv">
	<div class="vrhDodajDiv">
		<h4>Dodaj novi folder</h4>
	</div>
	<div class="sredinaDodajDiv">
		<label>Ime foldera:</label></br>
		<input name="dodajFolder" id="dodajFolder" placeholder="Ime foldera" type="text" value="" oninput="ValidacijaImenaFoldera(this)" /></br>
	</div>
	<div class="dnoDodajDiv">
		<input type="button" value="Izadji" id="izadjiDodajFolderDiv"/>
		<input type="button" value="Dodaj" id="submitDodajFolderDiv" disabled="disabled"/>
	</div>
</div>

<div id="dodajSlikuDiv">
	<div class="vrhDodajDiv">
		<h4>Dodaj novu sliku bez foldera</h4>
	</div>
	<div class="sredinaDodajDiv"> 
		<div id="poruke"></div>
		<form id="dodajSlikuForm" method="post" enctype="multipart/form-data">
			<label>Odaberite sliku za upload:</label></br></br>
			<input type="file" name="fileToUpload" id="fileToUpload"/></br></br>
			<input type="checkbox" name="video" id="video"/>Video 
			<div id="buttoniDodajSliku">
				<input type="button" value="Izadji" id="izadjiDodajSlikuDiv"/>		
				<input type="submit" value="submit" id="submitDodajSlikuDiv" disabled="disabled" name="submit"/>
			</div>
		</form>
	</div>
	<div class="dnoDodajDiv"></div>
</div>

<div id="porukaFolder" class="msgbox">
	<div class="msgboxTop"><h2 style="border:none;">Poruka</h2></div>
	<div class="msgboxCenter">
		<h4 style="border:none;">Da li ste sigurni da zelite obrisati folder?</h4>
		<label>Sve slike u ovom folderu ce biti obrisane!</label>
	</div>
	<div class="msgboxFooter">
		<input type="button" class="msgboxButtonNo" id="msgboxFolderButtonNo" value="Ne" name="Ne"/>
		<input type="button" class="msgboxButtonYes" id="msgboxFolderButtonYes" value="Da" name="Ne"/>
	</div>
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
</video>'
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

$("#izadjiDodajFolderDiv").click(function (){
	$("#dodajFolder").val("");
	$("#dodajFolderDiv").hide();
	$("#submitDodajFolderDiv").attr("disabled","disabled");
});

$("#submitDodajFolderDiv").click(function (){
	urlTmp='../php/galerija.php';
	var datarow={
		'imeFoldera':$("#dodajFolder").val(),
		'dodajFolder':"true"
	};
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: datarow,
	 success: function(response){
		 $("#dodajFolderDiv").hide();
		 $("#centerAdminPanel").html(response);
	 }});
	return false;
});


function DodajFolder(){
	$("#dodajFolderDiv").show();
	$("#dodajFolder").addClass("redBorder");
}

function ObrisiFolder(id){
	$("#porukaFolder").show();
	$("#msgboxFolderButtonYes").attr("name",id);
}

$("#msgboxFolderButtonYes").click(function(){
	var vrj=$("#msgboxFolderButtonYes").attr("name");
	if(vrj!="Ne"){
		urlTmp='../php/obrisiSlikuFolder.php';
		var datarow={	
			'idFoldera':vrj
		};
		$.ajax({
		   url: urlTmp,
		   type:    'POST',
		   data: datarow,
		 success: function(response){
			$("#centerAdminPanel").html(response);
			editujGaleriju();
		 }});
	}
});

$("#msgboxFolderButtonNo").click(function(){
	$("#porukaFolder").hide();
	$("#msgboxFolderButtonYes").attr("name","Ne");
});

$("#izadjiDodajSlikuDiv").click(function (){
	$("#poruke").html("");
	$("fileToUpload").val("");
	$("#dodajSlikuDiv").hide();
	urlTmp='../php/galerija.php';
	$.ajax({
	   url: urlTmp,
	   type:    'GET',
	 success: function(response){
		$("#centerAdminPanel").html(response);
		$("#fileToUpload").removeClass("redBorder");
	 }});
	return false;
});

$('#dodajSlikuForm').submit( function( e ) {	
	$("#load").show();
	$.ajax({
		url: '../php/upload.php',
		type: 'POST',
		data:  new FormData(this),
		processData: false,
		contentType: false,
		success:function(response){			
		    $("#load").hide();
			$("#poruke").html(response);
			$("#fileToUpload").removeClass("redBorder");
		}
	});
	e.preventDefault();
});

function DodajSliku(){
	$("#dodajSlikuDiv").show();
	$("#fileToUpload").addClass("redBorder");
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
			editujGaleriju();
		 }});
	}
});

$("#msgboxSlikaButtonNo").click(function(){
	$("#porukaSlika").hide();
	$("#msgboxSlikaButtonYes").attr("name","Ne");
});

function ShowBrisi(div){
	$(div).find(".obrisi").show();
}

function SakrijBrisi(div){
	$(div).find(".obrisi").hide();	
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

function editujGaleriju(){
	urlTmp='../php/galerija.php';
	var datarow={	};
	$.ajax({
	   url: urlTmp,
	   type:    'GET',
	   data: datarow,
	 success: function(response){
		$("#centerAdminPanel").html(response);
	 }});
	return false;
}

//validacija
 $("input:file").change(function (){
	var fileName = $(this).val();
	if(fileName!=null)
		removeRedBorder(this);		
	else 
		addRedBorder(this);
	
});

function ValidacijaImenaFoldera(tb){
	if(tb.value=="" || tb.value.length>45){
		addRedBorder(tb);
		$("#submitDodajFolderDiv").attr("disabled","disabled");
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
	var visibleFolderDiv=$("#dodajFolderDiv").is(':visible');
	var visibleSlikaDiv=$("#dodajSlikuDiv").is(':visible');
	if(visibleSlikaDiv){
		var treciEl=$("#fileToUpload").hasClass("redBorder");
		if(!treciEl)
			$("#submitDodajSlikuDiv").removeAttr("disabled");
	}
	if(visibleFolderDiv){
		var prviEl=$("#dodajFolder").hasClass("redBorder");
		if(!prviEl)
			$("#submitDodajFolderDiv").removeAttr("disabled");
	}
}
</script>