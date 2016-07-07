<!DOCTYPE html>
<!--
Template Name: PlusBusiness
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<?php 
session_start(); 
include '../php/crud.php';

function PrikaziFoldere($list){
	for($i=0; $i<count($list); $i++){
		echo '<div class="folderVanDiv" onclick="PrikaziFullScree('.$list[$i]["id"].')" onmouseenter="PrikaziSlide('.$list[$i]["id"].')"><div class="folderOkolniDiv">
				<div class="folderDiv">';
					PrikaziSlikeUFolderu($list[$i]["id"]); 
		echo 	'</div>
				<div class="desc">'.$list[$i]["imeFoldera"].'</div>
			</div></div>';
	}
}

function PrikaziSlikeUFolderu($idFoldera){
	$list=dajZadnje4likeZaFolder($idFoldera);
	for($i=0; $i<count($list); $i++){
		echo '<img class="slikaUFolderu" alt src="'.$list[$i]["path"].'" />';
		
	}
}

function PrikaziSlikeBezFoldera(){
	$list=dajSveSlikeZaFolder(0);
	if(!empty($list)){
		echo '<div class="folderVanDiv" onclick="PrikaziFullScree(0)"><div class="folderOkolniDiv" onmouseenter="PrikaziSlide(0)">
				<div class="folderDiv">';
			PrikaziSlikeUFolderu(0);
		echo 	'</div>
				<div class="desc">Ostale slike</div>
			</div></div>';
	}
}
?>
<html>
<head>
<style>
div.img {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
}

div.img:hover {
    border: 2px solid red;
}

div.img img {
    width: 100%;
    height: auto;
}

#folderiSlika{
	width:60%;
	height:100%;
	display: inline-block;
	vertical-align: top;
    min-height: 500px;
}

#slideShow{
	width:39%;
	height:100%;
	display: inline-block;
	position:fixed;
	top:294px;
}


.folderVanDiv{
	width: 182px;
    height: 142px;
	float: left;
    margin: 8px;
    margin-left: 0px;
}

.folderOkolniDiv{
	height: 100%;
    border: 1px solid black;
    width: 100%;
}
.folderDiv{
	width: 174px;
    height: 100px;
    float: left;
    border: 1px solid #ccc;
    margin: 2px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

div.folderOkolniDiv:hover{
	border:2px solid red;
	cursor:pointer;
}

.slikaUFolderu{
	width:48%;
	height:48%;
	padding:1px;
}
div.desc {
    padding: 15px;
    text-align: center;
}



#slider {
	background:#000;
	border:5px solid #eaeaea;
	box-shadow:1px 1px 5px rgba(0,0,0,0.7);
	height:320px;
	/*width:680px;*/
	width: 380px;
	margin:40px auto 0;
	overflow:visible;
	position:relative;
}
.containerSlide{
	position:relative;
	width:100%;
	height:300px;
	border-radius:5px;
	border:1px solid red;
	overflow:hidden;
}

