<!DOCTYPE html>
<!--
Template Name: PlusBusiness
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<?php session_start(); ?>
<?php
	include '../php/crud.php';

	if(!empty($_GET['tip'])){
		$lista=izbaciDuple(dajSveProizvodjaceZaTip($_GET['tip']));
	}
	function Sortiraj($list){
		if(!empty($list)){
			foreach ($list as $key => $row) {
				$markaVozila[$key]  = $row['markaVozila'];
			}
			array_multisort($markaVozila, SORT_ASC, $list);
			return $list;
		}else
			return null;
	}
	
	function izbaciDuple($lista){
		if(count($lista)>0){
			$lista=Sortiraj($lista);
			$tmpList=array();
			for($i=0; $i<count($lista); $i++){
				$j=$i+1;
				if($j==count($lista)){ 
					array_push($tmpList,$lista[$i]);
					break;
				}
				if($lista[$i]["markaVozila"]==$lista[$j]["markaVozila"]) continue;
				else{
					array_push($tmpList,$lista[$i]);
				}
			}
			return $tmpList;
		}else{
			return null;
		}
	}
	
	function SortirajVozila($list){
		if(!empty($list)){
			foreach ($list as $key => $row) {
				$markaVozila[$key]  = $row['model'];
			}
			array_multisort($markaVozila, SORT_ASC, $list);
			return $list;
		}else
			return null;
	}
	
	function izbaciDupleVozila($lista){
		if(count($lista)>0){
			$lista=SortirajVozila($lista);
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
		}else{
			return null;
		}
	}
	
	if($_GET['tip']=="Auto"){		
		function PrikaziSveCentar($lista){
			$j=0;
			for($i=0; $i<count($lista); $i++){
				if($j==0) echo '<tr>';
				$j++;
				$js="'Auto'";
				if(count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Auto"))!=0)
					echo '<td><a title="Ukupno '.count(izbaciDupleVozila(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Auto"))).'" href="#" onclick="return OtvoriProizvodjaca('.$lista[$i]["id"].','.$js.')">
						<img class="imgProizvodjaci" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div style="display:inline-block; position: relative;top: -10px;">'.$lista[$i]["markaVozila"].'</div></a></td>';
				else
					echo '<td><a title="Ukupno '.count(izbaciDupleVozila(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Auto"))).'" href="#">
						<img class="imgProizvodjaci" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div style="display:inline-block; position: relative;top: -10px;">'.$lista[$i]["markaVozila"].'</div></a></td>';
				if($j==3){ 
					echo '</tr>';
					$j=0;
				}
			}
		}
								
		function PrikaziSveStrana($lista){
			$js="'Auto'";
			for($i=0; $i<count($lista); $i++){
				if(count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Auto"))!=0)
					echo '<li style="padding-left:20px; padding-top:5px; padding-bottom:5px;"><img style="width:30px;display:inline-block;" alt="" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <a  title="Ukupno '.count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Auto")).'" style="display:inline-block; position: relative; top: -10px;" href="#" onclick="return OtvoriProizvodjaca('.$lista[$i]["id"].','.$js.')">'.$lista[$i]["markaVozila"].'</a></li>';
				else
					echo '<li style="padding-left:20px; padding-top:5px; padding-bottom:5px;"><img style="width:30px;display:inline-block;" alt="" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <a  title="Ukupno '.count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Auto")).'" style="display:inline-block; position: relative; top: -10px;" href="#">'.$lista[$i]["markaVozila"].'</a></li>';
			}
		}
	}else if($_GET['tip']=="Kamion"){
		function PrikaziSveCentar($lista){
			$j=0;
			for($i=0; $i<count($lista); $i++){
				if($j==0) echo '<tr>';
				$j++;
				$js="'Kamion'";
				if(count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Kamion"))!=0)
					echo '<td><a title="Ukupno '.count(izbaciDupleVozila(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Kamion"))).'" href="#" onclick="return OtvoriProizvodjaca('.$lista[$i]["id"].','.$js.')">
					<img class="imgProizvodjaci" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div style="display:inline-block; position: relative;top: -10px;">'.$lista[$i]["markaVozila"].'</div></a></td>';
				else
					echo '<td><a title="Ukupno '.count(izbaciDupleVozila(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Kamion"))).'" href="#">
					<img class="imgProizvodjaci" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div style="display:inline-block; position: relative;top: -10px;">'.$lista[$i]["markaVozila"].'</div></a></td>';
				if($j==3){ 
					echo '</tr>';
					$j=0;
				}
			}
		}
								
		function PrikaziSveStrana($lista){
			for($i=0; $i<count($lista); $i++){
				$js="'Kamion'";
				if(count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Kamion"))!=0)
					echo '<li style="padding-left:20px; padding-top:5px; padding-bottom:5px;"><img style="display:inline-block;" alt="" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <a title="Ukupno '.count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Kamion")).'" style="display:inline-block; position: relative; top: -10px;" href="#" onclick="return OtvoriProizvodjaca('.$lista[$i]["id"].','.$js.')">'.$lista[$i]["markaVozila"].'</a></li>';
				else 
					echo '<li style="padding-left:20px; padding-top:5px; padding-bottom:5px;"><img style="display:inline-block;" alt="" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <a title="Ukupno '.count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Kamion")).'" style="display:inline-block; position: relative; top: -10px;" href="#">'.$lista[$i]["markaVozila"].'</a></li>';
			}
		}
	}else if($_GET['tip']=="Motor"){
		function PrikaziSveCentar($lista){
			$j=0;
			for($i=0; $i<count($lista); $i++){
				if($j==0) echo '<tr>';
				$j++;
				$js="'Motor'";
				if(count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Motor"))!=0)
					echo '<td><a title="Ukupno '.count(izbaciDupleVozila(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Motor"))).'" href="#" onclick="return OtvoriProizvodjaca('.$lista[$i]["id"].','.$js.')">
						<img class="imgProizvodjaci" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div style="display:inline-block; position: relative;top: -10px;">'.$lista[$i]["markaVozila"].'</div></a></td>';
				else
					echo '<td><a title="Ukupno '.count(izbaciDupleVozila(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Motor"))).'" href="#">
					<img class="imgProizvodjaci" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div style="display:inline-block; position: relative;top: -10px;">'.$lista[$i]["markaVozila"].'</div></a></td>';
				if($j==3){ 
					echo '</tr>';
					$j=0;
				}
			}
		}
								
		function PrikaziSveStrana($lista){
			for($i=0; $i<count($lista); $i++){
				$js="'Motor'";
				if(count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Motor"))!=0)
					echo '<li style="padding-left:20px; padding-top:5px; padding-bottom:5px;"><img style="display:inline-block;" alt="" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <a title="Ukupno '.count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Motor")).'" style="display:inline-block; position: relative; top: -10px;" href="#" onclick="return OtvoriProizvodjaca('.$lista[$i]["id"].','.$js.')">'.$lista[$i]["markaVozila"].'</a></li>';
				else
					echo '<li style="padding-left:20px; padding-top:5px; padding-bottom:5px;"><img style="display:inline-block;" alt="" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <a title="Ukupno '.count(dajVozilaZaProizvodjacaITipVozila($lista[$i]["id"],"Motor")).'" style="display:inline-block; position: relative; top: -10px;" href="#">'.$lista[$i]["markaVozila"].'</a></li>';
			}
		}
	}
	
	
?>


<html>
<head>
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
      <!--<h1><a href="index.php"><img src="images/logo.png" width=200; height=80;></a></h1>-->
    </div>
    <div id="topnav">
      <ul style="height: 52px; left: -63px; position: relative;">
        <li><a href="..\index.php">Home</a></li>
        <li><a href="style-demo.php">Kontakt</a></li>
        <li><a href="full-width.php">Chip tuning</a></li>
		<li style="background: none;position: relative; top: -33px;"><a style="background: none;" href="index.php"><img src="../images/logo.png" width=200; height=80;></a> </li>
        
        <li><a href="Katalog.php">Katalog</a>
          <ul>
		  <?php if($_GET["tip"]=="Auto"){ ?>
            <li class="active"><a href="AMK.php?tip=Auto">Auta</a></li>
            <li><a href="AMK.php?tip=Kamion">Kamioni</a></li>
            <li><a href="AMK.php?tip=Motor">Motori</a></li>
		  <?php }else if($_GET["tip"]=="Kamion"){ ?>
            <li><a href="AMK.php?tip=Auto">Auta</a></li>
            <li class="active"><a href="AMK.php?tip=Kamion">Kamioni</a></li>
            <li><a href="AMK.php?tip=Motor">Motori</a></li>
		  <?php }else if($_GET["tip"]=="Motor"){ ?>
            <li><a href="AMK.php?tip=Auto">Auta</a></li>
            <li><a href="AMK.php?tip=Kamion">Kamioni</a></li>
            <li class="active"><a href="AMK.php?tip=Motor">Motori</a></li>
		  <?php }else{ ?>
            <li><a href="AMK.php?tip=Auto">Auta</a></li>
            <li><a href="AMK.php?tip=Kamion">Kamioni</a></li>
            <li><a href="AMK.php?tip=Motor">Motori</a></li>		  
		  <?php } ?>
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
  <div id="container">
<style>
/* Sidebar */

#sidebar ul {
	margin: 0;
	padding: 0;
	list-style: none;
}

#sidebar li {
	margin: 0;
	padding: 0;
}

#sidebar li ul {
	margin-bottom: 10px;
	border-right: 1px solid #909090;
	border-bottom: 1px solid #909090;
}

#sidebar li li {
	border-bottom: 1px dashed #909090;
	padding-left: 0px;
}

#sidebar li li span {
	display: block;
	margin-top: -20px;
	padding: 0;
	font-size: 11px;
	font-style: italic;
}

#sidebar h2 {
	height: 42px;
	margin: 0 auto;
	text-transform: uppercase;
	padding: 3px 0 0 25px;
	background: url(/css/smh2.png) no-repeat;
	font-weight: bold;
	font-size: 14px;
}

#sidebar a {
	color: #333;
	border: none;
}

#sidebar a:hover {
	text-decoration: underline;
	color: #cc0000;
}
/* Brandovi */

#brandovi
{
	border:none;
	background: transparent;
	width: 100%;
	border-collapse: collapse;
	text-align: left;
}
#brandovi a
{
	color: #000;
	text-decoration: none;
}
#brandovi a:hover
{
	color: #cc0000;
	text-decoration: none;
}

#brandovi thead
{
	color: #000;
	padding: 10px 8px;
	margin-bottom:20px;
	/*border-bottom: 2px solid #909090;*/
}
#brandovi td
{
	font-weight: bold;
	color: #000;
	padding: 6px 8px;
}
#brandovi tbody tr:hover td
{
	color: #cc0000;
}

#brandovi li {
	padding-left: 10px;
}


/* MOJE napamet*/
.imgProizvodjaci{
	max-width:30px;
	max-height:30px;
	display:inline-block;
}

</style>
 
		<div id="content" style="float:right; width:75%;">

			<h2 style="margin: 20px 0;">Proizvođači - <?php echo $_GET['tip']; ?></h2>
			<center>
			<table id="brandovi" style="margin-left: 30px;">
				<thead>
				</thead>
				<tbody>
				<?php
					PrikaziSveCentar($lista);
				?>
				</tbody>

			</table>
			</center>

			</div>
			<div id="sidebar" style="float:left; width:20%;">
			<h2>Proizvođači</h2>
				<ul>
					<li>
						<ul id="kontejner" style="overflow: auto; height: 973px;">
							<?php
								PrikaziSveStrana($lista);
							?>
							
						</ul>
					</li>
				</ul>
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

function OtvoriProizvodjaca(id,tip){
	urlTmp='../php/dajSvaVozilaZaProizvodjaca.php';
	var datarow={
		'idProizvodjaca':id,
		'tipVozila':tip
	};
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: datarow,
	 success: function(response){
		$("#content").html(response);
	 }});
	return false;
}

function OtvoriVozilo(id){
	urlTmp='../php/dajVozilo.php';
	var datarow={
		'id':id,
	};
	$.ajax({
	   url: urlTmp,
	   type:    'POST',
	   data: datarow,
	 success: function(response){
		$("#content").html(response);
	 }});
	return false;
	
}
</script>
</body>
</html>