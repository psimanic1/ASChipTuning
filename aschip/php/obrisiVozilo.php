<?php 
echo "Bum bilo uskoro :D";
?>

<?php

include 'crud.php';
include 'klase.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"]) && isset($_POST["idVozila"])){
	if(obrisiVoziloPoId($_POST["idVozila"]))
		echo "<script> alert('Vozilo je uspjesno obrisano'); </script>";
	else
		echo "<script> alert('Vozilo nije obrisano'); </script>";
}

if(!empty($_SESSION["username"]) && !isset($_POST["search"])){
	$lista=Sortiraj(dajSvaVozila());
	Prikazi($lista,"");	
}

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"]) && isset($_POST["search"])){
	Prikazi(dajVoziloPoModelu($_POST["search"]),$_POST["search"]); 
}

function Sortiraj($list){
	foreach ($list as $key => $row) {
		$model[$key]  = $row['model'];
	}
	array_multisort($model, SORT_ASC, $list);
	return $list;
}

function Prikazi($lista,$input){
	echo '<script>focusCampo("search");
	function focusCampo(id){
    var inputField = document.getElementById(id);
    if (inputField != null && inputField.value.length != 0){
        if (inputField.createTextRange){
            var FieldRange = inputField.createTextRange();
            FieldRange.moveStart("character",inputField.value.length);
            FieldRange.collapse();
            FieldRange.select();
        }else if (inputField.selectionStart || inputField.selectionStart == "0") {
            var elemLen = inputField.value.length;
            inputField.selectionStart = elemLen;
            inputField.selectionEnd = elemLen;
            inputField.focus();
        }
    }else{
        inputField.focus();
    }
}
	</script>';
	echo '<input type="text" name="search" value="'.$input.'" id="search" oninput="Trazi(this)"/>';
	echo '<table><tbody>';
	$j=0;
	for($i=0; $i<count($lista); $i++){
		if($j==0) echo '<tr>';
		$j++;
		echo '<td>
			<img class="imgProizvodjaca" src="'.dajSlikuPoId($lista[$i]["idSlike"])["path"].'"> <div class="sredina">'.$lista[$i]["model"].'</div>
			<input style="float:right; top:5px;" class="sredina" type="button" value="Obrisi" onclick="return ObrisiVozilo('.$lista[$i]["id"].')" />
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
		<h4 style="border:none;">Da li zelite obrisati vozilo?</h4>
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
	max-width:70px;
	max-height:70px;
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
function Trazi(button){
	var vrj=button.value;
	if(vrj!=""){
		urlTmp='../php/obrisiVozilo.php';
		var datarow={	
			'search':vrj
		};
		$.ajax({
		   url: urlTmp,
		   type:    'POST',
		   data: datarow,
		 success: function(response){
			$("#centerAdminPanel").html(response);
		 }});
	}
}

$("#msgboxButtonYes").click(function(){
	var vrj=$("#msgboxButtonYes").attr("name");
	if(vrj!="Ne"){
		urlTmp='../php/obrisiVozilo.php';
		var datarow={	
			'idVozila':vrj
		};
		$.ajax({
		   url: urlTmp,
		   type:    'POST',
		   data: datarow,
		 success: function(response){
			$("#centerAdminPanel").html(response);
			obrisiVozilo();
		 }});
	}
});

$("#msgboxButtonNo").click(function(){
	$("#poruka").hide();
	$("#msgboxButtonYes").attr("name","Ne");
});

function ObrisiVozilo(idPr){
	$("#poruka").show();
	$("#msgboxButtonYes").attr("name",idPr);
	return false;
}
</script>