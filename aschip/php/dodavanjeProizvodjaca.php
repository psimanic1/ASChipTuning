<style>


</style>
<?php
include 'crud.php';
include 'klase.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SESSION["username"])){
	if($_POST["markaVozila"] ){
		//dodavanje slike
		$idUploadovaneSlike=0;
		$target_dir = "../uploads/proizvodjaci/";
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
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
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
				//idFoldera je 1 jer su tu slike za proizvodjace
				$slika->SlikaCtor(0,$target_file,$video,1);
				$idUploadovaneSlike=dodajSliku($slika);
				if($idUploadovaneSlike!=0){
					$markaVozila=htmlspecialchars($_POST['markaVozila']);
					$proiz=new Proizvodjac();
					$proiz->ProizvodjacCtor(0,$markaVozila,$idUploadovaneSlike);
					$id=dodajProizvodjaca($proiz);
					if($id!=0){ 
						echo "<script> alert('Uspjesno ste dodali proizvodjaca!'); </script>";
					}
					else{
						obrisiSlikuPoId($idUploadovaneSlike);
						unlink($target_file);
						echo "<script> alert('Niste dodali proivodjaca!'); </script>";
					}
				}			
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}else{
		echo "<script> alert('Niste unijeli proivodjaca ili sliku!'); </script>";
	}
	
}
?>

<?php 
 if(!empty($_SESSION["username"])){
?>

<form id="dodajProizvodjaca" method="POST" enctype="multipart/form-data">
	<label>Izaberite sliku:<label></br>
<<<<<<< HEAD
	<input type="file" name="fileToUpload" id="fileToUpload"/></br>
	<label>Proizvodjac:</label></br>
	<input type="text" name="markaVozila" id="markaVozila" /></br>
	<input type="submit" value="submit" name="submit"/>
=======
	<br>
	<input type="file" name="fileToUpload" id="fileToUpload"/></br>
	<br>
	<label>Proizvodjac:</label></br>
	<input type="text" name="markaVozila" id="markaVozila" /></br>
	<br>
	<input type="submit" value="Submit" name="submit"/>
>>>>>>> refs/remotes/origin/dizajn
</form>
<?php
}else{
	echo 'Nemate privilegije admina!';
}
?>
<script>
$('#dodajProizvodjaca').submit( function( e ) {
		$.ajax( {
		  url: '../php/dodavanjeProizvodjaca.php',
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