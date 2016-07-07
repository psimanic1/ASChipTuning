<?php
include 'crud.php';

function PrikaziSlikeZaSlider(){
	$list=dajSveSlikeZaFolder($_POST["idFoldera"]);
	for($i=0; $i<count($list); $i++){
	    echo '<img class="mySlides" src="'.$list[$i]["path"].'" style="width:100%">';
	}
}
?>
<link rel="stylesheet" href="../layout/styles/w3.css">

<div class="w3-content" style="max-width:800px;position:relative">
<?php 
	if(isset($_POST['idFoldera'])){
		PrikaziSlikeZaSlider();
	}
?>

<a class="w3-btn-floating" style="position:absolute;top:45%;left:0" onclick="plusDivs(-1)">?</a>
<a class="w3-btn-floating" style="position:absolute;top:45%;right:0" onclick="plusDivs(1)">?</a>

</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
	 x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}
</script>
