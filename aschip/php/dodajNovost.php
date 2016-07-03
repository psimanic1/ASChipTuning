<?php
include 'crud.php';
include 'klase.php';

session_start();


if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION['username'])){
	$naslov=htmlspecialchars($_POST['naslov']);
	$tekst=htmlspecialchars($_POST['tekstualno']);

	if(!empty($_POST['naslov']) && !empty($_POST['tekstualno'])){
		//dodavanje slike
		$idUploadovaneSlike=0;
		$target_dir = "../uploads/novosti/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$video=0;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				//echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		/*if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}*/
		// Check file size
		//povecati velicinu fajla ovo je 500kb
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			echo "Sorry, only JPG, JPEG & PNG files are allowed.";
			$uploadOk = 0;
		}

		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$slika=new Slika();
				//idFoldera je 6 jer su tu slike za novosti
				$slika->SlikaCtor(0,$target_file,$video,6);
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
				echo "Sorry, there was an error uploading your file.";
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
.inputTextEditorObjaviNovost{
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
</style>



<form id="formaObjava" method="Post" enctype="multipart/form-data">
	<div>
		<p>Naslov:</p>
		<input class="inputTextEditorObjaviNovost" type="text" oninput="ValidirajNaslov(this)" value="" name="naslov"/>
		<p>Tekst:</p>
		<textarea id="MultilineEditorObjaviNovost" name="tekstualno" oninput="ValidirajTekst(this)" value="" cols="40" rows="5"></textarea>
		<br/>
		<label>Izaberite sliku:<label></br>
		<br>
		<input type="file" name="fileToUpload" id="fileToUpload"/>
	</div>
	<div id="formaObjavaBbtObjavi">				
		<input type="submit" name="objavi" value="Objavi novost"/>
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
</script>