</style>
<title>AS Chip tuning</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../layout/styles/layout.css" type="text/css" />
<link rel="stylesheet" href="../layout/styles/login.css" type="text/css" />
<script type="text/javascript" src="../layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="../layout/scripts/login.js"></script>
</head>
<body id="top">
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <h1><a href="..\index.php"><img src="../images/logo.png" width=200; height=80;></a></h1>
    </div>
    <div id="topnav">
      <ul>
        <li><a href="..\index.php">Home</a></li>
        <li><a href="style-demo.php">Kontakt</a></li>
        <li><a href="full-width.php">Chip tuning</a></li>
        <li><a href="Katalog.php">Katalog</a>
          <ul>
            <li><a href="AMK.php?tip=Auto">Auta</a></li>
            <li><a href="AMK.php?tip=Kamion">Kamioni</a></li>
            <li><a href="AMK.php?tip=Motor">Motori</a></li>
          </ul>
        </li>
		<li class="active"><a href="Galerija.php">Galerija</a></li>
        <li class="last"><a href="Novosti.php">Novosti</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      <li class="first"><p>Mob: 061/552-336 --- Mob: 061/815-816 | info@aschiptuning.com</p></li>
      <a href="https://www.facebook.com/ASchiptuning/?fref=ts"><img src="../images/fb.png"></a>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    <div id="homepage">	
		<div id="folderiSlika">
		<?php
			PrikaziFoldere(dajSveFoldere());  
			PrikaziSlikeBezFoldera();
		?>
		</div>
		<div id="slideShow">
			<div id="content-slider">
				<div id="imslider">
					
					<div id="imgGallary" class="containerSlide">
						<img src="../images/r32.jpg" alt="" width="100%" height="300" />
					</div>
				</div>
			</div>
		</div>

    </div> 
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="footer">
    <div class="box1">
      <h2>Sjedište tuning kuće</h2>
      <ul>
        <li>AS Chip tuning</li>
        <li>Adema Buće 234</li>
        <li>Sarajevo</li>
        <li>71000</li>
        <li>Tel: +38761/552-336</li>
        <li>Email: digitalmotiv@gmail.com</li>
        <li class="last">Facebook: <a href="https://www.facebook.com/ASchiptuning/?fref=ts">AS Chip Tuning</a></li>
      </ul>
    </div>
    
    <div class="box flickrbox">
      <h2>Posljednje slike u galeriji!</h2>
      <div class="wrap">
        <div class="fix"></div>
        <div id="sestSlika">
        </div>
        <div class="fix"></div>
      </div>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col5">
  <div id="copyright">
    <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="http://www.etermini.com">eTermini team</a></p>
	
	<?php
	if(empty($_SESSION['username'])){
	?>
		<p id="loginFooter" class="fl_right"><a href="#" onclick="UcitajFormu()"><b>Admin LogIn</b></a></p>
	
	<?php
	}else{
		?>
		<form method="post">
			<p class="fl_right"><a href="#" onclick="return SubmitLogout()"><b>Admin LogOut</b></a></p>
			<p style="margin-right: 20px;" class="fl_right"><a href="adminPanel.php"><b>Admin Panel</b></a></p>
		</form>
		
	<?php	
	}
	?>
    <br class="clear" />
  </div>
</div>

<div id="loginDiv"></div>

<script>
$(document).ready(function(){
$.ajax({
	  url: '../php/ucitajPosljednjih6Slika.php',
	  type: 'GET',
	  success:function(response){
		  $("#sestSlika").html(response);
	  }
	});
});

function PrikaziSlide(id){
	var datarow={
		'idFoldera':id
	};
	$.ajax({
		data:datarow,	
		url: '../php/dajSlikeZaFolder.php',
		type: 'GET',
		success:function(response){
			$("#imgGallary").html(response);
		}
	});	
}

function PrikaziFullScree(idFoldera){
	var datarow={
		'idFoldera':idFoldera
	};
	$.ajax({
		data:datarow,	
		url: '../php/prikazSlikaUGaleriji.php',
		type: 'POST',
		success:function(response){
			$("#homepage").html(response);
		}
	});
}

(function(){
	var imgLen = document.getElementById('imgGallary');
	var images = imgLen.getElementsByTagName('img');
	var counter = 1;

	if(counter <= images.length){
		setInterval(function(){
			images[0].src = images[counter].src;
			//console.log(images[counter].src);
			counter++;

			if(counter === images.length){
				counter = 1;
			}
		},4000);
	}
})();

$(window).scroll(function (e) {
    var target = e.currentTarget,
        scrollTop = target.scrollTop || window.pageYOffset,
        scrollHeight = target.scrollHeight || document.body.scrollHeight;
	var val=$(target).innerHeight()+300;
	var val2=scrollHeight - scrollTop;
	if (val2-val < 40) {
		$("#slideShow").css("top","10px");
    }else if (val2-val < 60) {
		$("#slideShow").css("top","50px");
    }else if (val2-val < 80) {
		$("#slideShow").css("top","60px");
    }else if (val2-val < 100) {
		$("#slideShow").css("top","10px");
    }else if(val2-val>100){
		$("#slideShow").css("top","294px");
	}
});
</script>
</body>
</html>
