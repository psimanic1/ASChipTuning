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
</head>
<body id="top">
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <h1><a href="..\index.php"><img src="LOGO-Copy1.bmp"></a></h1>
    </div>
    <div id="topnav">
      <ul>
        <li class="active"><a href="..\index.php">Home</a></li>
        <li><a href="style-demo.php">Kontakt</a></li>
        <li><a href="full-width.php">O nama</a></li>
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
      <li class="first"><p>Mob: 061/552-336 --- Mob: 061/815-816 | info@aschiptuning.com</p></li>
       <a href="https://www.facebook.com/ASchiptuning/?fref=ts"><img src="../images/fb.png"></a>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="container">
    <h1>Headline 1 Colour and Size</h1>
    <h2>Headline 2 Colour and Size</h2>
    <h3>Headline 3 Colour and Size</h3>
    <h4>Headline 4 Colour and Size</h4>
    <h5>Headline 5 Colour and Size</h5>
    <h6>Headline 6 Colour and Size</h6>
    <p>This is a W3C compliant free website template from <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a>. This template is distributed using a <a href="http://www.os-templates.com/template-terms">Website Template Licence</a>.</p>
    <p>You can use and modify the template for both personal and commercial use. You must keep all copyright information and credit links in the template and associated files. For more CSS templates visit <a href="http://www.os-templates.com/">Free Website Templates</a>.</p>
    <ul>
      <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
      <li>Etiam vel sapien et est adipiscing commodo.</li>
      <li>Duis pharetra eleifend sapien, id faucibus dolor rutrum et.</li>
      <li>Donec et dui dolor, in lacinia leo.</li>
      <li>Mauris posuere tellus ac purus adipiscing dapibus.</li>
    </ul>
    <p>Vestibulumaccumsan egestibulum eu justo convallis augue estas aenean elit intesque sed. Facilispede estibulum nulla orna nisl velit elit ac aliquat non tincidunt. Namjusto cras urna urnaretra lor urna neque sed quis orci nulla. Laoremut vitae doloreet condimentumst phasellentes dolor ut a ipsum id consectetus. Inpede cumst vitae ris tellentesque fring intesquet nibh fames nulla curabitudin.</p>
    <ol>
      <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
      <li>Etiam vel sapien et est adipiscing commodo.</li>
      <li>Duis pharetra eleifend sapien, id faucibus dolor rutrum et.</li>
      <li>Donec et dui dolor, in lacinia leo.</li>
      <li>Mauris posuere tellus ac purus adipiscing dapibus.</li>
    </ol>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="footer">
    <div class="box1">
      <h2>Sjedište tuning kuće</h2>
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
        <div class="flickr_badge_image" id="flickr_badge_image1"><a href="#"><img src="../images/demo/80x80.gif" alt="" /></a></div>
        <div class="flickr_badge_image" id="flickr_badge_image2"><a href="#"><img src="../images/demo/80x80.gif" alt="" /></a></div>
        <div class="flickr_badge_image" id="flickr_badge_image3"><a href="#"><img src="../images/demo/80x80.gif" alt="" /></a></div>
        <div class="flickr_badge_image" id="flickr_badge_image4"><a href="#"><img src="../images/demo/80x80.gif" alt="" /></a></div>
        <div class="flickr_badge_image" id="flickr_badge_image5"><a href="#"><img src="../images/demo/80x80.gif" alt="" /></a></div>
        <div class="flickr_badge_image" id="flickr_badge_image6"><a href="#"><img src="../images/demo/80x80.gif" alt="" /></a></div>
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