<?php

include 'crud.php';
include 'klase.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"]) && isset($_POST["idProizvodjaca"])){
	if(obrisiProizvodjacaPoId($_POST["idProizvodjaca"]))
		echo "<script> alert('Proizvodjac je uspjesno obrisan'); </script>";
	else
		echo "<script> alert('Proizvodjac nije obrisan'); </script>";
}
if(!empty($_SESSION["username"])){
	$lista=Sortiraj(dajSveProizvodjace());
	Prikazi($lista);	
}

function Sortiraj($list){
	foreach ($list as $key => $row) {
		$markaVozila[$key]  = $row['markaVozila'];
	}
	array_multisort($markaVozila, SORT_ASC, $list);
	return $list;
}

function Prikazi($lista){
	echo '<table>
			<tbody>';
	$j=0;
	for($i=0; $i<count($lista); $i++){
		if($j==0) echo '<tr>';
		$j++;
		echo '<td>
			<img class="imgProizvodjaca" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div class="sredina">'.$lista[$i]["markaVozila"].'</div>
			<input style="float:right; top:5px;" class="sredina" type="button" value="Obrisi" onclick="return ObrisiProizvodjaca('.$lista[$i]["id"].')" />
			</td>';				
		if($j==3){
			echo '</tr>';
			$j=0;
		}
	}
	echo '</tbody></table>';
}

?>

<div id="poruka" class="msgbox">
	<div class="msgboxTop"><h2 style="border:none;">Poruka</h2></div>
	<div class="msgboxCenter">
		<h4 style="border:none;">Da li zelite obrisati proizvodjaca?</h4>
	</div>
	<div class="msgboxFooter">
		<input type="button" id="msgboxButtonNo" value="Ne" name="Ne"/>
		<input type="button" id="msgboxButtonYes" value="Da" name="Ne"/>
	</div>
</div>


<style>
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
#msgboxButtonNo{
	float:left;
	margin:5px;
}
#msgboxButtonYes{
	float:right;
	margin:5px;
}



.imgProizvodjaca{
	max-width:50px;
	max-height:50px;
	display:inline-block;
}

.sredina{
	display: inline-block;
    position: relative;
    top: -10px;
}

table{
	border:none;
}
</style>

<script>
$("#msgboxButtonYes").click(function(){
	var vrj=$("#msgboxButtonYes").attr("name");
	if(vrj!="Ne"){
		urlTmp='../php/obrisiProizvodjaca.php';
		var datarow={	
			'idProizvodjaca':vrj
		};
		$.ajax({
		   url: urlTmp,
		   type:    'POST',
		   data: datarow,
		 success: function(response){
			$("#centerAdminPanel").html(response);
			obrisiProizvodjaca();
		 }});
	}
});

$("#msgboxButtonNo").click(function(){
	$("#poruka").hide();
	$("#msgboxButtonYes").attr("name","Ne");
});
function ObrisiProizvodjaca(idPr){
	$("#poruka").show();
	$("#msgboxButtonYes").attr("name",idPr);
	return false;
}
</script>