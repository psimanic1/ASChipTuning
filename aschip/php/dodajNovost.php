<?php
include 'crud.php';
include 'klase.php';

session_start();


if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['username'])){
	$naslov=htmlspecialchars($_POST['naslov']);
	$tekst=htmlspecialchars($_POST['tekstualno']);

	if(!empty($_POST['naslov']) && !empty($_POST['tekstualno'])){
		$idUploadovaneSlike=0;
		$target_dir = "../uploads/novosti/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$video=0;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				echo "Fajl nije slika ili video..";
				$uploadOk = 0;
			}
		}
		//povecati velicinu fajla ovo je 500kb
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Fajl je prevelik";
			$uploadOk = 0;
		}
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			echo "Samo JPG, JPEG, PNG & GIF fajlovi su dozvoljeni.";
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo "Greska prilikom dodavanja slike.";
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$slika=new Slika();
				//idFoldera je 3 jer su tu slike za novosti
				$slika->SlikaCtor(0,$target_file,$video,3);
				$idUploadovaneSlike=dodajSliku($slika);
				
				if($idUploadovaneSlike!=0){						
					$novost=new Novost();
					$novost->NovostCtor(0,$naslov,$tekst,$idUploadovaneSlike);
					$id=dodajNovost($novost);
					
					if($id!=0){ 
						echo "<script> alert('Uspjesno ste dodali novost!'); </script>";
					}
					else{
						obrisiSlikuPoId($idUploadovaneSlike);
						unlink($target_file);
						echo "<script> alert('Niste dodali novost!'); </script>";
					}
				}			
			} else {
				echo "Greska prilikom dodavanja slike.";
			}
		}
	
	
		echo "Uspjesno ste objavili novost!";
	}
	else{
		echo "Niste popunili sva polja!";
	}
}
?>
<style>
#inputTextEditorObjaviNovost{
	width: 295px;
}


#MultilineEditorObjaviNovost{
	width: 295px;
	max-width:295px;
	max-height:200px;
}

#formaObjavaBbtObjavi{
	margin-top: 25px;
	float: left;
}
#brSlova{
	font-size: 8px;
    position: relative;
    left: 175px;
    width: 100px;
    display: inline-block;
	top: 14px;
}
</style>



<form id="formaObjava" method="Post" enctype="multipart/form-data">
	<div>
		<p>Naslov:</p>
		<input id="inputTextEditorObjaviNovost" type="text" oninput="ValidirajNaslov(this)" value="" name="naslov"/>
		<div>
			<p style="width:100px; display:inline-block;">Tekst:</p>
			<p id="brSlova">1000</p>
		</div>
		<textarea id="MultilineEditorObjaviNovost" name="tekstualno" oninput="ValidirajTekst(this)" value="" cols="40" rows="5"></textarea>
		<br/>
		<label>Izaberite sliku:<label></br>
		<br>
		<input type="file" name="fileToUpload" id="fileToUpload"/>
	</div>
	<div id="formaObjavaBbtObjavi">				
		<input type="submit" name="objavi" id="submit" disabled="disabled" value="Objavi novost"/>
	</div>	
</form>	

<script>
$('#formaObjava').submit( function( e ) {
	$.ajax({
		url: '../php/dodajNovost.php',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success:function(response){			
			$("#centerAdminPanel").html(response);
		}
	});
	e.preventDefault();
});


//validacija
$("#inputTextEditorObjaviNovost").addClass("redBorder");
$("#MultilineEditorObjaviNovost").addClass("redBorder");
$("#fileToUpload").addClass("redBorder");

 $("input:file").change(function (){
	var fileName = $(this).val();
	if(fileName!=null)
		removeRedBorder(this);		
	else 
		addRedBorder(this);
	
});

function ValidirajNaslov(tb){
	if(tb.value=="" || tb.value.length>50){
		addRedBorder(tb);
		$("#submit").attr("disabled","disabled");
	}else{
		removeRedBorder(tb);
	}
}

function ValidirajTekst(tb){
	var br=$("#MultilineEditorObjaviNovost").val().length;
	$("#brSlova").html(1000-br);
	if(tb.value=="" || tb.value.length>1000){
		addRedBorder(tb);
		$("#submit").attr("disabled","disabled");
	}else{
		removeRedBorder(tb);
	}
}

function addRedBorder(tb){
	$(tb).addClass("redBorder");
}

function removeRedBorder(tb){
	$(tb).removeClass("redBorder");
	Check();
}

function Check(){
	var prviEl=$("#inputTextEditorObjaviNovost").hasClass("redBorder");
	var drugiEl=$("#MultilineEditorObjaviNovost").hasClass("redBorder");
	var treciEl=$("#fileToUpload").hasClass("redBorder");
	if(!prviEl && !drugiEl && !treciEl)
		$("#submit").removeAttr("disabled");
}
</script>