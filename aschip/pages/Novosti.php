<?php
include '../php/crud.php';
include '../php/klase.php';



function PrikaziNovost($novost){
	echo '<div class="novostiDetalji"> 
			<h2>'.$novost["naslov"].'</h2>
			<div class="vrijemeDetalji"> Novost objavljena '.$novost["datumObjave"].'.</div>
			<div class="novostDetalji">
				<img class="slikaNovostiDetalji" src="'.dajSlikuPoId($novost["idSlike"])["path"].'" alt="0"/>
				<p class="paragrafNovostiDetalji">'.$novost["tekst"].'</p>
			</div>
		 </div>';
				  
}

 
function PrikaziZadnjeTri($list){
	echo '<ul>';
	for($i=0; $i<count($list); $i++){
		echo '<li>';
			echo '<h2><img src="'.dajSlikuPoId($list[$i]["idSlike"])["path"].'" alt="" /></h2>
				 <p style="height: 270px;">'.dajTekstSmanjen($list[$i]["tekst"]).'</p><p class="readmore"><a href="Novosti.php?id='.$list[$i]["id"].'">Continue Reading &raquo;</a></p>';
		echo '</li>';
	}
	echo '</ul>';
} 

function dajTekstSmanjen($text){
	if(strlen($text)>205){
		$text = substr($text, 0, 205);
		$text = substr($text, 0, strrpos($text, ' ')) . " ...";
	}
	return $text;
}
?>


<!DOCTYPE html>
<!--
Template Name: PlusBusiness
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<?php session_start(); ?>
<html>
<head>
<title>AS Chip tuning</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../layout/styles/layout.css" type="text/css" />
<link rel="stylesheet" href="../layout/styles/login.css" type="text/css" />
<script type="text/javascript" src="../layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="../layout/scripts/login.js"></script>

<style>
.novostiDetalji{
    width: 95%;
    display: inline-block;
    margin-left: 20px;
    border-radius: 5%;
/*    border: 1px solid gray;*/
    margin-top: 15px;
    /*background-color: rgba(15, 117, 56, 0.55);*/
}

.novostiDetalji h2{
	margin-left:auto;
	margin-right:auto;
	width:40%;
	margin-bottom: 10px;
    margin-top: 10px;
}

.vrijemeDetalji{
	font-size:12px;
	margin-left:5px;
	display:inline-block;
}

.autorDetalji{
	font-size:12px;
	margin-right:5px;
	display:inline-block;
	float:right;
}
.novostDetalji{
	padding: 5px;
}

.slikaNovostiDetalji{
	width:300px;
	height:200px;
	display:inline-block;
	border-radius: 15%;
	vertical-align:top;
}

.paragrafNovostiDetalji{
	display:inline-block;
	width:60%;
	margin-left:5px;
    font-size: 100%;
	margin-top: -5px;
	font-size:15px;
	font-family:'Lora';
	font-style:italic;
}
</style>
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
		<li><a href="Galerija.php">Galerija</a></li>
        <li class="last active"><a href="Novosti.php">Novosti</a></li>
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
    <div class="homepage">
		<?php 
        if(isset($_GET["id"])){
			PrikaziNovost(dajNovostPoId($_GET["id"]));
		}else{
			PrikaziZadnjeTri(dajZadnje3Novosti());
		}
	  ?>
      <br class="clear" />
    </div>
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
</script>
</body>
</html>