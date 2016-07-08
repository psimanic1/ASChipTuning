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
		
		
<?php if(isset($_GET["idFoldera"])){

function PrikaziSlikeZaSlider(){
	$list=dajSveSlikeZaFolder($_GET["idFoldera"]);
	for($i=0; $i<count($list); $i++){
	    echo '<img class="mySlides" src="'.$list[$i]["path"].'" style="width:100%">';
	}
}

function PrikaziDoleSlike(){
	$list=dajSveSlikeZaFolder($_GET["idFoldera"]);
	for($i=0; $i<count($list); $i++){
	    echo '  <a class="palac" data-ucitaj="'.$i.'">
				  <figure class="kvadrat"></figure>
				  <img alt="" src="'.$list[$i]["path"].'"></a>';
	}
}

function PrikaziSlikeGore(){
	$list=dajSveSlikeZaFolder($_GET["idFoldera"]);
	for($i=0; $i<count($list); $i++){
	    echo '<div class="okvir shown" data-redni="'.$i.'" style="display: none;">
	  <span class="opis"><strong></strong> <strong class="r"></strong></span>
	  <img style="min-height:400px;" data-width="670" data-height="475" class="fotka " src="'.$list[$i]["path"].'" alt="" style="margin-top: 1.5px;"></div>';
	}
}
if(isset($_GET["idFoldera"])){
	echo '<div class="fb-share-button" data-href="localhost/aschip/pages/Galerija.php?idFoldera=6" data-layout="button" data-size="large" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>';
}
?>


<div class="galerija">
  <div class="gore">
    
  <div class="gurni lijevo" data-ucitaj="0">
  <a class="g_lijevo bg_vijesti">
  <img src="../layout/images/left.png" width="30" height="50">
  </a></div>
  
<div class="gurni desno" data-ucitaj="1">
  <a class="g_desno bg_vijesti">
  <img src="../layout/images/right.png" width="30" height="50">
  </a></div>
  
  
  
<div class="fotke" style="max-height: 500px;">
	<?php
		PrikaziSlikeGore();
	?>

  </div>
  </div>
  

  <div class="dole">
  <div class="kontrole" align="center">
  <a class="gurni-thumb lijevo"><img src="../layout/images/left.png" width="30" height="50"></a></div>
  <div class="palcevi">
  <div class="skrol">
  <?php
	PrikaziDoleSlike();
  ?>
  </div>
  </div>
  <div class="kontrole" align="center">
  <a class="gurni-thumb desno"><img src="../layout/images/right.png" width="30" height="50"></a></div>
  </div>
  </div>
<div id="fb-root"></div>
<style>


figure.kvadrat {
	display:block;
	border:0px solid transparent;
	position:absolute;
	top:-90px;
	left:-76px;
	-webkit-transition : border 200ms ease-in; 
	-moz-transition : border 200ms ease-in;
	-o-transition : border 200ms ease-in;
visibility:hidden;

}



/* galerija */


.galerija {
	width:900px;
	margin-left: 0px;
	min-height:515px;
	background:#5C5B5A;
	position:relative;
	z-index: 100;
}

.galerija .gore {
	height:400px;
	position:relative;
	background:#5C5B5A;
	margin-left: 10px;
}

.galerija .okvir {
	text-align:center;
	display:none;
	overflow: hidden;
	height: 400px;
}

.galerija .okvir img.fotka {
	max-height:none;
	max-width: none;
    margin-left: auto;
    margin-right: auto;
	margin-top: 5px;
}

.galerija .okvir img.fotka.visoka { 
	max-height: 400px;
}

.galerija .palcevi {
	width:805px;
	height:80px;
	float:left;
	overflow:hidden;
	position:relative;
	margin-top:10px;
}

.galerija .dole {
	width:890px;
	float:left;
	margin-left: 10px;
	height:100px;
	background:#5C5B5A;
}

.galerija .palcevi .skrol {
	float:left;
	position:relative;
	width:1000000px;
}

.galerija .palcevi .skrol .palac {
	float:left;
	margin-left:10px;
	cursor:pointer;
	width:120px;
	height:80px;
	position:relative;
}

.galerija .palcevi .skrol .palac:hover figure.kvadrat, .galerija .palcevi .skrol .palac.selected figure.kvadrat {border-color:#fff;} 
.galerija .palcevi .skrol .palac figure.kvadrat {width:120px; height:80px;}

.galerija .palcevi .palac img {
	width:120px;
	height:80px;;
}

.galerija .kontrole {
	float:left;
	width:40px;
	height:100px;
}

.galerija .kontrole .gurni-thumb {
	width:30px;
	font-size:20px;
	height:42px;
	float:left;
	cursor:pointer;
}


.galerija .gurni.lijevo, .galerija .gurni.desno {
	width:400px;
	height:100%;
	position:absolute;
	top:0;
	overflow:hidden;
	cursor:pointer;
	z-index:200;
}

.galerija .gurni.lijevo {left:-10px; }
.galerija .gurni.desno {right:-10px;}

.galerija .gurni.desno .g_desno, .galerija .gurni.lijevo .g_lijevo {
	width:37px;
	height:37px;
	position:absolute;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	-ms-transition: all 0.5s ease;
	transition: all 0.5s ease;
	top:176px;
}

.galerija .gurni.lijevo .g_lijevo {left:0px; background: none;}

.galerija .gurni.desno .g_desno {right:0px; background: none;}

.galerija .gurni.lijevo:hover .g_lijevo {left:0;}
.galerija .gurni.desno:hover .g_desno {right:0;}

.galerija .sep { height:1px; background-color:#7c7d7f; clear:both; }
/*
.galerija .okvir .opis {
	font-family: ProximaNova-Regular, Arial, Verdana;
	font-weight: normal;
	font-style: normal;
	position: absolute;
	background: rgba(0, 0, 0, 0.7);
	color: white;
	font-size: 12px;
	padding: 15px 10px 5px 10px;
	bottom: 0;
	left: 0;
	width: 772px;
	text-align: left;
	background: #000;
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjQwJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwLjgiLz4KICA8L2xpbmVhckdyYWRpZW50PgogIDxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxIiBoZWlnaHQ9IjEiIGZpbGw9InVybCgjZ3JhZC11Y2dnLWdlbmVyYXRlZCkiIC8+Cjwvc3ZnPg==);
	background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 40%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(40%,rgba(0,0,0,0.8))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.8) 40%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.8) 40%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.8) 40%); /* IE10+ */
	background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.8) 40%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#cc000000',GradientType=0 ); /* IE6-8 */
}
*/
.galerija .okvir figure.kvadrat {
	width: 100%;
	height: 100%;
	overflow:hidden;
	visibility:hidden;
}


.galerija .gurni-thumb.lijevo { margin-top:25px; margin-bottom:4px; margin-left:5px; width:30px; height:30px; background: none;}

.galerija .gurni-thumb.desno { margin-top:25px; margin-left:8px; width:30px; height:30px; background: none; }


.prethodne {
	border-top: 1px solid #dcdcdc;
	padding-left:0px;
	width:850px;
	float:left;
	padding-top:15px;
	margin-top: 20px;
}


</style>


<script>


(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));




		var stac;
        var sopen = false;
        var nt = '';
        var rijeci;
        var cs;
        var timertraje;
        var pomak = 1;
        var biopomak = 0;
        var stisnute = [];

        
        var halted = false;
		var clanakHeight = 0;
        var zavrsio = false;
        var pokusao_naci = 0;
        var intervaler;
		$(document).ready(function() {
 
			//brojanje ukupno slika
			ukupno = $('.galerija .fotke div.okvir').length;

			//selektiranje thumbova
			$('.galerija .palcevi .skrol .palac:first').addClass('selected');
			$('.galerija .fotke div.okvir:first').addClass('shown').show();
			
			//vertikalno centriranje slika
			/*$('.galerija .fotke img.fotka').each(function(){
				visina = $(this).attr('data-height');
				visokvir = $('.gore').height();
				if(visina < visokvir){
					gurnije = (visokvir - visina)/2;
					$(this).css('marginTop', gurnije+'px');
				}
			});*/
			
			//sakrivanje invalidnih buttona
			function sakrijInvalidne(){ 
				$('.galerija .gurni').show(); 
				$('.galerija .gurni[data-ucitaj=0], .galerija .gurni[data-ucitaj='+(ukupno)+']').hide(); 
				
				var val= $('.galerija .gurni.lijevo').attr("data-ucitaj");
				var val1=$('.galerija .gurni.desno').attr("data-ucitaj");
				var display= $(".gurni.lijevo").css("display");
				if(val1==2 && val<=0 && display=="none"){
					$('.galerija .gurni.lijevo').attr("data-ucitaj","0");
					$(".gurni.lijevo").css("display","block");
				}
			}
			
			sakrijInvalidne();
			
			//ucitavanje fotke u galeriju
			$('.palac[data-ucitaj], .galerija div[data-ucitaj]').click(function(){
				//cache
				klik = $(this);
				ucitaj = klik.attr('data-ucitaj');
				
				sadfotka = parseInt(ucitaj);

				if(sadfotka >= 0 && sadfotka <= ukupno){
					//location.hash = sadfotka;
					location.replace('#'+sadfotka);
					
					prethodna = sadfotka - 1;
					sljedeca = sadfotka + 1;
					
					if(prethodna<0){ 
						prethodna=0;
						sljedeca=1;
					}
					//setovanje buttona za guranje
					$('.galerija .gurni.lijevo').attr('data-ucitaj', prethodna);
					$('.galerija .gurni.desno').attr('data-ucitaj', sljedeca);
					
					//stavljanje okvira i klase na thumb
					$('.galerija .palcevi .palac').removeClass('selected');
					$('.galerija .palcevi .palac[data-ucitaj='+ucitaj+']').addClass('selected');
					
					//sakrivanje trenutne i Prikaz odabrane fotografije
					$('.galerija .fotke .shown').removeClass('shown').fadeOut('fast', function(){
						$('.galerija .fotke div.okvir[data-redni='+ucitaj+']').fadeIn('fast').addClass('shown');
					});
					
					//guranje thumbaila
					if(sadfotka < ukupno - 1){
						if(sadfotka < 2){
							gLijevo = 0;
						}
						else {
							gLijevo = ($('.palac[data-ucitaj='+sadfotka+']').position().left - 120)*-1;
						}

						$('.galerija .skrol').stop().animate({'left' : gLijevo}, 1000);
					}
				}
				
				sakrijInvalidne();
			});
		
			//skrolanje 
			if(ukupno > 5){
				$('.gurni-thumb').click(function(){
					var gotova=true;
					if(gotova){
						gotova = false;
						var okvir = $('.galerija .skrol');
						
						var left=0;
						var uksirina = (ukupno * 140)*-1;

						if($(this).hasClass('lijevo') && (left+600) <= 0)	            { left = okvir.position().left + 600; }
						else if($(this).hasClass('desno') && (left-600) > uksirina)		{ left = okvir.position().left - 600; }
						
						if(left <= 0 && left > uksirina){

							okvir.stop().animate({'left' : left}, 1000, function(){
								gotova = true;
							});
						}
					}
					
				});
			}						
			
		});



</script>



<?php }else{ ?>

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
	window.location.href='Galerija.php?idFoldera='+idFoldera;
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


<?php } ?>







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


</body>
</html>
