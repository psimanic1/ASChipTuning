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
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<link rel="stylesheet" href="layout/styles/login.css" type="text/css" />
<script type="text/javascript" src="layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.jcarousel.setup.js"></script>
<script type="text/javascript" src="layout/scripts/login.js"></script>
</head>
<body id="top">
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <h1><a href="index.php"><img src="LOGO-Copy1.bmp"></a></h1>
    </div>
    <div id="topnav">
      <ul>
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="pages/style-demo.php">Kontakt</a></li>
        <li><a href="pages/full-width.php">O nama</a></li>
        <li><a href="pages/Katalog.php">Katalog</a>
          <ul>
            <li><a href="pages/AMK.php?tip=Auto">Auta</a></li>
            <li><a href="pages/AMK.php?tip=Kamion">Kamioni</a></li>
            <li><a href="pages/AMK.php?tip=Motor">Motori</a></li>
          </ul>
        </li>
		<li><a href="pages/Galerija.php">Galerija</a></li>
        <li class="last"><a href="pages/Novosti.php">Novosti</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="featured_slide">
    <div id="featured_content">
      <ul>
        <li><img src="images/g6.jpg" alt="" />  </li>
        <li><img src="images/a3.jpg" alt="" />  </li>
        <li><img src="images/r32.jpg" alt="" /> </li>
		<li><img src="images/kriva.jpg" alt="" /> </li>
      </ul>
    </div>
    <a href="javascript:void(0);" id="featured-item-prev"><img src="layout/images/left.png" alt="" /></a> <a href="javascript:void(0);" id="featured-item-next"><img src="layout/images/right.png" alt="" /></a> </div>
</div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    
  </div>
</div>
<!-- ####################################################################################################### -->
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    <div id="homepage" class="homepage">
      
      <br class="clear" />
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
			<p style="margin-right: 20px;" class="fl_right"><a href="pages/adminPanel.php"><b>Admin Panel</b></a></p>
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

<script>
$(document).ready(function(){
	$.ajax({
	  url: 'php/pocetna.php',
	  type: 'POST',
	  data: new FormData(this),
	  processData: false,
	  contentType: false,
	  success:function(response){
		  $("#container").html(response);
	  }
	});
	
	$.ajax({
	  url: 'php/ucitajPosljednje3NovostiNaPocetnoj.php',
	  type: 'GET',
	  success:function(response){
		  $("#homepage").html(response);
	  }
	});
	
	$.ajax({
	  url: 'php/ucitajPosljednjih6Slika.php',
	  type: 'GET',
	  success:function(response){
		  $("#sestSlika").html(response);
	  }
	});
});

</script>