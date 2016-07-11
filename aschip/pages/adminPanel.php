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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../layout/styles/layout.css" type="text/css" />
<link rel="stylesheet" href="../layout/styles/login.css" type="text/css" />
<script type="text/javascript" src="../layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="../layout/scripts/login.js"></script>
<script type="text/javascript" src="../layout/scripts/panel.js"></script>
</head>
<body id="top">
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
     <!--<h1><a href="index.php"><img src="images/logo.png" width=200; height=80;></a></h1>-->
    </div>
    <div id="topnav">
      <ul style="height: 52px; left: -63px; position: relative;">
        <li class="active"><a href="..\index.php">Home</a></li>
        <li><a href="style-demo.php">Kontakt</a></li>
        <li><a href="full-width.php">O nama</a></li>
		<li style="background: none;position: relative; top: -33px;"><a style="background: none;" href="index.php"><img src="../images/logo.png" width=200; height=80;></a> </li>
        <li><a href="Katalog.php">Katalog</a>
          <ul>
           <li><a href="AMK.php?tip=Auto">Auta</a></li>
            <li><a href="AMK.php?tip=Kamion">Kamioni</a></li>
            <li><a href="AMK.php?tip=Motor">Motori</a></li>
          </ul>
        </li>
		<li><a href="Galerija.php">Galerija</a></li>
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
       <li class="first"><p <p style="width:500px; display:inline-block;">>Mob: 061/552-336 --- Mob: 061/815-816 | info@aschiptuning.com</p></li>
       <a style="float:right;" href="https://www.facebook.com/ASchiptuning/?fref=ts"><img src="../images/fb.png"></a>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container" style="min-height:400px;">
  <style>
  #sideAdminPanel{
	  display:inline-block;
	  width:24%;
	  border-right:1px solid black;
	  float:left;
	  min-height:400px;
  }
  #centerAdminPanel{
	  display:inline-block;	  
	  width:75%;
	  float:right;
  }
  
  #sideAdminPanel ol li {
	  display:block;
	  padding-left:10px;
  }
  </style>
    <div id="sideAdminPanel">
		<ol>
			<h3>Proizvodjaci</h3>
			<li><a href="#" onclick="return dodajProizvodjaca()">Dodaj proizvodjaca</a></li>
			<li><a href="#" onclick="return obrisiProizvodjaca()">Obrisi proizvodjaca</a></li>			
			</br>
			<h3>Vozila</h3>			
			<li><a href="#" onclick="return dodajVozilo()">Dodaj vozilo</a></li>
			<li><a href="#" onclick="return obrisiVozilo()">Obrisi vozilo</a></li>
			</br>
			<h3>Galerija</h3>
			<li><a href="#" onclick="return editujGaleriju()">Edituj galeriju</a></li>
			</br>
			<h3>Novosti</h3>
			<li><a href="#" onclick="return dodajNovosti()">Dodaj novost</a></li>
			<li><a href="#" onclick="return editujNovosti()">Editovanje novosti</a></li>

		</ol>
	</div>
	<div id="centerAdminPanel">
	
	</div>
	
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="footer">
    <div class="box1">
      <h2>Sjediste tuning kuce</h2>
      <ul>
        <li>AS Chip tuning</li>
        <li>Adema Buce 234</li>
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
</body>
</html>